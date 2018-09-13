<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace XuTL\Sms;

use Overtrue\EasySms\EasySms;

/**
 * Class Sms
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Sms
{
    /**
     * @var EasySms
     */
    protected $easySms;

    /**
     * Sms constructor.
     *
     * @param EasySms $easySms
     */
    public function __construct(EasySms $easySms)
    {
        $this->easySms = $easySms;
    }

    /**
     * @param $to
     * @param mixed $message
     * @param array $gateways
     * @return bool
     */
    public function send($to, $message, array $gateways = [])
    {

            $results =  $this->easySms->send($to, $message, $gateways);
            foreach ($results as $key => $value){
                if ('success' == $value['status']) {
                    return true;
                }
            }
            return false;
        try {
            $flag = false;
            $this->setKey($to);
            //1. get code from storage.
            $code = $this->getCodeFromStorage();
            if ($this->needNewCode($code)) {
                $code = $this->getNewCode($to);
            }
            $validMinutes = (int)config('ibrand.sms.code.validMinutes', 5);
            $message = new CodeMessage($code->code, $validMinutes);
            $results = $this->easySms->send($to, $message);
            foreach ($results as $key => $value) {
                if ('success' == $value['status']) {
                    $code->put('sent', true);
                    $code->put('sentAt', Carbon::now());
                    $this->storage->set($this->key, $code);
                    $flag = true;
                }
            }
        } catch (NoGatewayAvailableException $noGatewayAvailableException) {
            $results = $noGatewayAvailableException->results;
            $flag = false;
        } catch (\Exception $exception) {
            $results = $exception->getMessage();
            $flag = false;
        }
        DbLogger::dispatch($code, json_encode($results), $flag);
        return $flag;
    }
}
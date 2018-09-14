<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace XuTL\Sms;

use Illuminate\Support\Facades\Log;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

/**
 * Class Sms
 * @mixin EasySms
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Sms
{
    /**
     * @var EasySms
     */
    protected $easySms;

    /**
     * @return EasySms
     */
    protected function getEasySms()
    {
        if (!$this->easySms) {
            $config = config("sms");
            $this->easySms = new EasySms($config);
        }
        return $this->easySms;
    }

    /**
     * @param string $to
     * @param mixed $message
     * @param array $gateways
     * @return bool
     */
    public function send($to, $message, array $gateways = [])
    {
        try {
            $flag = false;
            $results = $this->getEasySms()->send($to, $message, $gateways);
            foreach ($results as $key => $value) {
                if ('success' == $value['status']) {
                    $flag = true;
                }
            }
        } catch (NoGatewayAvailableException $noGatewayAvailableException) {
            $results = $noGatewayAvailableException->results;
            Log::warning(json_encode($results));
            $flag = false;
        } catch (\Exception $exception) {
            $results = $exception->getMessage();
            Log::error(json_encode($results));
            $flag = false;
        }
        return $flag;
    }

    /**
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([ $this->getEasySms(), $method ], $parameters);
    }
}
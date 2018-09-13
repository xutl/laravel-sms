<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace XuTL\Sms;

use Illuminate\Support\ServiceProvider;
use Overtrue\EasySms\EasySms;

/**
 * SMS服务提供者
 * @package XuTL\Sms
 */
class SmsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__ . '/../config/sms.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $source => config_path('sms.php'),
            ], 'sms-config');
        }

        $this->mergeConfigFrom($source, 'sms');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLaravelBindings();
    }

    /**
     * Register Laravel bindings.
     *
     * @return void
     */
    protected function registerLaravelBindings()
    {
        $this->app->singleton(Sms::class, function ($app) {
            return new Sms($this->getEasySms(config('sms')));
        });
    }

    /**
     * @param array $config
     * @return EasySms
     */
    protected function getEasySms(array $config){
        return new EasySms($config);
    }
}

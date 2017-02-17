<?php
/**
 * Created by PhpStorm.
 * User: zyxcba
 * Date: 2017/2/17
 * Time: 下午4:12
 */

namespace Cmzz\LaravelAliyunSms;

use Cmzz\LaravelAliyunSms\SmsSender;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot()
    {
        $this->setupConfig();
    }

    public function register()
    {
        //
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/config.php');

        if ($this->app instanceof LaravelApplication) {
            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $source => config_path('aliyunsms.php'),
                ]);
            }

        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('aliyunsms');
        }

        $this->mergeConfigFrom($source, 'aliyunsms');
    }
}
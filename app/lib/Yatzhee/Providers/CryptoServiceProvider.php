<?php namespace Yatzhee\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Yatzhee\Cryptography\Cryptography;
use Yatzhee\Cryptography\DecryptedInput;

class CryptoServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cryptography', function() {
            return new Cryptography();
        });

        $this->app['decryptedinput'] = $this->app->share(function($app) {
            return new DecryptedInput($app['cryptography']);
        });

        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('DecryptedInput', 'Yatzhee\Facades\DecryptedInput');
        });
    }
}
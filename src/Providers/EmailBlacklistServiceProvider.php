<?php

namespace Andrewlynx\EmailBlacklist\Providers;

use Andrewlynx\EmailBlacklist\EmailBlacklist;
use Illuminate\Support\ServiceProvider;

/**
 * Description of EmailBlacklistServiceProvider
 *
 * @author andrew
 */
class EmailBlacklistServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
    }
    
    public function register()
    {
        $this->app->bind(
            'Andrewlynx\EmailBlacklist\EmailBlacklist', function ($app) {
                return new EmailBlacklist();
            }
        );
    }
}

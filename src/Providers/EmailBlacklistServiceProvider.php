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
        // add module config to global
        $this->publishes([
            __DIR__ . '/../../config/email_blacklist' => config_path('email_blacklist.php'),
        ]);

        // add module migrations to global
        $this->publishes([
            config('email_blacklist.folder') . '/database/migrations/' => database_path('migrations/'),
        ], 'migrations');
    }

    public function register()
    {
        // bind shortcut for facade access
        $this->app->bind('email_blacklist', function ($app) {
            return new EmailBlacklist();
        });

        // merge module config with global
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/email_blacklist.php', 'email_blacklist'
        );
    }
}

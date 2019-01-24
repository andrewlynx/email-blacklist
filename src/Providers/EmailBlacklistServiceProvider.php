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
        $this->publishes([
            __DIR__ . '/../../config/email_blacklist' => config_path('email_blacklist.php'),
        ]);

        $this->publishes([
            config('email_blacklist.folder') . '/database/migrations/' => database_path('migrations/'),
        ], 'migrations');
    }

    public function register()
    {
        $this->app->bind(
            'Andrewlynx\EmailBlacklist\EmailBlacklist', function ($app) {
                return new EmailBlacklist();
            }
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/email_blacklist.php', 'email_blacklist'
        );
    }
}

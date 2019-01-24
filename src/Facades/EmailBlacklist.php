<?php

namespace Andrewlynx\EmailBlacklist\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Description of EmailBlacklist
 *
 * @author andrew
 */
class EmailBlacklist extends Facade
{
    protected static function getFacadeAccessor() {
        return 'email_blacklist';
    }
}
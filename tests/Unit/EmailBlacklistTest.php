<?php

namespace Andrewlynx\EmailBlacklist\Tests;

use Andrewlynx\EmailBlacklist\Facades\EmailBlacklist;
use InvalidArgumentException;
use Orchestra\Testbench\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Description of EmailBlacklistTest
 *
 * @author andrew
 */
class EmailBlacklistTest extends TestCase
{
    public function getPackageProviders($app)
    {
        return ['email_blacklist' => 'Andrewlynx\EmailBlacklist\Providers\EmailBlacklistServiceProvider'];
    }

    public function getPackageAliases($app)
    {
        return ['email_blacklist' => 'Andrewlynx\EmailBlacklist\Facades\EmailBlacklist'];
    }

    public function testValidEmail()
    {
        $this->assertNull(EmailBlacklist::validate('email@site.domain'));
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidArgumentException::class);
        EmailBlacklist::validate('Not An Email');
    }
}

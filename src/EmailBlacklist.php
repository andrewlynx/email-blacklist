<?php

namespace Andrewlynx\EmailBlacklist;

use Andrewlynx\EmailBlacklist\Models\EmailBlacklistModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Description of EmailBlacklist
 *
 * @author andrew
 */
class EmailBlacklist
{
    private $model;
    
    public function __construct()
    {
        $this->model = new EmailBlacklistModel();
    }


    public function add(string $email)
    {
        $this->validate($email);
        return;
    }

    public function remove(string $email)
    {
        return;
    }

    public function all()
    {
        return "works";
    }

    public function check(string $email)
    {
        return;
    }

    public function filter(array $emails)
    {
        return;
    }
    
    private function validate(string $email)
    {
        $validator = Validator::make(
            ['email' => $email],
            ['email' => ['required', 'email']]
        );
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->messages());
        }
    }
}

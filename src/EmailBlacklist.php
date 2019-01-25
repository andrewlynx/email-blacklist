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
        $this->model->updateOrCreate(['email' => $email], ['email' => $email]);
    }

    public function remove(string $email)
    {
        $this->validate($email);
        $this->model->where('email', $email)->delete();
    }

    public function all()
    {
        return $this->model->pluck('email')->toArray();
    }

    public function check(string $email)
    {
        $this->validate($email);
        return $this->model->where('email', $email)->exists();
    }

    public function filter(array $emails)
    {
        array_walk($emails, [$this, 'validate']);
        return array_diff($emails, $this->all());
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

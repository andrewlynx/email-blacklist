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
    /*
     * model for db access
     */
    private $model;
    
    public function __construct()
    {
        $this->model = new EmailBlacklistModel();
    }

    /**
     * add new email if not exists.
     *
     * @param string $email
     * @return void
     */
    public function add(string $email)
    {
        $this->validate($email);
        $this->model->updateOrCreate(['email' => $email], ['email' => $email]);
    }

    /**
     * remove email if exists.
     *
     * @param string $email
     * @return void
     */
    public function remove(string $email)
    {
        $this->validate($email);
        $this->model->where('email', $email)->delete();
    }

    /**
     * get all saved emails.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->model->pluck('email')->toArray();
    }

    /**
     * check email if exists.
     *
     * @param string $email
     * @return bool
     */
    public function check(string $email): bool
    {
        $this->validate($email);
        return $this->model->where('email', $email)->exists();
    }

    /**
     * filter out existing emails, return array of not blacklisted emails.
     *
     * @param array $emails
     * @return array
     */
    public function filter(array $emails): array
    {
        array_walk($emails, [$this, 'validate']);
        return array_diff($emails, $this->all());
    }
    
    /**
     * validate input for being email.
     *
     * @param string $emails
     * @throws InvalidArgumentException when validation fails
     * @return void
     */
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

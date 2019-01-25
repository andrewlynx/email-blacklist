<?php

namespace Andrewlynx\EmailBlacklist\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of EmailBlacklistModel
 *
 * @author andrew
 */
class EmailBlacklistModel extends Model
{
    protected $fillable = [
        'email',
    ];
    
    public function __construct()
    {
        $this->table = config('email_blacklist.db_table');
        parent::__construct();
    }
}

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
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'firstname',
        'lastname',
        'email',
        'password',
        'updated_at'
    ];
}

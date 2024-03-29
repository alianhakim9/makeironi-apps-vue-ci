<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'address', 'phone_number', 'date_of_birth', 'gender'];
    protected $allowCallbacks       = true;
}

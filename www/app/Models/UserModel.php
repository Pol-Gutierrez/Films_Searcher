<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['email', 'password', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'email'    => 'required|checkEmailDomain[salle.url.edu]',
        'password' => 'required|min_length[6]|checkPassword',
    ];
    protected $validationMessages = [
        'email' => [
            'required' => 'The email address is not valid.',
            'checkEmailDomain' => 'Only emails from the domain @salle.url.edu are accepted.',
        ],
        'password' => [
            'required' => 'The password is not valid.',
            'min_length' => 'The password must contain at least 6 characters.',
            'checkPassword' => 'The password must contain both upper and lower case letters and numbers.',
        ],
    ];

    protected $skipValidation = false;

}
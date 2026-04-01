<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoritesShareModel extends Model {
    protected $table = null;
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'movie_id', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'movie_id' => 'required|integer',
    ];
    protected $validationMessages = [
        'user_id' => [
            'required' => 'The user ID is required.',
            'integer' => 'The user ID must be an integer.',
        ],
        'movie_id' => [
            'required' => 'The movie ID is required.',
            'integer' => 'The movie ID must be an integer.',
        ],
    ];

    protected $skipValidation = false;
}
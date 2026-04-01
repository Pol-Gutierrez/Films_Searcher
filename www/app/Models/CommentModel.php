<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model {
    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'movie_id', 'comment', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'movie_id' => 'required|integer',
        'comment' => 'required|string|max_length[1000]',
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
        'comment' => [
            'required' => 'The comment is required.',
            'string' => 'The comment must be a string.',
            'max_length' => 'The comment must not exceed 1000 characters.',
        ],
    ];

    protected $skipValidation = false;
}
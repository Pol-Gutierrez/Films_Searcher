<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model {
    protected $table = 'movies';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['api_id', 'title', 'year', 'poster', 'introduction', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'api_id' => 'required|integer',
        'title' => 'required|string|max_length[255]',
        'year' => 'date',
        'poster' => 'string|max_length[255]',
        'introduction' => 'string|max_length[6000]',

    ];
    protected $validationMessages = [
        'api_id' => [
            'required' => 'The API ID is required.',
            'integer' => 'The API ID must be an integer.',
        ],
        'title' => [
            'required' => 'The title is required.',
            'string' => 'The title must be a string.',
            'max_length' => 'The title must not exceed 255 characters.',
        ],
        'year' => [
            'date' => 'The year must be a valid date.',
        ],
        'poster' => [
            'string' => 'The poster must be a string.',
            'max_length' => 'The poster must not exceed 255 characters.',
        ],
        'introduction' => [
            'string' => 'The introduction must be a string.',
            'max_length' => 'The introduction must not exceed 6000 characters.',
        ],
    ];

    protected $skipValidation = false;
}
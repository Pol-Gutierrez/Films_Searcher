<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

use App\Models\FavoritesShareModel;
use App\Models\MovieModel;
use App\Models\UserModel;

class Shared extends BaseController {
    // function to show the favorites list page:
    public function showShared() {
        helper(['form']);

        // get the favorites from the database:
        $shareModel = new FavoritesShareModel();
        $shareModel->setTable('shared_movies');

        $error = [];
        $data = [];

        try {
            $data = $shareModel->select('shared_movies.*, movies.api_id, movies.title, movies.introduction, movies.year, movies.poster, users.email')
                ->join('movies', 'movies.id = shared_movies.movie_id')
                ->join('users', 'users.id = shared_movies.user_id')                
                ->findAll();
            
            // go trough the movies and get the username from the email:
            foreach ($data as &$movie) {
                $movie['username'] = ucfirst(explode('@', $movie['email'])[0]);            
            }
        } catch (\Exception $e) {
            echo "Exception: " . $e->getMessage(); // For debugging purposes
            $error['shared'] = 'Error fetching shared movies from the database.';
            $data = [];
        }

        // pass the shared movies to the view:
        return view('shared', ['shared' => $data]);
        //return view('shared');

    }
}
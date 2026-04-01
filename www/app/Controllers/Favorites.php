<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

use App\Models\FavoritesShareModel;
use App\Models\MovieModel;

class Favorites extends BaseController {
    // function to show the favorites list page:
    public function showFavorites() {
        helper(['form']);
        // get the user id from the session:
        $userId = session()->get('user_id');

        // get the favorites from the database:
        $favoritesModel = new FavoritesShareModel();
        $favoritesModel->setTable('favorites');

        $error = [];
        $data = [];

        try {
            $data = $favoritesModel->select('favorites.*, movies.api_id, movies.title, movies.introduction, movies.year, movies.poster')
                ->join('movies', 'movies.id = favorites.movie_id')
                ->where('favorites.user_id', $userId)
                ->findAll();
        } catch (\Exception $e) {
            echo "Exception: " . $e->getMessage(); // For debugging purposes
            $error['favorites'] = 'Error fetching favorites from the database.';
            $data = [];
        }

        // pass the favorites to the view:
        return view('favorites', ['favorites' => $data]);
        //return view('favorites');

    }
}
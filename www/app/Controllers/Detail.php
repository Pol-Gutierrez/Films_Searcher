<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

use App\Models\MovieModel;
use App\Models\CommentModel;
use App\Models\FavoritesShareModel;

class Detail extends BaseController {
    public function showDetail() {
        helper(['form']);
        // get the id from the query string:
        $id = $this->request->getUri()->getSegment(2); 

        // make api call to get the details of the movie:
        $client = new ApiClient();
        $data = $client->getMovieById($id);
        
        // save the movie in the database:
        $movieModel = new MovieModel();
        $movieData = [
            'api_id' => $data['id'],
            'title' => $data['title'],
            'introduction' => $data['overview'],
            'year' => $data['release_date'],
            'poster' => $data['poster_path'],
        ];

        $errors = [];

        try {
            $movieModel->insert($movieData);
        } catch (\Exception $e) {
            $errors['email'] = 'The movie can not be inserted in the database.';
        }
        
        // get the view:
        return view('movie_detail', ['data' => $data]);
    }

    // function to handle the comment form submission:
    public function submitComment() {
        helper(['form']);
        // get the user id from the session:
        $userId = session()->get('user_id');

        // get the id from the query string:
        $id_movie = $this->request->getUri()->getSegment(2); 

        // get the comment from the form:
        $commentText = $this->request->getPost('comment');

        // get the id of the movie from the database by the api id:
        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $id_movie)->first();

        // save the comment in the database:
        $commentModel = new CommentModel();

        $commentData = [
            'user_id' => $userId,
            'movie_id' => $movie['id'],
            'comment' => $commentText,
        ];

        $errors = [];

        try {
            if (!$commentModel->insert($commentData)) {
                $errorsAux = $commentModel->errors();
                $errors = array_merge($errors, $errorsAux['comment'] ?? []);                
            } else {
                $errors['success'] = 'Comment added successfully.';
            }
        } catch (\Exception $e) {
            echo "Exception: " . $e->getMessage(); // For debugging purposes
            $errors['comment'] = 'Error processing the comment.';
        }
        
        // get the view:        
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    // function to handle the favorites button:
    public function addToFavorites() {
        // get required info to be added:
        $info = [
            'user_id' => session()->get('user_id'),            
            'id_movie' => $this->request->getPost('movie_id'),
        ];

        // save the favorite in the database:
        $errors = $this->insertIntoDDBB($info, true);

        // get the view:
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    // function to handle the share button:
    public function share() {
        // get required info to be added:
        $info = [
            'user_id' => session()->get('user_id'),            
            'id_movie' => $this->request->getPost('movie_id'),
        ];

        // save the favorite in the database:
        $errors = $this->insertIntoDDBB($info, false);

        // get the view:
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    // function to handle the insert in the database:
    private function insertIntoDDBB($info, $favorites) {
        // get the id of the movie from the database by the api id:
        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $info['id_movie'])->first();

        // save the comment in the database:
        $model = new FavoritesShareModel();
        if ($favorites) {
            $model->setTable('favorites');
        } else {
            $model->setTable('shared_movies');
        }

        $dataInsert = [
            'user_id' => $info['user_id'],
            'movie_id' => $movie['id'],
        ];

        $errors = [];

        try {
            if (!$model->insert($dataInsert)) {
                //$errorsAux = $model->errors();
                //$errors = array_merge($errors, $errorsAux['comment'] ?? []);                
            } else {
                //$errors['success'] = 'Comment added successfully.';
            }
        } catch (\Exception $e) {
            echo "Exception: " . $e->getMessage(); // For debugging purposes
            if ($favorites) {
                $errors['favorites'] = 'Error processing the favorite.';
            } else {
                $errors['share'] = 'Error processing the share.';
            }
        }

        return $errors;
    }
}
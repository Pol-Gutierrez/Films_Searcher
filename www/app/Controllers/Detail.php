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
        $comments = [];

        $commentModel = new CommentModel();

        try {
            // petition to insert the movie:            
            $movieModel->insert($movieData);
        } catch (\Exception $e) {
            $errors['email'] = 'The movie can not be inserted in the database.';
        }
        $movie = $movieModel->where('api_id', $data['id'])->first(); // get the movie from the database to have the id for the comments
        try {
            // petition to get all the comments related to the movie:            
            $comments = $commentModel->select('comments.*, users.email')
            ->join('users', 'users.id = comments.user_id')->where('comments.movie_id', $movie['id'])
            ->findAll();

            // go trough the comments and get the username from the email:
            foreach ($comments as &$comment) {
                $comment['username'] = ucfirst(explode('@', $comment['email'])[0]);            
            }
        } catch (\Exception $e) {
            $errors['email'] = 'Not possible to get the comments from the database.';            
        }

        // check if the movie is already in the database to modify the favorites text:
        $favoritesModel = new FavoritesShareModel();
        $favoritesModel->setTable('favorites');

        $isFavorite = $favoritesModel->where('user_id', session()->get('user_id'))->where('movie_id', $movie['id'])->first();

        $btnText = $isFavorite ? 'Remove from favorites' : 'Add to favorites';
        //$btnText = 'Add to favorites';

        // get the view:
        return view('movie_detail', ['data' => $data, 'comments' => $comments, 'btnText' => $btnText]);
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
        // get the text of the button to know if we have to add or remove the favorite:
        $action = $this->request->getPost('action');
        if ($action === 'Add to favorites') {
            return $this->handleAddToFavorites();
        } else if ($action === 'Remove from favorites') {
            return $this->handleRemoveFromFavorites();
        }        
    }

    // function to handle the add to favorites:
    private function handleAddToFavorites() {
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

    // function to handle the remove from favorites:
    private function handleRemoveFromFavorites() {
        // get required info to be removed:
        $userId = session()->get('user_id');
        $id_movie = $this->request->getPost('movie_id');

        // get the id of the movie from the database by the api id:
        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $id_movie)->first();

        // remove the favorite from the database:
        $favoritesModel = new FavoritesShareModel();
        $favoritesModel->setTable('favorites');

        $errors = [];

        try {
            $favoritesModel->where('user_id', $userId)->where('movie_id', $movie['id'])->delete();
        } catch (\Exception $e) {
            $errors['favorites'] = 'Error processing the favorite.';
        }

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
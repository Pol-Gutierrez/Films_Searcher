<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

use App\Models\MovieModel;
use App\Models\CommentModel;
//use App\Models\FavoritesModel;
//use App\Models\ShareModel;

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

        /*echo "User ID: " . $userId; // For debugging purposes
        echo "Movie ID: " . $id; // For debugging purposes
        echo "Comment: " . $commentText; // For debugging purposes*/

        // get the id of the movie from the database by the api id:
        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $id_movie)->first();

        // save the comment in the database:
        $commentModel = new CommentModel();

        //echo "Movie: " . print_r($movie, true); // For debugging purposes

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

        //echo "Errors: " . print_r($errors, true); // For debugging purposes
        
        // get the view:        
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    // function to handle the favorites button:
    public function addToFavorites() {

    }

    // function to handle the share button:
    public function share() {

    }
}
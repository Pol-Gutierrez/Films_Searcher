<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

use App\Models\MovieModel;

class Detail extends BaseController {
    public function showDetail() {
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
            $errors['email'] = 'The email address is already registered.';
        }
        
        // get the view:
        return view('movie_detail', ['data' => $data]);
    }
}
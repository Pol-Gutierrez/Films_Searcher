<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Detail extends BaseController {
    public function showDetail() {
        // get the id from the query string:
        $id = $this->request->getUri()->getSegment(2); 

        // make api call to get the details of the movie:
        $client = new ApiClient();
        $data = $client->getMovieById($id);
        
        
        
        
        // save the movie in the database:

        
        
        
        // get the view:
        return view('movie_detail', ['data' => $data]);
    }
}
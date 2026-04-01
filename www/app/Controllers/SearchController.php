<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class SearchController extends BaseController {
    // function to show the search page:
    public function processSearchBar($searchQuery = null) {
        helper(['form']);

        // in case there is any action in the search bar, we will process it here:
        $searchQuery = $this->request->getGet('searchbar');
        // if there is a search query, we will pass it to the view:
        if ($searchQuery) {
            $apiClient = new ApiClient();
            // get the data from the api:
            $data = $apiClient->searchMovies($searchQuery);
        } 

        // pass the data to the view, or an empty array if there is no data
        return view('movie_search', ['data' => $data ?? []]);        
    }
}
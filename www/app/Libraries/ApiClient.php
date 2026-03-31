<?php

namespace App\Libraries;

use GuzzleHttp\Client;

class ApiClient {
    private $client;
    private $token = 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyZWE1YWNjYWU5ODNhYTM5YTdhYTc2NzM2ZDVjNTA3MiIsIm5iZiI6MTc3NDg4MTE1OS4zOTM5OTk4LCJzdWIiOiI2OWNhODk4NzIxZDkwMTRjN2E1YWYyYjciLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.xr4ypWuxQ5CGE6Q5oKZWfggp21JcrH5Eqh-0oyK4jKo';

    public function __construct() {
        $this->client = new Client();
    }

    // function to search movies by name:
    public function searchMovies($query) {
        try {
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/search/movie', [
                'headers' => [
                    'Authorization' => $this->token,
                    'accept' => 'application/json',
                ],
                'query' => [
                    'include_adult' => 'false',
                    'language' => 'en-US',
                    'page' => 1,
                    'query' => $query,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            $data['error'] = "An error occurred.";
            return $data;
        }
    }

    // function to search for a movie by id:
    public function getMovieById($id) {
        try {
            $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/$id", [
                'headers' => [
                    'Authorization' => $this->token,
                    'accept' => 'application/json',
                ],
                'query' => [
                    'append_to_response' => 'credits',
                    'language' => 'es-ES'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            return $data;
        } catch (\Exception $e) {
            $data['error'] = 'The movie you are searching for does not exist.';
            return $data;
        }
    }
}
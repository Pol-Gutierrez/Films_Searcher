<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            // If not logged in, redirect to the login page:
            switch ($arguments[0] ?? '') {
                case 'movie_details':
                    return redirect()->to('/sign-in')->with('errors', ['general' => 'You must be logged in to access the movie details page.']);                    
                default:
                    return redirect()->to('/sign-in')->with('errors', ['general' => 'You must be logged in to access the movies page.']);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    }
}
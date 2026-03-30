<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            // If not logged in, redirect to the login page
            return redirect()->to('/sign-in');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    }
}
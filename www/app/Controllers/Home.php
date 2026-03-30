<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        helper(['form']);

        $name = null;

        // check if the user exists in the session:
        if (session()->get('isLoggedIn')) {
            // If logged in, get the email to show them on the page:
            $email = session()->get('email');
            $name = explode('@', $email)[0]; // Get the part before the @ symbol as the name
            $name = ucfirst($name); // Capitalize the first letter of the name
        }

        return view('home', ['name' => $name]);
    }

    public function submit() {
        helper(['form']);

        $action = $this->request->getPost('action');

        switch ($action) {
            case 'sign_in':
                return redirect()->to('/sign-in');
            case 'sign_up':
                return redirect()->to('/sign-up');
            default:
                return redirect()->back()->withInput()->with('errors', ['general' => 'Invalid action.']);
        }
    }
}
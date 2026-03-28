<?php

namespace App\Controllers;

class Signup extends BaseController {

    // function to show the sign up page:
    public function showSignUpPage() {
        return view('sign_up');
    }

    // function when submitting the sign up form:
    public function submit() {
        // rules for validating the form data:
        $rules = [
            'email' => [
                'rules' => 'required|regex_match[/^[a-zA-Z0-9._%+-]+@salle\.url\.edu$/]',
                'errors' => [
                    'required' => 'The email address is not valid.',
                    'regex_match' => 'Only emails from the domain @salle.url.edu are accepted.',
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[7]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'required' => 'The password is not valid.',
                    'min_length' => 'The password must contain at least 7 characters.',
                    'regex_match' => 'The password must contain both upper and lower case letters and numbers.',
                ]
            ],

            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'This field can not be empty.',
                    'matches' => 'Passwords do not match.',
                ]
            ],
        ];


        if ($this->validate($rules)) {
            // Process the data (e.g., save to database)
            return redirect()->to('/log-in');
        } else {
            // Reload the form with error messages
            //return redirect()->back()->withInput();

            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    // function to show the log in page after signing up:
    public function showLoginPage() {
        echo "You have successfully signed up! Please log in.";
        //return view('log_in'); 
    }
}

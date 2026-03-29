<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signup extends BaseController {

    // function to show the sign up page:
    public function showSignUpPage() {
        helper(['form']);
        return view('sign_up');
    }

    // function when submitting the sign up form:
    public function submit() {
        helper(['form']);

        // array to store the errors:
        $errors = [];

        // get the info from the form:
        $confirmed_password = $this->request->getPost('confirm_password');
        $password = $this->request->getPost('password');

        // validate that the password and confirm password are the same:
        if ($confirmed_password !== $password) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!$this->validate(['password' => 'checkPassword'])) {
            $errors['password'] = $this->validator->getError('password');
        }

        $data = [
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $userModel = new UserModel();

        if ($userModel->insert($data)) {
            return redirect()->to('/log-in');
        } else {
            $errors = array_merge($errors, $userModel->errors());
            return redirect()->back()->withInput()->with('errors', $errors);
        }
    }

    // function to show the log in page after signing up:
    public function showLoginPage() {
        echo "You have successfully signed up! Please log in.";
        //return view('log_in'); 
    }
}

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

        $userModel = new UserModel();

        // validate the email and password using the rules in the model:
        $info = [
            'email' => $this->request->getPost('email'),
            'password' => $password,
        ];

        if (!$userModel->validate($info)) {
            $errors = array_merge($errors, $userModel->errors());
        }

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $data = [
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];        

        try {
            if ($userModel->insert($data)) {
                return redirect()->to('/sign-in');
            } else {
                $errors = array_merge($errors, $userModel->errors());
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        } catch (\Exception $e) {
            $errors['email'] = 'The email address is already registered.';
            return redirect()->back()->withInput()->with('errors', $errors);
        }
    }
}
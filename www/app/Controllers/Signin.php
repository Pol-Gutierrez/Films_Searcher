<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signin extends BaseController {

    // function to show the sign up page:
    public function showLoginPage() {
        helper(['form']);
        return view('sign_in');
    }

    // function when submitting the sign up form:
    public function submit() {
        helper(['form']);

        $action = $this->request->getPost('action');

        switch ($action) {
            case 'sign_in':
                return $this->handleSignIn();
            case 'sign_up':
                return redirect()->to('/sign-up');
            default:
                return redirect()->back()->withInput()->with('errors', ['general' => 'Invalid action.']);
        }
    }

    // function to sign in:
    private function handleSignIn() {
        $errors = [];

        // get the password field:
        $password = $this->request->getPost('password');
        // get the email field:
        $email = $this->request->getPost('email');
        
        $rules = [
                'email' => 'required|checkEmailDomain[salle.url.edu]',
                'password' => 'required|checkPassword',
            ];

        // validate the format of the data:
        if (!$this->validate($rules)) {
            $errors['email'] = $this->validator->getError('email');
            $errors['password'] = $this->validator->getError('password');
        }

        $userModel = new UserModel();

        if (!empty($errors['email'])) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // get the match from the database:
        try {

            $userInfo = $userModel->where('email', $this->request->getPost('email'))->first();

            $ok = password_verify($password, $userInfo['password']);

            if ($ok) {
                session()->set('isLoggedIn', true);
                session()->set('email', $userInfo['email']);
                session()->set('user_id', $userInfo['id']);
                return redirect()->to('/movies');
            } else {
                $errors['general'] = 'Your email and/or password are incorrect.';
            }

        } catch (\Exception $e) {
            // in case user does not exist:
            $errors['email'] = 'User with this email address does not exist.';
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

    }
}
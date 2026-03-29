<?php

namespace App\Validation;

class CustomRules {
    public function checkPassword(string $str, string &$error = null): bool {
        if (strlen($str) < 6) {
            $error = 'The password must contain at least 6 characters.';
            return false;
        }

        if (preg_match('/[A-Z]/', $str) && preg_match('/[a-z]/', $str) && preg_match('/\d/', $str)) {
            return true;
        } else {
            $error = 'The password must contain both upper and lower case letters and numbers.';
            return false;
        }
    }

    public function checkEmailDomain(string $str, string $domain, array $data, string &$error = null): bool {
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@' . preg_quote($domain, '/') . '$/', $str)) {
            $error = 'Only emails from the domain @' . $domain . ' are accepted.';
            return false;
        }

        return true;
    }

    // possible -> to validate if the email is unique in the database:
    
    // possible -> to validate if the password corresponds to the email in the database:
}
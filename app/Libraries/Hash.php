<?php 

namespace App\Libraries;

class Hash {
    public function encrypt($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function decrypt($password, $dbPassword)
    {
        if (password_verify($password, $dbPassword)) {
            return true;
        }
        
        return false;
    }
}

<?php

require 'Database.php';

class User extends Database{

    public function store($request){ // to actions/regisiter.php

        # assign a variable to hold the data from the form
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $password = $request['password'];

        # encrpyt the password
        // PASSWORD BCRYPT
        $password = password_hash($password, PASSWORD_DEFAULT);

        # create the query
        $sql = "INSERT INTO users (first_name, last_name, username, password)
                VALUES ('$first_name', '$last_name', '$username', '$password')";

        # execute the query
        if($this->conn->query($sql)){
            header('location: ../views');
            exit;
        }else{
            die('Error creating the user: ' . $this->conn->error);
        }
    }
}

?>
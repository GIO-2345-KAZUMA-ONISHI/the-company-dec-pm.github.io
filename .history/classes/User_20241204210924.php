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

    public function login($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        # check the username
        if($result->num_rows == 1){
            # check if the password is correct
            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])){
                #create session variables
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

                header('location: ../views/dashboard/php');
                exit;
            }else{
                die('Password is incorrect');
            }
        }else{
            die('Username not found.')
        }
    }
}

?>
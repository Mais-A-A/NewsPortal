<?php

    class Auth {
        public function login($email, $password){

        }

    }
    session_start();
    require 'config.php'; 

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($row['password'] === $password) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'author') {
                header("Location: author-dashboard.php");
            } 
            elseif ($row['role'] == 'editor') {
                // echo "editor";
                header("Location: editor-dashboard.php");
            } elseif ($row['role'] == 'admin') {
                header("Location: admin-dashboard.php");
            }
            exit;
        } else {
            $_SESSION['error'] = 1;
            header("Location: login-form.php");
            exit;

        }
    } else {
        $_SESSION['error'] = 1;
        header("Location: login-form.php");
        exit;
    }
?>

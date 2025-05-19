<?php 

    session_start();
    
    if(isset($_SESSION['id']) && isset($_SESSION['role']) && ($_SESSION['role'] =='author' || $_SESSION['role'] =='admin')) {
       
       
        require 'config.php';

        $title = $_POST["title"];
        $body = $_POST["body"];
        $image = $_POST["image"];
        $category_id = $_POST["category_id"];
        $author = $_SESSION['id'];
        echo $title . $body . $category_id  ;

        $sql = "INSERT INTO news (title, body, image, category_id, author_id) 
            VALUES ('$title', '$body', '$image', $category_id, $author)";

        $result = $conn->query($sql);

        if ($result === TRUE ) {
            header("Location: author-dashboard.php");
            exit; 
        } 
    } else {
        // echo "mais".$_SESSION['role'];

        header('Location: 404.php');
    }
                          

?>
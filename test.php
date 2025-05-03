<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test With Mais </title>
</head>
<body>
    <h1>welcome to php</h1>
    <?php
        $conn = new mysqli("localhost", "root", "", "news_portal");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM user";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo $row['name'] . " - " . $row['email'] . " - " . $row['role'] . "<br>";
        }

    ?> 
</body>
</html>
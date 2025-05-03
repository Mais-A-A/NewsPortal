<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body{
            background-color:  rgb(250, 249, 249);
            text-align : center;
        }
        .tbl{
            margin-top : 20px;
            margin-left : 5%; 
            border : 3px solid rgb(146, 150, 155);
            border-collapse : collapse;
            width:90%;
            box-shadow: 0 0 10px rgb(16, 73, 97);

        }
        .tbl td, .tbl th {
            border: 1px solid  rgb(146, 150, 155);
            padding: 8px;
        }
        tr:nth-child(odd) {
            background-color: rgb(172, 191, 199);
        }
        .author-pannel { 
            margin-left : 1000px;
            display : flex;
            flex-direction : row; 
            justify-content : space-between;  
        }
        .spacial-row {
            background-color: rgb(144, 238, 152);

        }
    </style>
</head>
<body>
    <?php
        require 'config.php';

        session_start();

        if(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){

            $name = $_SESSION['name'];
            echo "<h1 >  $name مرحباً بك  </h1>
            <span class = "."author-pannel"."> 
                <h2> <u>: جميع المستخدمين</u> </h2>
            </span>";


            $row_id = 1;
            $sql = "SELECT id,name, email, role FROM user";

            $result = $conn->query($sql);

            echo "<table class = "."tbl".">";
            echo "<th>الوظيفة</th> <th>الايميل</th> <th>الاسم</th> <th>الرقم</th>";
            
            while($row = $result->fetch_assoc()){
                if($row['id'] == $_SESSION['id']){
                    echo "<tr class ="."spacial-row"."> 
                    <td>".$row['role']."</td>".
                    "<td>".$row['email']."</td>".
                    "<td>".$row['name']."</td>
                    "."<td>". $row_id++ . "</td>"."
                    <tr>";
                } else {
                    echo "<tr> 
                    <td>".$row['role']."</td>".
                    "<td>".$row['email']."</td>".
                    "<td>".$row['name']."</td>
                    "."<td>". $row_id++ . "</td>"."
                    <tr>";
                }
                
            }
        } else {
            header('Location: 404.php');
        }

    ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autho Dashboard</title>
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
            margin-left : 100px;
            margin-right : 100px;
            display : flex;
            flex-direction : row; 
            justify-content : space-between;  
        }
        h1, h2, b{ 
            color : rgb(16, 73, 97);
        }
        button {
            background-color : rgb(172, 191, 199);
            border: 2px solid  rgb(146, 150, 155);
            padding : 7px;
        }

        button:hover {
            background-color : rgb(121, 145, 155);
            cursor: pointer;
        }
    </style>
</head>
<body>

    <?php
        session_start();
        require 'config.php';

        if(isset($_SESSION['id']) && isset($_SESSION['role']) && ($_SESSION['role'] =='author' || $_SESSION['role'] =='admin' )) {

            
            $author_id = $_SESSION['id'];
    

            $name = $_SESSION['name'];
            echo "<h1 > $name مرحباً بك  </h1>
                  <span class = "."author-pannel"."> 
                  <a href="."add-news-form.php"."><button> <b> إضافة خبر جديد<b> <br>➕</button></a>
                  <h2> <u>: الأخبار التي قمت بنشرها</u> </h2>
                  </span>";
    
                  
            // $sql = "SELECT news.*, category.name FROM news JOIN user  join category where category_id = category.id && author_id = user.id && author_id = $author_id" ;
            if($_SESSION['role'] =='admin'){
                    $sql = "SELECT news.*, category.name FROM news JOIN user  join category where category_id = category.id && author_id = user.id " ;

            } else {
                $sql = "SELECT news.*, category.name FROM news JOIN user  join category where category_id = category.id && author_id = user.id && author_id = $author_id" ;

            }
            
            $result =  $conn->query($sql);
            $row_id = 1;
    
            echo "<table class = "."tbl".">";
            echo "<th>رابط الخبر</th><th>الحالة</th> <th>التصنيف</th> <th>تاريخ النشر </th> <th>عنوان الصورة</th> <th>المحتوى </th> <th>العنوان</th> <th>الرقم</th>";
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                
                // echo '<td>
                //     <form action="details.php" method="POST">
                //         <input type="hidden" name="id" value="' . ($row['id']) . '">
                //         <button type="submit">عرض الخبر</button>
                //     </form>
                //     </td>';
                echo '<td> <a href="details.php?id=' . $row['id'] . '"> عرض الخبر</a></td>';




                if($row['status']=='pending'){
                    echo "<td style="."color:gray".">".$row['status']."</td>";
                } else if($row['status']=='approved'){
                    echo "<td style="."color:green".">".$row['status']."</td>";
                } else {
                    echo "<td style="."color:red".">".$row['status']."</td>";
                }

                echo "<td>".$row['name']."</td>".
                "<td>".$row['dateposted']."</td>".
                "<td><a href='" . $row['image'] . "' target='_blank'>" . $row['image'] . "</a></td>".
                "<td>".nl2br(($row['body']))."</td>".
                "<td>".nl2br(($row['title']))."</td>".
                "<td>". $row_id++ . "</td>"

                ."</tr>";
            }
        } else {
            header('Location: 404.php');
        }
        ?>
    

</body>
</html>
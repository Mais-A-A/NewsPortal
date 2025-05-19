<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Dashboard</title>

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
        h1, h2, b{ 
            color : rgb(16, 73, 97);
        }
    </style>
</head>

<body>

<?php

    session_start();
    require 'config.php';

    if(isset($_SESSION['id']) && isset($_SESSION['role']) && ($_SESSION['role'] =='editor' || $_SESSION['role'] =='admin')) {
        $name = $_SESSION['name'];
        echo "<h1 > $name مرحباً بك  </h1>
              <span class = "."author-pannel"."> 
              <h2> <u> : جميع الأخبار  </u> </h2>
              </span>";

        $sql = "SELECT news.*,user.name as usN, category.name FROM news JOIN user  join category where category_id = category.id && author_id = user.id order by news.dateposted DESC " ;
            
        $result =  $conn->query($sql);
        $row_id = 1;
       


        echo "<table class = "."tbl".">";
            echo "<th>التعديل</th><th></th> <th>الحالة</th> <th>التصنيف</th> <th>تاريخ النشر </th> <th>عنوان الصورة</th> <th>المحتوى </th> <th>العنوان</th> <th>الكاتب</th><th>الرقم</th>";
            while($row = $result->fetch_assoc()){
                 $new_id = $row['id'];
                 
                echo "<tr>"."
                <td> 
                    <a href='update-news-status.php?action=approve&id=$new_id'><button>✔️ قبول</button></a>
                    <a href='update-news-status.php?action=denied&id=$new_id'><button>❌ رفض</button></a>
                    <a href='update-news-status.php?action=delete&id=$new_id'><button>🗑️ حذف</button></a>


                        
                <td>";

                
                // echo "<td>".$row['status']."</td><tr>";
                
                // echo "<tr><td>
                //     <td> 
                //     <form method="."POST" ."action="."update-news-status.php".">
                //         <button class="."approve" ."name="."action" ."value="."approve".">✔️ قبول</button>
                //         <button class="."deny" ."name="."action" ."value="."deny".">❌ رفض</button>
                //         <button class="."delete" ."name="."action" ."value="."delete" ."onclick="."return confirm('هل أنت متأكد من الحذف؟');".">🗑️ حذف</button>
                //     </form> 
                // <td>
                // </td>";

                

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
                "<td>".$row['body']."</td>".
                "<td>".$row['title']."</td>".
                "<td>".$row['usN']."</td>".

                "<td>". $row_id++ . "</td>";

            }
    } else {
        // echo "noooooooooooo";
        header('Location: 404.php');
    }


?> 
    
</body>
</html>
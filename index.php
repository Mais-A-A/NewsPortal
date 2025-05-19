<?php   

    session_start(); 
    require 'config.php'; 

    

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            font-family: 'Sakkal Majalla';
            margin: 0px;
            padding: 0px
        }
        .header { 
            background-color:rgba(15,20,50,255);
            /* display: flex; */
            color: white;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .right-nav{
            display: flex;
            flex-direction: row;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            float: right;
            padding-top: 5px;
            margin-top: 40px;
            margin-right: 70px;
            margin-bottom: 50px;
        }
        .weather-search{
            align-items: center;
            display: flex;
            flex-direction: row;
            float:left;
            margin-left: 170px;
            margin-top: 10px;

        }
        .weather { 
            margin-right:20px;
            padding-right: 10px;
            align-items: center;
            display: flex;
            flex-direction: row;
            border-right: 2px solid gray;
            font-size: x-small;
        }
        .search-bar {
            border-left : 2px solid gray;
            padding-left:10px
        }
        .search{
            padding-right: 7px;
            text-align: right;
            border-radius: 5px;
            /* font-family: 'Almarai', sans-serif; */
            font-family: 'Sakkal Majalla', sans-serif;
            font-weight: bold;
            color: gray;
            font-size: large;
            width: 200px;
            border:0px;
        }
        
        .categories { 
            /* float: right; */
        }
        .categories > li{
            color : white;
            list-style: none;
        }
        

        .second-news > div{
            float: inline-start;
        }

        .body-container{

            margin-left: 12.5%;
            margin-right: 12.5%;
            margin-top: 20px;
            width: 75%;
            height: 3350px;
        }
        .text-dark{
            text-decoration: none;
        }
        .text {
            direction: rtl; 
            text-align: right;
            /* font-family: 'Almarai', sans-serif; */
            font-family: 'Sakkal Majalla', sans-serif;
            font-weight:bold;
        }
        .row {
            --bs-gutter-x: 0px;
        }

        .card{
            padding : 5px;
        }
        .card-title{
            font-size: 14px; 
            color: gray;
        }
        .auto-news{
            margin-bottom : 70px
        }
        .cat-title{
            display: flex;
            justify-content: space-between;
            margin-right: 5px;
            margin-left: 5px;
            font-family: 'Sakkal Majalla', sans-serif;
            font-weight:bolder;
            /* border-bottom: 2px solid gray; */
        }
        .more-link{
            text-decoration: none;
        }
        .more-title{
            padding-bottom: 6px;
            font-family: 'Sakkal Majalla', sans-serif;
            font-weight:bolder;
            border-bottom: 2px solid blue;
            /* display: inline-block;
            width: 6rem;
            display: block; */
        }
        .list-content{
            display: flex;
            flex-direction: column;
        }
        .one-new{
            display: flex;
            justify-content: space-between;
        }
        .numbers{
            font-family: 'Sakkal Majalla', sans-serif;
            font-size: 50px;
            font-weight: bolder;
            color: rgb(224, 217, 217);
        }
        .most-read-and-more{
            margin-bottom: 20px;
        }
        
    </style>
    

</head>

<body>
    
    <header>
        <div class="header">
            <div class="weather-search">
                <div class="weather">
                    <div style="display: flex;flex-direction: column;margin-right: 7px;">
                        <span>21°C</span>
                        <span>الدوحة</span>
                    </div>
                    <div><img src="cloudy.png" alt="weather icon" style="width: 15px;height: 15px;"> </div>
                    <!-- <i class="fas fa-sun weather-icon"></i> -->

                </div>

                
                <div class="search-bar">
                    <input class="search" type="text" value="ادخل كلمة للبحث">
                </div>
                
            </div>
            <div class="right-nav">
                <nav class="nav-links">
                    <a href="category.php?id=1" class="text nav-link">رياضة</a>
                    <a href="category.php?id=3"class="text nav-link">صحة</a>
                    <a href="category.php?id=4"  class="text nav-link">اقتصاد</a>
                    <a href="category.php?id=2" class="text nav-link">سياسة</a>
                    <a href="#" class="text nav-link">الرئيسة</a>
                </nav>
                <img src=" goldLogo.png" alt="Logo" style="margin-right:80px;margin-top:30px; max-width: 60px;max-height: 60px;">

            </div>
        </div>
        
    </header>

    <?php 
                        
        $sql = "select news.id, concat(substr(news.title,1,30),'..') as title, news.dateposted, news.image,keywords,concat(substr(body,1,40),'..') as body, category.name  as category_name
                from news
                join category on news.category_id = category.id
                where status ='approved'
                order by news.dateposted desc
                limit 5;"
                ;

        $result = $conn->query($sql);

        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?> 
    <div class="body-container">
        <div class="auto-news">
            <div class="row">
                <div class="col-md-3">
                    
                    <!-- <div class="row"> -->
                        <?php
                        for ($i = 4; $i >= 3 ; $i--) {
                            
                            $id = $data[$i]['id'];
                            $image = $data[$i]['image'];
                            $title = $data[$i]['title'];
                            $keywords = $data[$i]['keywords'];
                            $body = $data[$i]['body'];
                            $cat = $data[$i]['category_name'];

                            echo '<div class="row">
                                <a href="details.php?id=' . $id . '" class="card text-decoration-none border-0">
                                    <img src="' . $image . '" alt="Image 2" style="width: 300px; height: 133px;">
                                    <div class="card-body">
                                        <h6 class="card-title text">' . $cat . ' - ' . $keywords . '</h6>
                                        <p class="card-text text">' . $title . '</p>
                                    </div>
                                </a>
                            </div>';
                        }
                        ?>
                </div>
                <!--  -->
                <div class="col-md-3">
                        <?php
                        for ($i = 2; $i >= 1 ; $i--) {
                            
                            $id = $data[$i]['id'];
                            $image = $data[$i]['image'];
                            $title = $data[$i]['title'];
                            $keywords = $data[$i]['keywords'];
                            $body = $data[$i]['body'];
                            $cat = $data[$i]['category_name'];

                            echo '<div class="row">
                                <a href="details.php?id=' . $id . '" class="card text-decoration-none border-0">
                                    <img src="' . $image . '" alt="Image 2" style="width: 300px; height: 133px;">
                                    <div class="card-body">
                                        <h6 class="card-title text">' . $cat . ' - ' . $keywords . '</h6>
                                        <p class="card-text text">' . $title . '</p>
                                    </div>
                                </a>
                            </div>';
                        }
                        ?>
                </div>
                <?php
                    $id = $data[0]['id'];
                    $image = $data[0]['image'];
                    $title = $data[0]['title'];
                    $keywords = $data[0]['keywords'];
                    $body = $data[0]['body'];
                    $cat = $data[0]['category_name'];
                ?>
                <div class="col-md-6 ">
                    <a href="details.php?id=<?php echo $id;?>" class="card text-decoration-none border-0">
                        <img src="<?php echo $image;?>"  alt="Image 2">
                        <div class="card-body" style="background-color:rgba(15,20,50,255);color: white; height: 180px;">
                            <p style="color:white;" class="card-title text"> <?php echo $cat," - ". $keywords; ?></h5>
                            <h4 class="card-text text"> <?php echo $title;?></p>
                            <p style="font-size:17px;" class="card-text text"><?php echo $body;?></h5>
                        </div>
                    </a>
                </div>

            </div>
        </div> 



        <div class="most-read-and-more">
            
            <div class="row">
                <div class="col-md-8">
                    

                        <div style="display: flex;flex-direction: column; margin-right:20px">
                            <div class="cat-title ">
                                <a class="more-link" href="#">المزيد</a>
                                <h3 class="more-title">المزيد من الاخبار</h3>

                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="row">
                                        <?php
                                        $sql = "SELECT news.id, news.title, substr(news.body,1,300) as body, news.image, category.name as category_name
                                                FROM news
                                                JOIN category ON news.category_id = category.id
                                                WHERE news.status = 'approved'
                                                ORDER BY news.dateposted DESC
                                                LIMIT 3";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $newsItems = $result->fetch_all(MYSQLI_ASSOC);
                                                $item = $newsItems[0];
                                                $item2 = $newsItems[1];
                                                $item3 = $newsItems[2];

                                        ?>
                                        
                                        <a href="details.php?id=<?= $item['id'] ?>" class="card text-decoration-none border-0">
                                            <div class="card-body">
                                                <h4 class="card-title text"><?= ($item['category_name']) ?></h4>
                                                <p class="card-text text"><?= ($item['title']) ?></p>
                                            </div>
                                            <img src="<?= ($item['image']) ?>" style="margin-left:100px; width: 200px; height: 100px;" alt="News Image">
                                        </a>
                                    </div>
                                    <div class="row">
                                         <a href="details.php?id=<?= $item2['id'] ?>" class="card text-decoration-none border-0">
                                            <div class="card-body">
                                                <h4 class="card-title text"><?= ($item2['category_name']) ?></h4>
                                                <p class="card-text text"><?= ($item2['title']) ?></p>
                                            </div>
                                            <img src="<?= ($item2['image']) ?>" style="margin-left:100px; width: 200px; height: 100px;" alt="News Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="details.php?id=<?= $item3['id'] ?>" class="card text-decoration-none border-0">
                                        <img src="<?= ($item2['image']) ?>"  alt="Image 2">
                                        <div class="card-body">
                                            <h6 class="card-title text"> <?= $item3['title'] ?></h5>
                                            <p class="card-text text">
                                                <?= $item3['body'] ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        

                    </div>
                </div>
               <div class="col-md-4 list-content">
                    <div>
                        <h3 class="more-title text-end" style="float: right;">الأكثر قراءة</h3>
                        <br>
                        <hr>
                    </div>
                    <div>
                        <div class="text row" id="most-read-container">
                        </div>
                    </div>
                </div>


            </div>
        </div>

         <div class="auto-news first">
            
             <div class="cat-title ">
                    <a class="more-link" href="category.php?id=4">المزيد</a>
                    <h3 class="more-title">اقتصاد </h3> 
            </div>
            <div class="row">
                <div class="col-md-3">
         <?php

        $sql = "SELECT news.id, news.title, news.image, body as body, category.name AS category_name, news.keywords
        FROM news
        JOIN category ON news.category_id = category.id
        WHERE news.status = 'approved' AND news.category_id = 4
        ORDER BY news.dateposted DESC
        LIMIT 5";

        $result = $conn->query($sql);

        $newsItems = [];
        if ($result && $result->num_rows > 0) {
            $newsItems = $result->fetch_all(MYSQLI_ASSOC);
        }


        for ($i = 0; $i < 2; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            echo '<div class="row">
        <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
            <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
            <div class="card-body">
                <h6 class="card-title text">' . $item['category_name'] . '</h6>
                <p class="card-text text">' . $item['title'] . '</p>
            </div>
        </a>
    </div>';

        }
        ?>
    </div>

    <div class="col-md-3">
        <?php
        for ($i = 2; $i < 4; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            
            echo '<div class="row">
                    <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
                        <div class="card-body">
                            <h6 class="card-title text">' . $item['category_name'] . '</h6>
                            <p class="card-text text">' . $item['title'] . '</p>
                        </div>
                    </a>
                </div>';
        }
        ?>
    </div>

    <div class="col-md-6 ">
        <?php
        if (isset($newsItems[4])) {
            $item = $newsItems[4];
            echo '<a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2">
                        <div class="card-body" style="background-color:white;color: black; height: 180px;">
                            <p class="card-title text">' . $item['category_name'] . ' - '.$item['keywords'].'</p>
                            <h4 class="card-text text">' . $item['title'] . '</h4>
                            <p style="font-size:17px;" class="card-text text">' . substr($item['body'], 0, 800) . '..</p>
                        </div>
                    </a>';
        }
        ?>
    </div>
    </div>
    </div> 
     <div class="auto-news first">
            
             <div class="cat-title ">
                    <a class="more-link" href="category.php?id=2">المزيد</a>
                    <h3 class="more-title">سياسة </h3> 
            </div>
            <div class="row">
                <div class="col-md-3">
         <?php

        $sql = "SELECT news.id, news.title, news.image, body as body, category.name AS category_name, news.keywords
        FROM news
        JOIN category ON news.category_id = category.id
        WHERE news.status = 'approved' AND news.category_id = 2
        ORDER BY news.dateposted DESC
        LIMIT 5";

        $result = $conn->query($sql);

        $newsItems = [];
        if ($result && $result->num_rows > 0) {
            $newsItems = $result->fetch_all(MYSQLI_ASSOC);
        }


        for ($i = 0; $i < 2; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            echo '<div class="row">
        <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
            <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
            <div class="card-body">
                <h6 class="card-title text">' . $item['category_name'] . '</h6>
                <p class="card-text text">' . $item['title'] . '</p>
            </div>
        </a>
    </div>';

        }
        ?>
    </div>

    <div class="col-md-3">
        <?php
        for ($i = 2; $i < 4; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            
            echo '<div class="row">
                    <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
                        <div class="card-body">
                            <h6 class="card-title text">' . $item['category_name'] . '</h6>
                            <p class="card-text text">' . $item['title'] . '</p>
                        </div>
                    </a>
                </div>';
        }
        ?>
    </div>

    <div class="col-md-6 ">
        <?php
        if (isset($newsItems[4])) {
            $item = $newsItems[4];
            echo '<a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2">
                        <div class="card-body" style="background-color:white;color: black; height: 180px;">
                            <p class="card-title text">' . $item['category_name'] . ' - '.$item['keywords'].'</p>
                            <h4 class="card-text text">' . $item['title'] . '</h4>
                            <p style="font-size:17px;" class="card-text text">' . substr($item['body'], 0, 800) . '..</p>
                        </div>
                    </a>';
        }
        ?>
    </div>
</div>
    </div> 
     <div class="auto-news first">
            
             <div class="cat-title ">
                    <a class="more-link" href="category.php?id=1">المزيد</a>

                    <h3 class="more-title">رياضة </h3> 
            </div>
            <div class="row">
                <div class="col-md-3">
         <?php

        $sql = "SELECT news.id, news.title, news.image, body as body, category.name AS category_name, news.keywords
        FROM news
        JOIN category ON news.category_id = category.id
        WHERE news.status = 'approved' AND news.category_id = 1
        ORDER BY news.dateposted DESC
        LIMIT 5";

        $result = $conn->query($sql);

        $newsItems = [];
        if ($result && $result->num_rows > 0) {
            $newsItems = $result->fetch_all(MYSQLI_ASSOC);
        }


        for ($i = 0; $i < 2; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            echo '<div class="row">
        <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
            <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
            <div class="card-body">
                <h6 class="card-title text">' . $item['category_name'] . '</h6>
                <p class="card-text text">' . $item['title'] . '</p>
            </div>
        </a>
    </div>';

        }
        ?>
    </div>

    <div class="col-md-3">
        <?php
        for ($i = 2; $i < 4; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            
            echo '<div class="row">
                    <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
                        <div class="card-body">
                            <h6 class="card-title text">' . $item['category_name'] . '</h6>
                            <p class="card-text text">' . $item['title'] . '</p>
                        </div>
                    </a>
                </div>';
        }
        ?>
    </div>

    <div class="col-md-6 ">
        <?php
        if (isset($newsItems[4])) {
            $item = $newsItems[4];
            echo '<a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2">
                        <div class="card-body" style="background-color:white;color: black; height: 180px;">
                            <p class="card-title text">' . $item['category_name'] . ' - '.$item['keywords'].'</p>
                            <h4 class="card-text text">' . $item['title'] . '</h4>
                            <p style="font-size:17px;" class="card-text text">' . substr($item['body'], 0, 800) . '..</p>
                        </div>
                    </a>';
        }
        ?>
    </div>
</div>
    </div> 
     <div class="auto-news first">
            
             <div class="cat-title ">
                    <a class="more-link" href="category.php?id=3">المزيد</a>
                    <h3 class="more-title">صحة </h3> 
            </div>
            <div class="row">
                <div class="col-md-3">
         <?php

        $sql = "SELECT news.id, news.title, news.image, body as body, category.name AS category_name, news.keywords
        FROM news
        JOIN category ON news.category_id = category.id
        WHERE news.status = 'approved' AND news.category_id = 3
        ORDER BY news.dateposted DESC
        LIMIT 5";

        $result = $conn->query($sql);

        $newsItems = [];
        if ($result && $result->num_rows > 0) {
            $newsItems = $result->fetch_all(MYSQLI_ASSOC);
        }


        for ($i = 0; $i < 2; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            echo '<div class="row">
        <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
            <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
            <div class="card-body">
                <h6 class="card-title text">' . $item['category_name'] . '</h6>
                <p class="card-text text">' . $item['title'] . '</p>
            </div>
        </a>
    </div>';

        }
        ?>
    </div>

    <div class="col-md-3">
        <?php
        for ($i = 2; $i < 4; $i++) {
            if (!isset($newsItems[$i])) break;
            $item = $newsItems[$i];
            
            echo '<div class="row">
                    <a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2" style="width: 300px; height: 133px;">
                        <div class="card-body">
                            <h6 class="card-title text">' . $item['category_name'] . '</h6>
                            <p class="card-text text">' . $item['title'] . '</p>
                        </div>
                    </a>
                </div>';
        }
        ?>
    </div>

    <div class="col-md-6 ">
        <?php
        if (isset($newsItems[4])) {
            $item = $newsItems[4];
            echo '<a href="details.php?id=' . $item['id'] . '" class="card text-decoration-none border-0">
                        <img src="' . $item['image'] . '" alt="Image 2">
                        <div class="card-body" style="background-color:white;color: black; height: 180px;">
                            <p class="card-title text">' . $item['category_name'] . ' - '.$item['keywords'].'</p>
                            <h4 class="card-text text">' . $item['title'] . '</h4>
                            <p style="font-size:17px;" class="card-text text">' . substr($item['body'], 0, 800) . '..</p>
                        </div>
                    </a>';
        }
        ?>
    </div>
</div>
    </div> 
      
    <footer class="footer bg-light text-dark text-end">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-4" style="padding-right:100px;">
                    <h5 style="font-family: 'Sakkal Majalla', sans-serif;font-weight:bold;">اتصل بنا</h5>
                    <div style="justify-content: left;">
                        <a href="#" class="text-dark mx-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-dark mx-2"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
    
                <div class="col-md-3 mt-4 text-end" style="padding-right:100px;"> 
                    <h5 style="font-family: 'Sakkal Majalla', sans-serif; font-weight:bold;">عن الموقع</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text text-dark">من نحن</a></li>
                        <li><a href="#" class="text text-dark">اعلن معنا</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mt-4 text-end" style="padding-right:100px;">
                    <h5 style="font-family: 'Sakkal Majalla', sans-serif; font-weight: bold;">روابط</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text text-dark text-decoration">سياسة</a></li>
                        <li><a href="#" class="text text-dark text-decoration">اقتصاد</a></li>
                        <li><a href="#" class="text text-dark text-decoration">فن وثقافة</a></li>
                        <li><a href="#" class="text text-dark text-decoration">رياضة</a></li>
                        <li><a href="#" class="text text-dark text-decoration">منوعات</a></li>
                    </ul>
                </div>
    
                <div class="col-md-3 d-flex flex-column align-items-center text-end" > 
                    <img src=" goldLogo.png" alt="Logo" style="max-width: 100px;">
                    <p class="text" style="width: 300px;">تغطية إخبارية شاملة ومتعددة الوسائط للأحداث العربية والعالمية. ويتيح الوصول إلى شبكة متنوعة من البرامج السياسية والاجتماعية</p>
                </div>
    
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
        function loadMostRead() {
            $.ajax({
                url: 'get_most_read.php',
                type: 'GET',
                success: function(data) {
                    $('#most-read-container').html(data);
                },
                error: function() {
                    $('#most-read-container').html('<p>حدث خطأ أثناء تحميل الأخبار.</p>');
                }
            });
        }

        loadMostRead();

        setInterval(loadMostRead, 6000); // 
    });

    
</script>

</body>
</html>
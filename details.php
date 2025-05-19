<?php   

    session_start(); 
    require 'config.php'; 

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id === null) {
        echo "هناك مشكلة أعد المحاولة! ";
        exit;
    }

    $sql = "SELECT * FROM news WHERE id = '$id'";
    $result = $conn->query($sql);


    $sql = "SELECT * FROM news WHERE id = '$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
         $status = $row['status'];
        // echo $status;
        if($status !== 'approved' && !isset($_SESSION['id'])){
            header('Location: login-form.php');
            exit();
        }

        $cat_id = $row['category_id']; //>> cat id 

        
        $news_title = $row['title'];
        $body = $row['body'];
        $image = $row['image'];
        $date = date("Y-m-d", strtotime($row['dateposted']));
        $keyword = $row['keywords'];

        $sql = "SELECT cat.name FROM category cat, news WHERE cat.id = news.category_id && news.id = $id ";
        $result = $conn->query($sql);
        $new_row = $result->fetch_assoc();
        $cat  = $new_row['name'];

        
            
    }
   
    

            
    
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            font-family: 'Sakkal Majalla', sans-serif;

        }

        .small-title {
            font-size: 17px;
            color: #6c757d;
            font-weight: bold;
        }

        .news-title {
            font-size: 28px;
            font-weight: bolder ;
            color: #212529;
        }

        .news-image {
            width: 100%;
            height: auto;
        }

        .image-caption {
            padding: 5px;
            font-size: 13px;
            background-color: rgb(209, 209, 209);
            margin-top: -1px;
            text-align: right;
            width: 100%;
        }

        .font-controls {
            display: flex;
            align-items: center;
            justify-content: right;
            margin-top: 10px;
            gap: 10px;
        }

        .font-controls button {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        .sidebar {
            padding: 15px;
            border-radius: 5px;
            height: 100%;
            font-size: 16px;
            font-family: 'Tajawal', sans-serif;
            color: #212529;
        }

        .ad-banner {
            width: 100%;
            height: auto;
            margin: 15px 0;
        }

        .related-news {
            margin-top: 20px;
            font-size: 17px;
            font-family: 'Tajawal', sans-serif;
            color: #212529; 
        }

        /* .related-news h5,.sidebar h5 {
            color: black;
            font-weight: bold;
            font-size: 20px;
            padding-bottom: 5px;
            border-bottom: 2px solid blue;
        } */
        .section-title{
            border-bottom: 2px solid blue;
        }
        .related-news img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .related-news a,
        .sidebar a {
            text-decoration: none;
            color: #212529;
        }

        .share-icons a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: black;
            color: white;
            font-size: 16px;
            margin-left: 8px;
            text-decoration: none;
        }

        .news-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .news-list li i {
            color: #212529;
            margin-left: 8px;
            margin-top: 3px;
        }

        .ad-container {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
        }

        .ad-banner {
            width: 100%;
            height: auto;
        }

        .ad-text {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }
        .one-new{
            display: flex;
            justify-content: space-between;
            color : black;
            text-decoration : none;
            cursor: pointer;
            font-size : 17px;
            font-weight:bold;
            color: rgb(95, 93, 93);
        }
        .more-title{
            padding-bottom:17px;
            font-family: 'Sakkal Majalla', sans-serif;
            font-size: large;
            font-weight:bold;
            border-bottom: 2px solid blue;
            color: gray;
        }
        .list-content{
            display: flex;
            flex-direction: column;
        }
        .body-content {
            font-size : 18px;
            font-weight : bold;
        }
    </style>
</head>

<body>
    
    <div class="container mt-4">
        <div class="row">
            <main class="col-md-9">
                <p class="small-title"> <?php echo $cat ." - " . $keyword; ?></p>
                <h1 class="news-title"> <?php echo nl2br(($news_title)); ?></h1>
                <p class="text-muted" style="font-size: 14px; color: #6c757d;"><i class="bi bi-calendar"></i><?php echo " " . $date ?> </p>
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h6 class="fw-bold">شارك القصة</h6>
                    <div class="share-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                        <a href="#"><i class="bi bi-share-fill"></i></a>
                    </div>
                </div>
                <img src="<?php echo $image ?>" class="news-image" alt="أحداث غزة">
                <p class="image-caption"><!-- --></p> 
                <div class="font-controls">
                    <button id="increase-font"><i class="bi bi-plus-circle"></i></button>
                    <span>الخط</span>
                    <button id="decrease-font"><i class="bi bi-dash-circle"></i></button>
                </div>
                <p> 
                    <?php 
                        $content = nl2br(($body));
                        echo "<p class="."body-content"." id="."body-content"."> $content</p>" 
                    ?>
                </p>
                <div class="col-md-12 list-content">
                    <div>
                        <h3 class="more-title text-end" style="float: right;">اقرا ايضاً </h3>
                        <br>
                        <hr>
                    </div>
                    
                    <div>
                        <?php 
                            $sql = "select news.id, title, image, concat(substr(body,1,60),'..') as body from news, category where news.category_id = $cat_id and news.id != $id and status = 'approved' limit 3" ;
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                
                                $id_read_more = $row['id'];
                                $title = $row['title'];
                                $body = $row['body'];

                                echo '<a class="one-new" href="details.php?id=' . $id_read_more. '">  <p>'. $title .':'. $body .' </p> </a> <hr>';


                                // echo "<a class="."one-new"." href=".'/details.php/?id=' . $id_read_more  . ">
                                //         <p> $title : $body </p>
                                        
                                //       </a> <hr>";

                            }
                        ?>
                    </div>
            </div>
            </main>
            <aside class="col-md-3 sidebar">
                
                <div>
                    <h3 class="more-title text-end" style="float: right;color: black;"><?php echo " المزيد من ". $keyword ;?></h5>
                    <br>
                    <hr>
                </div>
                <ul class="list-unstyled news-list ">
                    <?php 
                        // $sql = "select news.id, substr(title,1,60) as title, image, concat(substr(body,1,60),'..') as body from news, category where news.category_id = $cat_id and news.id != $id limit 3" ;

                        $sql = "select news.id, substr(news.title,1,60) as title, concat(substr(news.body,1,5), '..') as body
                                from news
                                join category on news.category_id = category.id
                                where news.category_id = $cat_id and news.id != $id and news.keywords = '$keyword'
                                limit 3";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()){
                            $idd = $row['id'];
                            $title = $row['title'];
                            $body = $row['body'];

                            // echo '<a href="details.php?id=' . $idd. '">  <p>'. $title .'.'. $body .' </p> </a> ';

                            echo '<li>
                                    <i class="bi bi-diamond-fill" style="color: rgb(9, 9, 100);"></i>
                                    <a href="details.php?id=' . $idd. '">  <p>'. $title .':'. $body .' </p> </a></li>';
                        }
                    ?>
                </ul>

                <div class="ad-container">
                    <img src="ad-banner.jpg" class="ad-banner" alt="إعلان">
                    <div class="ad-text">إعلان</div>
                </div>
                <div class="section-title-container mt-4">
                    <!-- <h5 class="section-title">مواضيع ذات صلة</h5> -->
                    <div>
                        <h3 class="more-title text-end" style="float: right;color: black;">مواضيع ذات صلة</h5>
                        <br>
                        <hr>
                    </div>
                </div>

                <!-- maisssssssssssssssssss do this :::: done  -->
                <div class="related-news">
                    <?php 
                        $sql = "select news.id,  substr(title,1,60) as title, keywords, image from news, category where news.category_id = $cat_id and news.id != $id and status = 'approved' limit 3" ;
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            
                            $id = $row['id'];
                            $title = $row['title'];
                            $image = $row['image'];
                            $keykey = $row['keywords'];
                                // <a href="details.php?id=' . $idd. '">  <p>'. $title .':'. $body .' </p> </a>                                </li>';

                            echo '<div class="row mb-2" style="margin: 0; padding: 0;">
                                        <a href="details.php/?id=' . $id . '" class="card text-decoration-none border-0" style="flex-direction: row; display: flex; align-items: start; padding: 5px;">
                                            <img src="' . $image . '" style="width: 105px; height: 82px; object-fit: cover; margin-left: 8px;" class="img-fluid" alt="خبر متعلق">
                                            <div class="card-body p-0">
                                                <h6 class="card-title text mb-1" style="font-size: 14px; color: #555;">' . $cat . '</h6>
                                                <p class="card-text text" style="font-size: 15px; color: #000; font-weight: bold; ">'. $title . $keykey .'</p>
                                            </div>
                                        </a>
                                    </div>';

                        }
                    ?>
                </div>
                <div>
                    <div class="ad-container">
                        <img src="ad-banner.jpg" class="ad-banner" alt="إعلان">
                        <div class="ad-text">إعلان</div>
                    </div>
                    </div>
                </div>
                
            </aside>

           
        </div>
        
    </div>
    <script src="font.js"></script>

</body>
</html>

<?php   

    session_start(); 
    require 'config.php'; 

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id === null) {
        echo "هناك مشكلة أعد المحاولة! ";
        exit;
    }

    if ($id <1 || $id >4) {
        header('Location: 404.php');
        exit;
    }
    

    $sql = "SELECT  name FROM category   WHERE id = $id limit 1";
    $result = $conn->query($sql);

        
    $row = $result->fetch_assoc();
    $cat = $row['name'];

    // echo $cat;
    // $count = mysqli_num_rows($result); 
    // echo "عدد النتائج: " . $count;
    

    
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .section-title {
            color: gray;
            font-size: 1rem;
            font-weight: bold;
        }
        *{
            font-family: 'Sakkal Majalla', sans-serif;
            font-weight: bolder;
        }
        .more-title{
            padding-bottom:6px;
            font-family: 'Sakkal Majalla', sans-serif;
            border-bottom: 2px solid blue;
        }
        .ad-container {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
        }
        .content{
            text-decoration : none;
            color : black;
        }
    </style>
</head>
<body>
    
    <div class="container mt-4">
        <div style="margin-bottom: 30px;">
            <h3 class="more-title text-end" style="float: right;color: black;"><b> <?php echo $cat; ?></b></h5>
            <br>
            <hr>
        </div>
        <!-- <h2 class="mb-3"><b>رياضة</b></h2>
        <hr> -->
        <?php 
            $sql = "select new.id as id, keywords, new.image as image, concat((substr(title,1,70)),'..') as title, new.id as new_id,
                    concat(substr(new.body, 1, 80),'..') as body, cat.name as cat, new.dateposted
                    from news new
                    join category cat on new.category_id = cat.id
                    where new.category_id = '$id' and new.status = 'approved'
                    order by new.dateposted desc;";

            $result = $conn->query($sql);

            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            // $cnt=0;
            // $count = mysqli_num_rows($result); 
            // echo "عدد النتائج: " . $count;


                // while( $row = $result->fetch_assoc()){
                //     $row = $result->fetch_assoc()
                //     $image = $row['image'];
                //     $title = $row['title'];
                //     $keywords = $row['keywords'];
                //     $body = $row['body'];

                // }
           
        ?> 
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0">
                    <?php 

                        $row_id = $data[0]['new_id'];
                        $image = $data[0]['image'];
                        $title = $data[0]['title'];
                        $keywords = $data[0]['keywords'];
                        $body = $data[0]['body'];
                         
                    ?>

                    <a class="content" href ="details.php?id= <?php echo $row_id; ?>">
                        <img src='<?php  echo $image;?>'s class="img-fluid" alt="Big News" style="width:100%;">
                        <div>
                            <div class="section-title"> <?php echo $cat; ?> -  العالم  </div>
                            <h5><b>
                                <?php echo $title;?> 
                                </b></h5>
                            <p style="color: gray;"> <?php echo $body."..";?> </p>
                        </div>
                    </a>

                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-3 card border-0">
                    <?php 

                       $row_id = $data[1]['new_id'];
                        $image = $data[1]['image'];
                        $title = $data[1]['title'];
                        $keywords = $data[1]['keywords'];
                        $body = $data[1]['body'];
                         
                    ?>
                    
                    <a class="content" href ="details.php?id= <?php echo $row_id; ?>">
                    <img src="<?php echo $image ;?>"class="img-fluid" alt="News 1">
                    <div>
                        <div class="section-title"> <?php echo $cat ." - ".  $keywords ;?> </div>
                        <h4> <?php echo $title ;?></h4>
                        <p style="color: gray;"><?php echo $body."..";?></p>
                    </div>
                    </a>    
                </div>

                <div class="mb-3 d-flex flex-row align-items-center">
                    <?php 

                       $row_id = $data[2]['new_id'];
                        $image = $data[2]['image'];
                        $title = $data[2]['title'];
                        $keywords = $data[2]['keywords'];
                        $body = $data[2]['body'];
                         
                    ?>
                    <a href ="details.php?id= <?php echo $row_id; ?>" class="card text-decoration-none border-0" style="flex-direction: row; display: flex; align-items: start; padding: 5px;">

                        <img src="<?php echo $image;?>" class="img-fluid" alt="News 2" style="width: 40%; height: auto;">
                        <div style="margin-right:10px;width: 60%;">
                            <div class="section-title"> <?php echo $cat ." - ".  $keywords ;?> </div>
                            <p><?php echo $title ;?></p>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-row align-items-center mb-3">

                    <?php 

                       $row_id = $data[3]['new_id'];
                        $image = $data[3]['image'];
                        $title = $data[3]['title'];
                        $keywords = $data[3]['keywords'];
                        $body = $data[3]['body'];
                         
                    ?>
                    <a href ="details.php?id= <?php echo $row_id; ?>" class="card text-decoration-none border-0" style="flex-direction: row; display: flex; align-items: start; padding: 5px;">

                        <img src="<?php echo $image;?>" class="img-fluid" alt="News 3" style="width: 40%; height: auto;">
                        <div style="margin-right:10px;width: 60%;">
                                <div class="section-title"> <?php echo $cat ." - ".  $keywords ;?> </div>
                                <p><?php echo $title ;?></p>
                        </div>

                    </a>

                    
                </div>
                

                
            </div>
            
        </div>


        <div class="row mt-4">
            <div class="col-md-6">

            <?php 
                for ($i = 4; $i < count($data); $i++) {
                    $row = $data[$i];
                    $image = $row['image'];
                    $idd = $row['id'];
                    // echo $row['title'];

                  echo '
                     <a href="details.php/?id=' . $idd . '" class="content">
                    <div class="mb-3 d-flex flex-row align-items-center">
                        <img src="' . $image . '" class="img-fluid" alt="News 4" style="margin-left: 10px; width: 40%; height: auto;">
                        <div style="width: 60%;">
                                    <div class="section-title" style="font-size: 14px; color: #555;">' . $cat . ' - ' . $keywords . '</div>
                            <div class="section-title">' . $row['title'] . '</div>
                            <p>' . $row['body'] . '</p>
                        </div>
                    </div></a>';


                }


            ?> 
               
            </div>
        </div>

        
    </div>
</body>
</html>
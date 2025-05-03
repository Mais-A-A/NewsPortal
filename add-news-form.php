<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة خبر جديد</title>
    <style>
        body {
            background-color:  rgb(245, 245, 245);
            color : rgb(16, 73, 97);
            font-size: 16px;
        }

        .container {
            width: 500px;
            margin: 20px auto;
            background: white;
            padding : 10px 40px 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgb(16, 73, 97);
        }

        h1 {
            text-align: center;
            color : rgb(16, 73, 97);
        }

        label {
            font-weight: bold;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="submit"] {
            background-color: rgb(16, 73, 97);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color:rgb(121, 158, 170);
        }

        a {
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color : rgb(16, 73, 97);
        }
    </style>
</head>
<body>

<div class="container">
    
    <?php 
        session_start();
        require 'config.php';

        if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role'] !=='author') {
            header('Location: 404.php');
            exit;
        }
    ?>
    <h1>إضافة خبر جديد</h1>
    
    <form action ="add-new.php" method="POST">
        <label>عنوان الخبر:</label>
        <input type="text" name="title" required>

        <label>محتوى الخبر:</label>
        <textarea name="body" rows="5" required></textarea>

        <label>رابط الصورة:</label>
        <input type="text" name="image" required>

        <label>التصنيف:</label>
        <select name="category_id" required>
            <option value="" disabled>-- اختر تصنيفاً --</option>
            <?php 
                $categories = $conn->query("SELECT * FROM category");
                while ($cat = $categories->fetch_assoc()) { ?>
                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="إضافة الخبر">
    </form>

</div>

</body>
</html>

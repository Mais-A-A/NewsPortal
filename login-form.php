<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f0f0f0;
      direction: rtl;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 30px 40px;
      width: 350px;
    }

    h2 {
      text-align: center;
      color: rgb(16, 73, 97);
    }

    label {
      display: block;
      margin-top: 15px;
      color: rgb(16, 73, 97);
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 10px;
      margin-top: 25px;
      background-color: rgb(16, 73, 97);
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0e4c64;
    }
    .error {
        position: absolute;
        top: 30px;
        right: auto;
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px 20px;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
        font-size: 16px;
    }
  </style>
</head>
<body>

    <div class="login-box">
        <h2>تسجيل الدخول</h2>

        <form action="login.php" method="POST">
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" name="email" required>

            <label for="password">كلمة المرور:</label>
            <input type="password" name="password" required>

            <button type="submit">دخول</button>
        </form>
        
    </div>
    <?php 
        session_start(); 
        if(isset($_SESSION['error'])) {
            // echo "<script>alert('invalid email or password');</script>";
            echo "<div class="."error".">كلمة المرور أو  الايميل  ليست صحيحة ! </div>";
            unset($_SESSION['error']);
        } 
    ?>

</body>
</html>

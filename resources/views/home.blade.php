<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngân Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #0044cc;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
        }
        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        .login-form h2 {
            text-align: center;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #218838;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Ngân Hàng ABC</h1>
</header>

<nav>
    <a href="#">Trang Chủ</a>
    <a href="#">Dịch Vụ</a>
    <a href="#">Vay Tiền</a>
    <a href="#">Hỗ Trợ</a>
</nav>

<div class="container">
    <div class="login-form">
        <h2>Đăng Nhập</h2>
        <form action="#" method="POST">
            <input type="text" name="username" placeholder="Tên người dùng" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Ngân Hàng ABC | Tất cả quyền lợi được bảo lưu.</p>
</footer>

</body>
</html>

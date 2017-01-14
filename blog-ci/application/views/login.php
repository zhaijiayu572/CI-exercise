<base href="<?php echo site_url()?>">
<meta charset="utf-8">
<head>
    <link rel="stylesheet" href="resource/css/login.css">
    <script src="resource/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<form action="index.php/User/do_login" method="post">
    用户名:<input type="text" name="user"><br>
    密码: <input type="password" name="pass"><br>
    <input type="submit" name="sub" value="登录">
</form>
</body>
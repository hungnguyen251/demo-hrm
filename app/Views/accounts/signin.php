<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatile" content="IE=edge" />
    <link rel="stylesheet" href="{{ __WEB__ROOT . '/public/dist/css/login.css' }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="./assets/fonts_icon/flag-icons-main/css/flag-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </head>
    <title>Login</title>
</head>
<body>
<section>
    <div class="img-bg">
        <img src="https://images.pexels.com/photos/2662116/pexels-photo-2662116.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Hình Ảnh Minh Họa">
    </div>
    <div class="noi-dung">
        <div class="form">
        <h2>Trang Đăng Nhập</h2>
            <form action="<?php echo __WEB__ROOT; ?>/account/check/login" method="post" enctype="">
                <div class="input-form">
                    <span>Email Người Dùng</span>
                    <input type="text" name='email' placeholder="Nhập email" value="<?php echo oldData('email'); ?>"></br>
                    <?php echo formError('email', '<span style="color:red;">','</span>') ;?></br>
                </div>
                
                <div class="input-form">
                    <span>Mật Khẩu</span>
                    <input type="password" name='password' placeholder="Nhập mật khẩu"></br>
                    <?php echo formError('password', '<span style="color:red;">','</span>') ;?></br>
                </div>

                <div class="input-form">
                    <input type="submit" value="Đăng Nhập">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
<?php
var_dump($_SESSION);
?>
<form action="<?php echo __WEB__ROOT; ?>/account/checkLogin" method="post">
    <input type="text" name='email' placeholder="Nhập email" value="<?php echo oldData('email'); ?>"></br>
    <?php echo formError('email', '<span style="color:red;">','</span>') ;?></br>
    <input type="password" name='password' placeholder="Nhập mật khẩu"></br>
    <?php echo formError('password', '<span style="color:red;">','</span>') ;?></br>
    <button type="submit">Submit</button>
</form>
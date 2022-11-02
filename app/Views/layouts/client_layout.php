<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM</title>
</head>
<body>
    <?php
    $this->render('blocks/header');
    $this->render('blocks/navbar');
    $this->render('blocks/sidebar');
    // $this->render($content,$sub_content);
    $this->render('homes/dashboard');
    $this->render('blocks/footer');
    $this->render('blocks/scripts');
    ?>
</body>
</html>
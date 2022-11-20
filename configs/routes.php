<?php

$routes['default_controller'] = 'home';
$routes['trang-chu'] = 'home';
$routes['trang-chu/thong-ke'] = 'home/index';

$routes['tai-khoan'] = 'account/index';
$routes['tai-khoan/them'] = 'account/create';
$routes['tai-khoan/sua'] = 'account/edit';
$routes['tai-khoan/xoa'] = 'account/destroy';

$routes['cong-ty'] = 'company';

$routes['thong-bao'] = 'notification';
$routes['thong-bao/xoa'] = 'notification/destroy';
$routes['thong-bao/thao-tac'] = 'notification/changeStatus';
$routes['thong-bao/them'] = 'notification/create';

$routes['phong-ban'] = 'department';

$routes['giai-thuong'] = 'reward';
$routes['giai-thuong/them'] = 'reward/create';
$routes['giai-thuong/sua'] = 'reward/edit';
$routes['giai-thuong/xoa'] = 'reward/destroy';

// $routes['nhan-vien'] = 'staff';
// $routes['nhan-vien/danh-sach'] = 'staff/index';

// $routes['giai-thuong'] = 'reward';
// $routes['giai-thuong/danh-sach'] = 'reward/index';

// $routes['bang-cap'] = 'diploma';
// $routes['bang-cap/danh-sach'] = 'diploma/index';

// $routes['luong'] = 'salary';

// $routes['cong-ty'] = 'company';

//...Add routes[$key]
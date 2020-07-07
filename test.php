<?php
require('user-pdo.php');

$user = new userpdo("ididid", "hu", "hu@gmail.com", "pu");

echo $user->getLogin();

var_dump($user);


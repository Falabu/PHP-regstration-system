<?php
require  'config/config.php';

$user = new UserController();

$user->register("falabuds","daviddddd@greef.hu","sssaaa","sssaaa");



echo errorLogger::getUserMessages();
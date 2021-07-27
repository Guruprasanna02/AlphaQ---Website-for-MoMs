<?php
session_start();
session_unset();
session_destroy();

setcookie('unamecookie', '', time() - 86400);
setcookie('passcookie', '', time() - 86400);
header('location:index.php');

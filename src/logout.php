<?php

require "../src/lib/common.php";

session_start();
logout();
redirectAndExit("/");
?>

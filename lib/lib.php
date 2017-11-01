<?php

include "../lib/User.php";
$user = new User();
$user->getUserByEmail("admin@markt.com");

?>
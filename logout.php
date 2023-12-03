<?php
require_once "utils/config.php";
require_once "controllers/login-controller.php";

logout(true);
header("Location: login.php");
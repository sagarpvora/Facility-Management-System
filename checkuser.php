<?php

include("config/config.php");
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}
?>
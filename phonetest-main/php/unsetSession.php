<?php
include "connect.php";
unset($_SESSION["user"]);
session_unset();
header("location: ../index.php");

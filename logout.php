<?php
//!Important don't remove!
require 'config/body.php';
include_once 'config/conn.php';
include_once 'config/header2.php';

session_start();
session_destroy();
header("location:inlog.php");

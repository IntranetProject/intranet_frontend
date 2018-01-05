<?php
session_start();

include '../../php/config.php';

exec("cd ../../");
exec("git init");
exec("git pull");

header("Location: ../stats.php");
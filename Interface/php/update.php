<?php
session_start();

include '../../php/config.php';

exec("git init");
exec("git pull");
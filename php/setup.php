<?php
/*
 *
 *	SETUP SCRIPT. 
 *	1. Initialize Database connection
 *
 */
include 'config.php';

$db_host = $__database_host;
$db_db = $__database;
$db_user = $__database_user;
$db_passwd = $__database_password;

$link = new mysqli($db_host, $db_user, $db_passwd, $db_db);
if ($link->connect_errno > 0) {
    die("Can't connect to Database! Check login credentials!" . $link->connect_errno);
}

if(!(empty($_POST['submit']))) {
  $_name = $link->real_escape_string($_POST['name']);
  $_loginname = $link->real_escape_string($_POST['loginname']);
  $_password = md5($link->real_escape_string($_POST['password']));
} else {
	header('Location: ' . $network_path);
}

/*
 *
 *	CREATE users TABLE!!
 *
 */

$_sql = "CREATE TABLE IF NOT EXISTS `users` (
 `id` int(100) NOT NULL AUTO_INCREMENT,
 `login` varchar(50) NOT NULL,
 `password` varchar(100) NOT NULL,
 `name` varchar(50) NOT NULL,
 `img_url` varchar(50) NOT NULL,
 `rank` varchar(5) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1";
$_res = $link->query($_sql);
$sql = "INSERT INTO `users` (`login`, `password`, `name`, `ìmg_url`, `rank`) VALUES (`" . $_loginname . "`, `" . $_password . "`, `" . $_name . "`, `img/" . $_loginname . ".png`, `admin`);"
$res = $link->query($sql);

/*
 *
 *	CREATE system_vars_en TABLE!!
 *
 */
$sql = "CREATE TABLE IF NOT EXISTS `system_vars_en` 
  ( 
     `var`   TEXT NOT NULL, 
     `value` TEXT NOT NULL 
  ) 
engine=innodb 
DEFAULT charset=latin1; ";
$res = $link->query($sql);

$sql = "INSERT INTO `system_vars_en` (`var`, `value`) VALUES
('system_index_togglefullscreen', 'Toggle Fullscreen'),
('system_index_settings', 'Settings'),
('system_index_logout', 'Logout'),
('system_index_dashboard', 'Dashboard'),
('system_settings_title', 'Settings'),
('system_settings_privatetitle', 'Profile Settings'),
('system_settings_privatdesc', 'Here can you change your Profile (more options will follow with more features)'),
('system_settings_save', 'Save!'),
('system_settings_pictitle', 'Profile picture'),
('system_settings_picdesc', 'Change your Profilepicture here!'),
('system_settings_usermanagment', 'User Managment'),
('system_settings_usermanagmentdesc', 'These options are only available for admins.'),
('system_settings_usermanagment_adduser', 'Create an new user:'),
('system_settings_usermanagment_userlisttitle', 'Users:'),
('system_settings_usermanagment_userlistsmall', 'A list of all users:'),
('system_setup_desc', '<p>It looks like your visiting the first time. You need to setup the Databases or have our script doing it for you. Just put in your MySQL-Logindata below and click on setup!<br>This will only create the tables that are nessesarry for the basic system. <br> For every module you have to run their special initial script! </p>'),
('system_setup_title', 'First Steps'),
('system_setup_logindesc', 'Enter the credentials for the admin user!'),
('system_setup_timeinformation', 'Start Setup! <small>Setup can take a while. Please stay patient!</small>'),
('system_setup_configinfo', 'Attention! You have to set your MySQL credentials in the config.php (Folder: /php/config.php) first! Otherwise the setup will not work!<br> After the setup is completed you can login with your credentials down below <br> After that you can create more users. <br> Visit: <a href=''#''>the documentation</a> for more information.');";
$res = $link->query($sql);

/*
 *
 *	CREATE system_vars_de TABLE!!
 *
 */
$sql = "CREATE TABLE IF NOT EXISTS `system_vars_de` 
  ( 
     `var`   TEXT NOT NULL, 
     `value` TEXT NOT NULL 
  ) 
engine=innodb 
DEFAULT charset=latin1;";
$res = $link->query($sql);

$sql = "INSERT INTO `system_vars_de` (`var`, `value`) VALUES
('system_index_togglefullscreen', 'Vollbild Modus aktivieren'),
('system_index_settings', 'Einstellungen'),
('system_index_logout', 'Abmelden'),
('system_index_dashboard', 'Startseite'),
('system_settings_title', 'Einstellungen'),
('system_settings_privatetitle', 'Profileinstellungen'),
('system_settings_save', 'Speichern!'),
('system_settings_privatdesc', 'Hier kannst du dein Profil einrichten (mehr Optionen kommen mit mehr Features)'),
('system_settings_pictitle', 'Profilbild'),
('system_settings_picdesc', 'Hier kannst du dein Profilbild ändern!'),
('system_settings_usermanagment', 'Benutzer Verwaltung'),
('system_settings_usermanagmentdesc', 'Diese Optionen sind nur für Administatoren verfügbar'),
('system_settings_usermanagment_adduser', 'Einen Benutzer hinzufügen:'),
('system_settings_usermanagment_userlisttitle', 'Benutzer'),
('system_settings_usermanagment_userlistsmall', 'Hier ist eine Liste mit allen Benutzern'),
('system_setup_desc', '<p>Es sieht aus als würdest du das erste mal diese Seite besuchen. Entweder richtest du die wichtigen Datenbanken ein, oder du lässt das unser Script machen. Gib'' einfach deine MySQL-Logindaten unten ein und bestätige.<br>Dieser Vorgang erstellt nur die Tabellen für das System. Für jedes Modul muss ein extra Script ausgeführt werden! </p>;'),
('system_setup_title', 'Erste Schritte'),
('system_setup_logindesc', 'Gib hier die Daten für deinen Admin Benutzer ein!'),
('system_setup_timeinformation', 'Starten! <small>Der Vorgang kann eine Augenblick in Anspruch nehmen, bleib entspannt!</small>'),
('system_setup_configinfo', 'Achtung! Du musst als erstes in der config.php (Odner: /php/config.php) die MySQL-Daten eintragen! Sonst wird das Setup nicht funktionieren! <br> Nach dem Setup wirst du dich mit deinen unten angegebenen Daten einloggen können. <br> Dann kannst du weitere Benutzer erstellen. <br> Besuche: <a href=''#''>the documentation</a> für mehr Information.');";
$res = $link->query($sql);

header('Location: ' . $network_path);
?>

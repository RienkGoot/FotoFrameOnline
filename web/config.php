<?php

use Symfony\Component\Yaml\Yaml;

// Check php version
$php_version=phpversion();
if($php_version<5)
{
    echo "PHP versie is $php_version - Fout";
}
else echo "PHP versie is: $php_version - Goed";

// Check if sessions is enabled
$_SESSION['myscriptname_sessions_work']=1;
if(empty($_SESSION['myscriptname_sessions_work']))
{
    echo "Sessies staat uit - Fout";
}
else echo "<br>Sessies staat aan - Goed";

// Check if safe mode is active
if( ini_get("safe_mode") )
{
    echo "Safe mode staat aan - Fout";
}
else echo "<br>Safe mode staat uit - Goed";

// Check if mail is active
if(!function_exists('mail'))
{
    echo "Mail functie staat uit - Fout";
}
else echo "<br>Mail functie staat aan - Goed";
?>
    <br>
    <br>

    <form method="post">
        Database host: <input type="text" name="host"><br>
        Database user: <input type="text" name="user"><br>
        Database name: <input type="text" name="name"><br>
        Database wachtwoord: <input type="password" name="password"><br>
        <br>
        Site beheerder gebruikersnaam: <input type="text" name="site-user"><br>
        Site beheerder wachtwoord: <input type="password" name="site-password"><br>
        <input type="submit"><br>
        Na installatie verwijder dit bestand:<input name="delete" type="submit" value="Verwijderen">
    </form>

<?php
// try to connect to the DB, if not display error
if(!@mysqli_connect($_POST['host'],$_POST['user'],$_POST['password']))
{

    echo "Kan geen connectie maken:".mysqli_error();
}
else echo "Connectie gemaakt!";

// Create the tables
if (!empty($_POST['host'])){
    $db_link=mysqli_connect($_POST['host'],$_POST['user'],$_POST['password'],$_POST['name']);
    $q="CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);


    $q="CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `category_subcategory` (
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `frame` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_width` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_height` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `subcategory_frame` (
  `subcategory_id` int(11) NOT NULL,
  `frame_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `background_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `menu_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `menu_font_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `panel_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `panel_font_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);

    $q="CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    mysqli_query($db_link,$q);


    $q="INSERT INTO `app_users` (`id`, `username`, `password`, `email`, `is_active`) VALUES
(1, '".$_POST['site-user']."', ''".$_POST['site-password']."'', '', 1);";
    mysqli_query($db_link,$q);

    $q="INSERT INTO `configuration` (`id`, `logo`, `background_color`, `menu_color`, `menu_font_color`, `panel_color`, `panel_font_color`) VALUES
(1, 'cb4c2d0fca4697e2b486bf094ecf5c6d.png', '#dbdbdb', '#0080ff', '#ffffff', '#0080ff', '#ffffff');";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `frame`
  ADD PRIMARY KEY (`id`);";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `subcategory_frame`
  ADD PRIMARY KEY (`subcategory_id`,`frame_id`);";
    mysqli_query($db_link,$q);

    $q="ALTER TABLE `category_subcategory`
  ADD PRIMARY KEY (`category_id`,`subcategory_id`);";
    mysqli_query($db_link,$q);

    echo "<br>Database succesvol geinstalleerd!";
}

// Write DB data to parameters.yml
$array = array(
    'database_host' => $_POST['host'],
    'database_name' => $_POST['name'],
    'database_user' => $_POST['user']
);

$yaml = Yaml::dump($array);

file_put_contents('/../app/config/parameters.yml', $yaml);

// Delete file onclick delete button
if(isset($_POST['delete']))
{
    unlink('config.php');
}
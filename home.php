<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once 'db.php';


if(isset($_POST['logout']))
{

  $user->logout();
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>home</title>
</head>

<body>

<div class="header">
    <div class="right">
     <label><a href="index.php"><i class="glyphicon glyphicon-log-out"><button type="submit" name="logout"></i> logout</button></a></label>
    </div>
</div>
<div class="content">
Welcome. You are logged in.
</div>
</body>
</html>

<?php



ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


require_once 'db.php';
//setting start value of the session
$_SESSION['user_session'] = false;
//if logged in() is not empty redirect to home page
if($user->is_loggedin()!="")
{
 $user->redirect('home.php');
}
//on submitting form redirect to home.php
if(isset($_POST['btn-login']))
{
  $uname = $_POST['txt_uname'];
  $upass = $_POST['txt_upass'];

    if($user->login($uname, $upass))
    {
      $user->redirect('home.php');
      $_SESSION['user_session'] = true;
    }
 else
 {
  $error = "Wrong data !";
 }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post" action=" " name="login">
            <h2>Sign in</h2><hr />

            <?php
            //if user inserts incorrect data error message displays
            if(isset($error))
            {
                  ?>
                  <div class="error message">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_uname" placeholder="Username" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_upass" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Sign in
               </button>
            </div>
            <br />
            <label>No account?<a href="register.php">Sign Up</a></label>
        </form>
       </div>
</div>

</body>
</html>

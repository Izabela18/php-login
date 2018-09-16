<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once 'db.php';

//on submitting verify with all the below conditions
if(isset($_POST['btn-signup']))
{
  //removing white spaces
   $uname = trim($_POST['rg_uname']);
   $upass = trim($_POST['rg_upass']);

   if($uname=="") {
      $error[] = "new username !";
   }
   else if($upass=="") {
      $error[] = "new password !";
   }
   else if(strlen($upass) < 6){
      $error[] = "Password must be at least 6 characters";
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT user_name FROM users WHERE user_name=:uname");
         $stmt->execute(array(':uname'=>$uname));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
//if it is the same as the one already existing in the database, give a message
         if($row['user_name']==$uname) {
            $error[] = "Choose another username. This is already taken!";
         }

         else
         {
           //if properly entered redirect first to header url with 'joined' info
            if($user->register($uname,$upass))
            {
                $user->redirect('register.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {//foreach loop for any errors specified above
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="rg_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>

            <div class="form-group">
             <input type="password" class="form-control" name="rg_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>Already have an account? <a href="index.php">Sign In</a></label>
        </form>
       </div>
</div>

</body>
</html>

<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
//creating  a new class with all functions necessary
class User
{ //creating new variable responsible for connection with the database, it is available for all next functions inside this class because function_construct is used
    private $db;

    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
//first register function with inserted data as arguments
    public function register($uname,$upass)
    {
       try
       {
//inserting values to users table with columns user_name, user_pass

           $stmt = $this->db->prepare("INSERT INTO users(user_name, user_pass) VALUES(:uname, :upass)");
//binding these values with the function's arguments
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":upass", $upass);
           $stmt->execute();

           return $stmt;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }
//creating login function
    public function login($uname, $upass)
    {
      //if OK select proper values from users' table, limit to only 1 result
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname AND user_pass=:upass LIMIT 1");

          $stmt->execute(array(':uname'=>$uname, ':upass'=>$upass));
      //defining one userrow with results from users' table
          return $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
//if this found is greater than 0, assign it id with a session
          if($userRow->rowCount() > 0)

          {

               $_SESSION['user_session'] = $userRow['user_id'];
               return true;
          }
          else
          {
               return false;
          }

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
//defining new function for the state of being logged in
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']) && ($_SESSION['user_session']))
      {

        return true;

      }

}
//defining redirect function, which redirects to a proper page
   public function redirect($url)
   {
       header("Location: $url");
   }
//defining logout function where session is unser and destroyed
   public function logout($user_id)
   {
        unset($_SESSION['user_session']);
        session_destroy();
        return true;
   }
}
?>

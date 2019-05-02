<?php
function startSession($authorized, $firstName, $lastName, $level)
{
  session_start();
  if(!isset($_SESSION['authorized']))
  {
    $_SESSION['authorized'] = true;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['level'] = $level;
  }
  }


function checkSession()
{
  session_start();
  if(!isset($_SESSION['authorized']))
  {
    header("Location: login.php");
  }
}


?>

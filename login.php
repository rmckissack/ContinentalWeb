<?php
$pageID = "home";

require_once('f_initialize.php');
function problem($message)
{
  $pageID = "home";
  // require("meta_queries.php");
  require('public_header.inc');
  echo "<h1>It seems we have a problem</h1>\n";
  echo "<p>$message ";
  echo "Please <a href=\"$thisScript\">try again</a>.</p>\n";
  require('public_footer.inc');
  die();
}

if(!$_POST) {

  $login = [];
  $login['username'] = '';
  $login['enteredPassword'] = '';







} else {

  $enteredUsername = e($_POST['enteredUsername']);
  $enteredPassword = e($_POST['enteredPassword']);
  $dbUserData = dbUserData($enteredUsername);
    if(!$dbUserData) {
      problem("The username/password combination you entered are incorrect. ");
    }
  $firstName = $dbUserData['firstName'];
  $lastName = $dbUserData['lastName'];
  $email = $dbUserData['email'];
  $dateAdded = $dbUserData['dateAdded'];
  $time = $dbUserData['time'];
  $active = $dbUserData['active'];
  $dbPassword = $dbUserData['password'];
  $level = $dbUserData['level'];
  $passwrodMD5 =  md5($time . $enteredPassword . $dateAdded);

if($dbPassword != $passwrodMD5) {
  problem("The username/password combination you entered are incorrect. ");
}
else
{
$authorized = true;
startSession($authorized, $firstName, $lastName, $level);

  $page_title = 'User Login';
  include('staff_header.php');

echo <<<HEREDOC

<h1>Welcome $firstName</h1>
<p>Please select a page from the menu above.</p>
<p>Have a great day.</p>

HEREDOC;
include('staff_footer.php');

die();
}

}


$page_title = 'User Login';
$pageID = "home";
// require("meta_queries.php");
include('public_header.inc');

echo <<<HERELOGIN
<div id="form">

  <div class="page new">
    <h1>Please log in</h1>

    <form action=$thisScript method="post" autocomplete="off">

      <dl>
        <dt>Username</dt>
        <dd><input type="text" id="username" name="enteredUsername" autofocus /></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="password" id="password" name="enteredPassword" /></dd>
      </dl>

      <div id="operations">
        <input type="button" name="home" value="Home" onclick="window.location.href = 'index.php';" />
        <input type="reset" name="reset" value="Clear" />
        <input type="submit" value="Sign In" />
      </div>
    </form>
  </div>

</div>
HERELOGIN;

include('public_footer.inc'); ?>

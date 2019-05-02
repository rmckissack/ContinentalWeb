<?php
  if(!isset($page_title)) {
    $page_title = 'Staff Area';
  }

$thisScript  = htmlspecialchars($_SERVER['PHP_SELF']);

if(!isset($_SESSION['authorized'])) {
 checkSession();
}

$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$level = $_SESSION['level'];

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Continental Quality - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="600" />

    <link rel="stylesheet" media="all" href="staff.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>

  <body>
  <div id="content">





    <header>
      <img src="images/CQELogoB.png" id="logo" alt="Continental Logo">

    </header>

<?php
// echo $_SESSION['level'];
$customer =  "display: none;";
$admin =  "display: none;";
$logout = "display: none;";
$staffMenu = "display: inline;";
if($level == "1")
{
$customer =  "display: inline;";
$logout = "display: inline;";
$staffMenu = "display: none;";
}
if($level == "5")
{
$logout = "display: inline;";
$staffMenu = "display: inline;";
}
if($level == "9")
{
$customer =  "display: inline;";
$logout = "display: inline;";
$admin =  "display: inline;";
$staffMenu = "display: inline;";
}
/* echo <<<HEREDOC
    <div class="menu">
      <ul class="menu">
        <li><button onclick="goBack()">Previous Page</button></li>
        <li><button onclick="window.location.href = 'index.php';">Home Page</button></li>
        <li style="$customer"><button onclick="window.location.href = 'customer_reports.php';">Customer Reports</button></li>
        <li style="$admin"><button onclick="window.location.href = 'admin_reports.php';">Admin Reports</button></li>
        <li style="$admin"><button onclick="window.location.href = 'administration.php';">Administration</button></li>
        <li style="$logout"><button onclick="window.location.href = 'killsession.php';">Log Out</button></li>
      </ul>
    </div>

HEREDOC;
*/

?>

<?php require_once('f_initialize.php');







$page_title = 'Customer Reports';
include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="1") {
  header("Location: noaccess.php");
}

echo <<<HEREDOC
  <h1>$page_title</h1>
  <p>This section is where the customer will be able to access reports on progress of their jobs.</p>
  <p>This section is still under development</p>

HEREDOC;
include('staff_footer.php'); ?>

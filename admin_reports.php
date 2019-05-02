<?php require_once('f_initialize.php');



$page_title = 'Admin Reports';
include('staff_header.php');

if($_SESSION['level'] !="9") {
  header("Location: noaccess.php");
}

echo <<<HEREDOC
  <h1>$page_title</h1>
  <p>This section is where the administrators will be able to access special reports not available to anyone else.</p>
  <p>This section is still under development</p>
  <a class="action" href="r_tally.php">Tally Detail Report</a>

HEREDOC;
include('staff_footer.php'); ?>

<?php require_once('f_initialize.php');







$page_title = 'Restricted';
include('staff_header.php');

echo <<<HEREDOC
  <h1>$page_title</h1>
  <p>I am sorry, it appears your access level is preventing you from viewing this page.</p>
  <p>If you feel this in error please contact the site administrator.</p>




HEREDOC;
include('staff_footer.php'); ?>

<?php
  ob_start(); // output buffering is turned on


  require_once('f_functions.php');
  require_once('f_database.php');
  require_once('f_query_functions.php');
  require_once('f_insert_functions.php');
  require_once('f_session.php');
  require_once('f_report.php');


  $db = db_connect();

?>

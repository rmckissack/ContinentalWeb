<?php require_once('f_initialize.php');







$page_title = 'Administration';
include('staff_header.php');


if($_SESSION['level'] !="9") {
  header("Location: noaccess.php");
}

echo <<<HEREDOC
  <h1>$page_title</h1>
  <p>This section is where the administrators will be able to access special options for maintaining the system.</p>
  <p>This section is still under development but here are a couple of links.</p>
  <ul>
    <li><a href="employee_index.php">Employee List</a></li>
    <li><a href="employee_new.php">Add Employee</a></li>
    <li><a href="user_new.php">Add User</a></li>
  </ul>



HEREDOC;
include('staff_footer.php'); ?>

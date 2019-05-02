<?php
require_once("f_initialize.php");

$employee_list = find_all_employees(); // get list of employees for drop down list


while($name1 = mysqli_fetch_assoc($employee_list)) {
    echo '<option value="' . h($name1['EmployeeID']) .'">' . h($name1['LastName']) . ', ' . h($name1['FirstName']) . '</option>';
    }

?>
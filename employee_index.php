<?php require_once('f_initialize.php');


  $employee_list = find_all_employees();



$page_title = 'Employee Admin';
include('staff_header.php');

if($_SESSION['level'] !="9") {
  header("Location: noaccess.php");
}

?>
  <div class="pages listing">
    <h1>Employees</h1>

    <div class="actions">
      <a class="action" href="<?php echo 'employee_new.php'; ?>">Add New Employee</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <!-- <th>First Name</th> -->
        <th>Phone 1</th>
  	    <th>Phone 2</th>
  	    <th>Start Date</th>
  	    <th>Birthday</th>
        <th>&nbsp;</th>
        <!-- <th>&nbsp;</th> -->
        <!-- <th>&nbsp;</th> -->
  	  </tr>

      <?php while($employee = mysqli_fetch_assoc($employee_list)) { ?>
        <tr>
          <td><?php echo h($employee['employeeId']); ?></td>
          <td><a class="action" href="<?php echo 'employee_edit.php?id=' . h(u($employee['employeeId'])); ?>"><?php echo h($employee['lastName']) . ', ' . h($employee['firstName']); ?></a></td>
          <td><?php echo h($employee['cellPhone']); ?></td>
          <td><?php echo h($employee['homePhone']); ?></td>
          <td><?php echo h($employee['startDate']); ?></td>
          <td><?php echo h($employee['dateOfBirth']); ?></td>
          <td><a class="action" href="<?php echo 'employee_edit.php?id=' . h(u($employee['employeeId'])); ?>">View/Edit</a></td>
    	  </tr>
      <?php } ?>
  	</table>


  </div>


<?php include('staff_footer.php'); ?>

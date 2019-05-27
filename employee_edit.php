<?php

require_once('f_initialize.php');


if(is_post_request()) {

  // Handle form values sent by new.php
$update_employee=[];
  $update_employee['employeeId'] = e($_POST['employeeId']);
  $update_employee['lastName'] = e($_POST['lastName']);
  $update_employee['firstName'] = e($_POST['firstName']);
  $update_employee['homePhone'] = e($_POST['homePhone']);
  $update_employee['cellPhone'] = e($_POST['cellPhone']);
  $update_employee['address'] = e($_POST['address']);
  $update_employee['city'] = e($_POST['city']);
  $update_employee['state'] = e($_POST['state']);
  $update_employee['zip'] = e($_POST['zip']);
  $update_employee['startDate'] = e($_POST['startDate']);
  $update_employee['endDate'] = (e($_POST['endDate'])) == "" ? '0000-00-00' : e($_POST['endDate']);
  $update_employee['workStatusId'] = e($_POST['workStatusId']);
  $update_employee['dateOfBirth'] = e($_POST['dateOfBirth']);

$result = update_employee($update_employee);

redirect_to('employee_index.php');
} else if(!isset($_GET['id'])) {
redirect_to('employee_index.php');
} else {

  $employeeId = $_GET['id'];
  $employeeDetail = find_employee_by_id($employeeId);
}
$workStatus = find_all_work_status();
?>

<?php $page_title = 'Edit Employee'; ?>
<?php include('staff_header.php');
if($_SESSION['level'] !="9") {
  header("Location: noaccess.php");
}

?>



  <div class="page new">
    <h1>Edit Details for <?php echo h($employeeDetail['lastName']) . ', ' . h($employeeDetail['firstName']); ?></h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Employee ID</dt>
        <dd><input type="text" name="employeeId" required value="<?php echo h($employeeDetail['employeeId']); ?>" readonly /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="lastName" value="<?php echo h($employeeDetail['lastName']); ?>" /></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="firstName" value="<?php echo h($employeeDetail['firstName']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Phone 1</dt>
        <dd><input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="cellPhone" value="<?php echo h($employeeDetail['cellPhone']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Phone 2</dt>
        <dd><input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="homePhone" value="<?php echo h($employeeDetail['homePhone']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd><input type="text" name="address" value="<?php echo h($employeeDetail['address']); ?>" /></dd>
      </dl>
      <dl>
        <dt>City</dt>
        <dd><input type="text" name="city" value="<?php echo h($employeeDetail['city']); ?>" /></dd>
      </dl>
      <dl>
        <dt>State</dt>
        <dd><input type="text" name="state" value="<?php echo h($employeeDetail['state']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Zip</dt>
        <dd><input type="text" name="zip" value="<?php echo h($employeeDetail['zip']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Start Date</dt>
        <dd><input type="date" name="startDate" value="<?php echo h($employeeDetail['startDate']); ?>" /></dd>
      </dl>
      <dl>
        <dt>End Date</dt>
        <dd><input type="date" name="endDate" value="<?php echo h($employeeDetail['endDate']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Work Status</dt>
        <dd>
          <select required name="workStatusId">
            <option value="" disabled selected>- -Select Status- -</option>
            <?php
            while (($work = mysqli_fetch_assoc($workStatus)) !=null) {
              echo "<option value ='" . h($work['workStatusId']) . "'";
              if ($employeeDetail['workStatusId'] == $work['workStatusId'])
                echo "selected = 'selected'";
                echo ">{$work['workStatus']}</option>";
            }
            ?>
            </select>

        </dd>
      </dl>
      <dl>
        <dt>Birthday</dt>
        <dd>
          <input type="date" name="dateOfBirth" value="<?php echo h($employeeDetail['dateOfBirth']); ?>"/>
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Update Employee" />
      </div>
    </form>

  </div> <!-- page new -->

<?php include('staff_footer.php'); ?>

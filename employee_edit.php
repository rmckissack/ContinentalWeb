<?php

require_once('f_initialize.php');


if(is_post_request()) {

  // Handle form values sent by new.php
$update_employee=[];
  $update_employee['EmployeeID'] = e($_POST['EmployeeID']);
  $update_employee['LastName'] = e($_POST['LastName']);
  $update_employee['FirstName'] = e($_POST['FirstName']);
  $update_employee['HomePhone'] = e($_POST['HomePhone']);
  $update_employee['CellPhone'] = e($_POST['CellPhone']);
  $update_employee['Address'] = e($_POST['Address']);
  $update_employee['City'] = e($_POST['City']);
  $update_employee['State'] = e($_POST['State']);
  $update_employee['Zip'] = e($_POST['Zip']);
  $update_employee['StartDate'] = e($_POST['StartDate']);
  $update_employee['EndDate'] = (e($_POST['EndDate'])) == "" ? '0000-00-00' : e($_POST['EndDate']);
  $update_employee['WorkStatusID'] = e($_POST['WorkStatusID']);
  $update_employee['dob'] = e($_POST['dob']);

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
    <h1>Edit Details for <?php echo h($employeeDetail['LastName']) . ', ' . h($employeeDetail['FirstName']); ?></h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Employee ID</dt>
        <dd><input type="text" name="EmployeeID" required value="<?php echo h($employeeDetail['EmployeeID']); ?>" readonly /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="LastName" value="<?php echo h($employeeDetail['LastName']); ?>" /></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="FirstName" value="<?php echo h($employeeDetail['FirstName']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Phone 1</dt>
        <dd><input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="CellPhone" value="<?php echo h($employeeDetail['CellPhone']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Phone 2</dt>
        <dd><input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="HomePhone" value="<?php echo h($employeeDetail['HomePhone']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd><input type="text" name="Address" value="<?php echo h($employeeDetail['Address']); ?>" /></dd>
      </dl>
      <dl>
        <dt>City</dt>
        <dd><input type="text" name="City" value="<?php echo h($employeeDetail['City']); ?>" /></dd>
      </dl>
      <dl>
        <dt>State</dt>
        <dd><input type="text" name="State" value="<?php echo h($employeeDetail['State']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Zip</dt>
        <dd><input type="text" name="Zip" value="<?php echo h($employeeDetail['Zip']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Start Date</dt>
        <dd><input type="date" name="StartDate" value="<?php echo h($employeeDetail['StartDate']); ?>" /></dd>
      </dl>
      <dl>
        <dt>End Date</dt>
        <dd><input type="date" name="EndDate" value="<?php echo h($employeeDetail['EndDate']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Work Status</dt>
        <dd>
          <select required name="WorkStatusID">
            <option value="" disabled selected>- -Select Status- -</option>
            <?php
            while (($work = mysqli_fetch_assoc($workStatus)) !=null) {
              echo "<option value ='" . h($work['WorkStatusID']) . "'";
              if ($employeeDetail['WorkStatusID'] == $work['WorkStatusID'])
                echo "selected = 'selected'";
                echo ">{$work['WorkStatus']}</option>";
            }
            ?>
            </select>

        </dd>
      </dl>
      <dl>
        <dt>Birthday</dt>
        <dd>
          <input type="date" name="dob" value="<?php echo h($employeeDetail['dob']); ?>"/>
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Update Employee" />
      </div>
    </form>

  </div> <!-- page new -->

<?php include('staff_footer.php'); ?>

<?php

require_once('f_initialize.php');



if(is_post_request()) {

  // Handle form values sent by new.php
$new_employee=[];
  $new_employee['LastName'] = e($_POST['LastName']);
  $new_employee['FirstName'] = e($_POST['FirstName']);
  $new_employee['CellPhone'] = e($_POST['CellPhone']);
  $new_employee['HomePhone'] = e($_POST['HomePhone']);
  $new_employee['Address'] = e($_POST['Address']);
  $new_employee['City'] = e($_POST['City']);
  $new_employee['State'] = e($_POST['State']);
  $new_employee['Zip'] = e($_POST['Zip']);
  $new_employee['StartDate'] = e($_POST['StartDate']);
  $new_employee['EndDate'] = e($_POST['EndDate']);
  $new_employee['WorkStatusID'] = e($_POST['WorkStatusID']);
  $new_employee['dob'] = e($_POST['dob']);

$result = insert_employee($new_employee);

  redirect_to('employee_index.php');
} else {

  $LastName = '';
  $FirstName = '';
  $HomePhone = '';
  $CellPhone = '';
  $Address = '';
  $City = '';
  $State = '';
  $Zip = '';
  $StartDate = '';
  $EndDate = '';
  $WorkStatusID = '';
  $dob = '';

}

$workStatus = find_all_work_status();
?>

<?php $page_title = 'Add Employee'; ?>
<?php include('staff_header.php');
if($_SESSION['level'] !="9") {
  header("Location: noaccess.php");
}

  ?>

  <div class="page new">
    <h1>Enter Employee Details</h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="LastName" required /></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="FirstName" required/></dd>
      </dl>
      <dl>
        <dt>Phone 1</dt>
        <dd>
          <input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="CellPhone"/>
        </dd>
      </dl>
      <dl>
        <dt>Phone 2</dt>
        <dd>
          <input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="HomePhone"/>
        </dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd>
          <input type="text" name="Address"/>
        </dd>
      </dl>
      <dl>
        <dt>City</dt>
        <dd>
          <input type="text" name="City"/>
        </dd>
      </dl>
      <dl>
        <dt>State</dt>
        <dd>
          <input type="text" name="State"/>
        </dd>
      </dl>
      <dl>
        <dt>Zip</dt>
        <dd>
          <input type="text" name="Zip" />
      </dl>
      <dl>
        <dt>Start Date</dt>
        <dd>
          <input type="date" name="StartDate"/>
      </dl>
      <dl>
        <dt>End Date</dt>
        <dd>
          <input type="date" name="EndDate"/>
      </dl>
      <dl>
        <dt>Work Status</dt>
        <dd>
          <select required name="WorkStatusID">
            <option value="" disabled selected>- -Select Status- -</option>
            <?php
            while (($work = mysqli_fetch_assoc($workStatus)) !=null) {
              echo "<option value ='" . h($work['WorkStatusID']) . "'>" . h($work['WorkStatus']) . "</option>";
            }
            ?>
            </select>

        </dd>
      </dl>
      <dl>
        <dt>Birthday</dt>
        <dd>
          <input type="date" name="dob" />
      </dl>



      <div id="operations">
        <input type="submit" value="Add Employee" />
      </div>
    </form>

  </div>


<?php include('staff_footer.php'); ?>

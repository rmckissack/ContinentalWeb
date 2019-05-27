<?php

require_once('f_initialize.php');



if(is_post_request()) {

  // Handle form values sent by new.php
$new_employee=[];
  $new_employee['lastName'] = e($_POST['lastName']);
  $new_employee['firstName'] = e($_POST['firstName']);
  $new_employee['cellPhone'] = e($_POST['cellPhone']);
  $new_employee['homePhone'] = e($_POST['homePhone']);
  $new_employee['address'] = e($_POST['address']);
  $new_employee['city'] = e($_POST['city']);
  $new_employee['state'] = e($_POST['state']);
  $new_employee['zip'] = e($_POST['zip']);
  $new_employee['startDate'] = e($_POST['startDate']);
  $new_employee['endDate'] = e($_POST['endDate']);
  $new_employee['workStatusId'] = e($_POST['workStatusId']);
  $new_employee['dateOfBirth'] = e($_POST['dateOfBirth']);

$result = insert_employee($new_employee);

  redirect_to('employee_index.php');
} else {

  $lastName = '';
  $firstName = '';
  $homePhone = '';
  $cellPhone = '';
  $address = '';
  $city = '';
  $state = '';
  $zip = '';
  $startDate = '';
  $endDate = '';
  $workStatusId = '';
  $dateOfBirth = '';

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
        <dd><input type="text" name="lastName" required /></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="firstName" required/></dd>
      </dl>
      <dl>
        <dt>Phone 1</dt>
        <dd>
          <input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="cellPhone"/>
        </dd>
      </dl>
      <dl>
        <dt>Phone 2</dt>
        <dd>
          <input type="tel" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" maxlength="12" placeholder="888-888-8888" name="homePhone"/>
        </dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd>
          <input type="text" name="address"/>
        </dd>
      </dl>
      <dl>
        <dt>City</dt>
        <dd>
          <input type="text" name="city"/>
        </dd>
      </dl>
      <dl>
        <dt>State</dt>
        <dd>
          <input type="text" name="state"/>
        </dd>
      </dl>
      <dl>
        <dt>Zip</dt>
        <dd>
          <input type="text" name="zip" />
      </dl>
      <dl>
        <dt>Start Date</dt>
        <dd>
          <input type="date" name="StartDate"/>
      </dl>
      <dl>
        <dt>End Date</dt>
        <dd>
          <input type="date" name="endDate"/>
      </dl>
      <dl>
        <dt>Work Status</dt>
        <dd>
          <select required name="workStatusId">
            <option value="" disabled selected>- -Select Status- -</option>
            <?php
            while (($work = mysqli_fetch_assoc($workStatus)) !=null) {
              echo "<option value ='" . h($work['workStatusId']) . "'>" . h($work['workStatus']) . "</option>";
            }
            ?>
            </select>

        </dd>
      </dl>
      <dl>
        <dt>Birthday</dt>
        <dd>
          <input type="date" name="dateOfBirth" />
      </dl>



      <div id="operations">
        <input type="submit" value="Add Employee" />
      </div>
    </form>

  </div>


<?php include('staff_footer.php'); ?>

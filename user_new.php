<?php

require_once('f_initialize.php');
$thisScript  = htmlspecialchars($_SERVER['PHP_SELF']);


if(is_post_request()) {

$time = (int) date("His");
$date = (int) date("Ymd");

  // Handle form values sent by new.php
$new_user=[];
  $new_user['username'] = e($_POST['UserName']);
  $new_user['firstName'] = e($_POST['FirstName']);
  $new_user['lastName'] = e($_POST['LastName']);
  $new_user['email'] = e($_POST['EmailAddress']);
  $new_user['dateAdded'] = $date;
  $new_user['time'] = $time;
  $new_user['active'] = $_POST['Active'];
  $new_user['password'] = md5($time . $_POST['password'] . $date);
  $new_user['level'] = e($_POST['AccessLevel']);


$result = insert_user($new_user);

  redirect_to('administration.php');
} else {

  $UserName = '';
  $FirstName = '';
  $LastName = '';
  $EmailAddress = '';
  $DateAdded = '';
  $Time = '';
  $Active = '1';
  $AccessLevel = '0';

}


$page_title = 'Add user';
include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>


  <div class="page new">
    <h1>Enter User Details</h1>

    <form action="<?php echo $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Username</dt>
        <dd>
          <input type="text" maxlength="15" name="UserName" required/>
        </dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd>
          <input type="password" name="password" id="pw1" required />
        </dd>
      </dl>
      <dl>
        <dt>Confirm Password</dt>
        <dd>
          <input type="password" name="password" id="pw2" required />
        </dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" maxlength="15" name="LastName" required /></dd>
      </dl>
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" maxlength="15" name="FirstName" required/></dd>
      </dl>
      <dl>
        <dt>Email Address</dt>
        <dd>
          <input type="email" maxlength="25" name="EmailAddress"/>
        </dd>
      </dl>
      <dl>
        <dt>Active</dt>
        <dd><input type="checkbox" id="Active" name="Active" value="1" <?php echo ($Active == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Access Level</dt>
        <dd>
          <select name="AccessLevel">
            <option selected value="0">No Access</option>
            <option value="1">Customer Access</option>
            <option value="5">Employee Access</option>
            <option value="9">Full Access</option>
          </select>
        </dd>
      </dl>


      <div id="operations">
        <input type="submit" value="Add user" />
        <input type="reset"  name="reset"  value="Clear" />
      </div>
      <p id="msg"></p>
    </form>

  </div>
  <script src="check_password.js"></script>


<?php include('staff_footer.php'); ?>

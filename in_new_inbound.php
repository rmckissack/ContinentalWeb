<?php

require_once('f_initialize.php');

if(is_post_request()) {

  $inbound = [];
  $inbound['inDate'] = e($_POST['inDate']);
  $inbound['inboundBOL'] = e($_POST['inboundBOL']);
  $inbound['tripNumber'] = e($_POST['tripNumber']);
  $inbound['note'] = e($_POST['note']);

  $result = insert_inbound($inbound);
  //$new_id = mysqli_insert_id($db);
  $new_id = $inbound['inboundBOL'];
  // $Date_id = $inbound['inDate'];
  redirect_to('in_new_inbound_items.php?id=' . $new_id);

} else {

  $inbound = [];
  $inbound['inDate'] = '';
  $inbound['inboundBOL'] = '';
  $inbound['tripNumber'] = '';
  $inbound['note'] = '';

  // $inbound_set = find_all_inbound();
  // mysqli_free_result($inbound_set);

}

?>

<?php $page_title = 'Create Inbound'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}
?>

<div id="form">



  <div class="page new">
    <h1>Create New Inbound BOL Sheet</h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">

      <dl>
        <dt>Date</dt>
        <dd><input type="date" id="date" name="inDate" /></dd>
      </dl>
      <dl>
        <dt>Inbound BOL</dt>
        <dd><input type="text" id="inboundBOL" name="inboundBOL" autofocus required pattern="[0-9]{6}[\-][0-9]{1,2}"/></dd>
      </dl>
      <dl>
        <dt>Trip Number</dt>
        <dd>
          <select name="tripNumber">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Note</dt>
        <dd>
          <textarea name="note" cols="50" rows="4"></textarea>
        </dd>
      </dl>

      <div id="operations">
        <input type="image" src="images/save-continue.png" alt="Submit" style="width:50px;height:50px;" />
        <input type="submit" value="Save and Goto Item Screen" />
      </div>
    </form>
  </div>

</div>
<script>
document.querySelector("#date").valueAsDate = new Date();
</script>
<?php include('staff_footer.php'); ?>

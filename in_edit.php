<?php

require_once('f_initialize.php');

if(is_post_request()) {

  $inbound = [];
  $inbound['inDate'] = e($_POST['inDate']);
  $inbound['inboundBOL'] = e($_POST['inboundBOL']);
  $inbound['tripNumber'] = e($_POST['tripNumber']);
  $inbound['note'] = e($_POST['note']);

  $result = update_inbound($inbound);
  //$new_id = mysqli_insert_id($db);
  // $new_id = $inbound['inboundBOL'];
  // $Date_id = $inbound['inDate'];
  redirect_to('in_show_inbound_detail.php?id=' . $inbound['inboundBOL']);

} else {

  if(!isset($_GET['id'])) {
    redirect_to('staff_index.php');
  }

  // $id = isset($_GET['id']) ? $_GET['id'] : '1';
  $inboundBOL = $_GET['id'];

$inbound_head = find_inbound_by_bol($inboundBOL);
}

$item_set = find_inbound_items_by_bol($inboundBOL);
?>

<?php $page_title = 'Show Inbound'; ?>
<?php include('staff_header.php'); ?>




  <div class="page new">
    <h1 class="redFont">Editing BOL# <?php echo h($inbound_head['inboundBOL']); ?> Sheet</h1>
  <form action="<?php $thisScript; ?>" method="post" autocomplete="off">

    <dl>
      <dt>Date</dt>
      <dd><input type="date" id="date" name="inDate" value="<?php echo h($inbound_head['inDate']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Inbound BOL</dt>
      <dd><input type="text" id="inboundBOL" name="inboundBOL" value="<?php echo h($inbound_head['inboundBOL']); ?>" readonly="readonly"/></dd>
    </dl>
    <dl>
      <dt>Trip Number</dt>
      <dd>
        <select name="TriptripNumberNum">
          <?php
            for($i=1; $i <= 4; $i++) {
              echo "<option value=\"{$i}\"";
              if($inbound_head["tripNumber"] == $i) {
                echo " selected";
              }
              echo ">{$i}</option>";
            }
          ?>
        </select>
      </dd>
    </dl>
    <dl>
      <dt>Note</dt>
      <dd>
        <textarea name="note" row="4" cols="50"><?php echo h($inbound_head['note']); ?></textarea>
      </dd>
    </dl>

    <div id="operations">
      <input class="redFont" type="submit" value="SAVE CHANGES to BOL HEADER" />
    </div>
  </form>

</div>
  <div class="subject show">

    <h1>Inbound BOL#  <?php echo h($inbound_head['inboundBOL']); ?>  Detail:</h1>

    <div class="attributes">


    <table class="list">
      <tr>
        <th>Part Number</th>
        <th>Lot Number</th>
        <th>PO Number</th>
        <th>Tubs</th>
        <th>Skids</th>
        <th>Boxes</th>
        <th>Due Date</th>
        <th>Hot List</th>
        <th>Completed</th>
        <th></th>


      </tr>

      <?php while($item = mysqli_fetch_assoc($item_set)) { ?>
        <tr>
          <td><?php echo h($item['partNumber']); ?></td>
          <td><?php echo h($item['lotNumber']); ?></td>
          <td><?php echo h($item['poNumber']); ?></td>
          <td><?php echo h($item['quantityOfTubs']); ?></td>
          <td><?php echo h($item['quantityOfSkids']); ?></td>
          <td><?php echo h($item['quantityOfBoxes']); ?></td>
          <td><?php echo h($item['dueDate']) == '0000-00-00' ? '' : h($item['dueDate']) ; ?></td>
          <td><?php echo h($item['hotList']) == '1' ? '<img src="images/hot.png" alt="Hot List" style="width:40px;height:40px;" ' : ''; ?></td>
          <td><?php echo h($item['completed']) == '1' ? '<img src="images/Approve_icon.svg" alt="Completed" style="width:35px;height:35px;"' : ''; ?></td>
          <td><a class="action" href="<?php echo 'in_edit_item.php?id=' . h(u($item['inboundBOL'])) . '&lot=' . h(u($item['lotNumber'])); ?>">Edit</a></td>
                  </tr>
      <?php } ?>
    </table>
<h3><a href="<?php echo 'in_new_inbound_items.php?id=' . h(u($inbound_head['inboundBOL'])); ?>">To add additional items to BOL click here.</a></h3>
  </div>


<?php include('staff_footer.php'); ?>

<?php

require_once('f_initialize.php');

if(is_post_request()) {

  $in_item_update = [];
  $in_item_update['inItemId'] = e($_POST['inItemId']);
  $in_item_update['poNumber'] = e($_POST['poNumber']);
  $in_item_update['quantityOfTubs'] = e($_POST['quantityOfTubs']);
  $in_item_update['quantityOfSkids'] = e($_POST['quantityOfSkids']);
  $in_item_update['quantityOfBoxes'] = e($_POST['quantityOfBoxes']);

  $lot_update = [];
  $lot_update['lotId'] = e($_POST['lotId']);
  $lot_update['lotNumber'] = e($_POST['lotNumber']);
  $lot_update['partNumber'] = e($_POST['partNumber']);
  $lot_update['dueDate'] = e($_POST['dueDate']);
  $lot_update['hotList'] = e($_POST['hotList']);
  $lot_update['completed'] = e($_POST['completed']);

  $inboundBOL = e($_POST['inboundBOL']);

  $result1 = update_inbound_item($in_item_update);
  $result2 = update_inbound_lot($lot_update);
  redirect_to('in_edit.php?id=' . $inboundBOL);

} else {

  if(!isset($_GET['id'])) {
    redirect_to('sort_index.php');
  }

  $lotNumber = $_GET['id'];
// echo $inboundBOL . " and " . $lotNumber . "were received      ";
// $inbound_head = find_inbound_by_bol($inboundBOL);
}

$item_set = find_inbound_items_by_lot($lotNumber);
?>

<?php $page_title = 'Edit Inbound Item'; ?>
<?php include('staff_header.php'); ?>



  
  <div class="page new">
    <h1 class="redFont">Details for Lot# <?php echo h($item_set['lotNumber']); ?></h1>
    <h2>This Lot is on inbound BOL# <?php echo h($item_set['inboundBOL']); ?></h2>
    <h2>Received on <?php echo h($item_set['inDate']); ?></h2>

      <!-- this input for BOL is just to pass the current bol to next page inside post request -->


    <dl>
      <dt>Part Number:</dt>
      <dd><?php echo h($item_set['partNumber']); ?></dd>
    </dl>
    <dl>
      <dt>Lot Number:</dt>
      <dd><?php echo h($item_set['lotNumber']); ?></dd>
    </dl>
    <dl>
      <dt>PO Number:</dt>
      <dd><?php echo h($item_set['poNumber']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Tubs:</dt>
      <dd><?php echo h($item_set['quantityOfTubs']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Skids:</dt>
      <dd><?php echo h($item_set['quantityOfSkids']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Boxes:</dt>
      <dd><?php echo h($item_set['quantityOfBoxes']); ?></dd>
    </dl>
    <dl>
      <dt>Due Date:</dt>
      <dd><?php echo h($item_set['dueDate']) == '0000-00-00' ? '' : h($item['dueDate']) ; ?></dd>
    </dl>
    <dl>
      <dt>Hot List:</dt>
      <dd><?php echo h($item_set['hotList']) == '1' ? '<img src="images/hot.png" alt="Hot List" style="width:40px;height:40px;" ' : 'No'; ?></dd>
    </dl>
    <dl>
      <dt>Completed:</dt>
      <dd><?php echo h($item_set['completed']) == '1' ? '<img src="images/Approve_icon.svg" alt="Completed" style="width:35px;height:35px;"' : 'No'; ?></dd>
    </dl>





</div>
<?php include('staff_footer.php'); ?>

<?php

require_once('f_initialize.php');

if(is_post_request()) {

  $in_item_update = [];
  $in_item_update['inItemID'] = e($_POST['inItemID']);
  $in_item_update['PoNum'] = e($_POST['PoNum']);
  $in_item_update['QtyTubs'] = e($_POST['QtyTubs']);
  $in_item_update['QtySkids'] = e($_POST['QtySkids']);
  $in_item_update['QtyBoxes'] = e($_POST['QtyBoxes']);

  $lot_update = [];
  $lot_update['LotId'] = e($_POST['LotId']);
  $lot_update['LotNum'] = e($_POST['LotNum']);
  $lot_update['PartNum'] = e($_POST['PartNum']);
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

  $LotNum = $_GET['id'];
// echo $inboundBOL . " and " . $LotNum . "were received      ";
// $inbound_head = find_inbound_by_bol($inboundBOL);
}

$item_set = find_inbound_items_by_lot($LotNum);
?>

<?php $page_title = 'Edit Inbound Item'; ?>
<?php include('staff_header.php'); ?>



  
  <div class="page new">
    <h1 class="redFont">Details for Lot# <?php echo h($item_set['LotNum']); ?></h1>
    <h2>This Lot is on inbound BOL# <?php echo h($item_set['inboundBOL']); ?></h2>
    <h2>Received on <?php echo h($item_set['InDate']); ?></h2>

      <!-- this input for BOL is just to pass the current bol to next page inside post request -->


    <dl>
      <dt>Part Number:</dt>
      <dd><?php echo h($item_set['PartNum']); ?></dd>
    </dl>
    <dl>
      <dt>Lot Number:</dt>
      <dd><?php echo h($item_set['LotNum']); ?></dd>
    </dl>
    <dl>
      <dt>PO Number:</dt>
      <dd><?php echo h($item_set['PoNum']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Tubs:</dt>
      <dd><?php echo h($item_set['QtyTubs']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Skids:</dt>
      <dd><?php echo h($item_set['QtySkids']); ?></dd>
    </dl>
    <dl>
      <dt>Quantity of Boxes:</dt>
      <dd><?php echo h($item_set['QtyBoxes']); ?></dd>
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

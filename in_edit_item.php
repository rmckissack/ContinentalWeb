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
    redirect_to('in_index.php');
  }

  $inboundBOL = $_GET['id'];
  $LotNum = $_GET['lot'];
// echo $inboundBOL . " and " . $LotNum . "were received      ";
// $inbound_head = find_inbound_by_bol($inboundBOL);
}

$item_set = find_inbound_items_by_BOL_and_lot($inboundBOL, $LotNum);
?>

<?php $page_title = 'Edit Inbound Item'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>



    <div class="page new">
    <h1 class="redFont">Editing Lot# <?php echo h($item_set['LotNum']); ?></h1>
    <h2>This Lot is on inbound BOL# <?php echo h($inboundBOL); ?></h2>
  <form action="<?php $thisScript; ?>" method="post" autocomplete="off">

      <!-- this input for BOL is just to pass the current bol to next page inside post request -->
    <input type="hidden" id="inboundBOL" name="inboundBOL" value="<?php echo $inboundBOL; ?>"/>
    <input type="hidden" id="inItemID" name="inItemID" value="<?php echo $item_set['inItemID']; ?>"/>
    <input type="hidden" id="LotId" name="LotId" value="<?php echo $item_set['LotId']; ?>"/>

    <dl>
      <dt>Part Number:</dt>
      <dd><input type="text" id="PartNum" name="PartNum" value="<?php echo h($item_set['PartNum']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Lot Number:</dt>
      <dd><input type="text" id="LotNum" name="LotNum" value="<?php echo h($item_set['LotNum']); ?>"/></dd>
    </dl>
    <dl>
      <dt>PO Number:</dt>
      <dd><input type="text" id="PoNum" name="PoNum" value="<?php echo h($item_set['PoNum']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Tubs:</dt>
      <dd><input type="text" id="QtyTubs" name="QtyTubs" value="<?php echo h($item_set['QtyTubs']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Skids:</dt>
      <dd><input type="text" id="QtySkids" name="QtySkids" value="<?php echo h($item_set['QtySkids']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Boxes:</dt>
      <dd><input type="text" id="QtyBoxes" name="QtyBoxes" value="<?php echo h($item_set['QtyBoxes']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Due Date:</dt>
      <dd><input type="date" id="dueDate" name="dueDate" value="<?php echo h($item_set['dueDate']) == '0000-00-00' ? '' : h($item_set['dueDate']) ; ?>"/></dd>
    </dl>
    <dl>
      <dt>Hot List:</dt>
      <dd><input type="hidden" id="hotList" name="hotList" value="0"/>
        <input type="checkbox" id="hotList" name="hotList" <?php echo h($item_set['hotList']) == '1' ? 'checked' : ''; ?> value="1"/></dd>
    </dl>
    <dl>
      <dt>Completed:</dt>
      <dd><input type="hidden" id="completed" name="completed" value="0"/>
        <input type="checkbox" id="completed" name="completed" <?php echo h($item_set['completed']) == '1' ? 'checked' : ''; ?> value="1"/></dd>
    </dl>


    <div id="operations">

      <input class="redFont" type="submit" value="SAVE CHANGES to item on inbound BOL" />
    </div>
  </form>





<?php include('staff_footer.php'); ?>

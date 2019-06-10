<?php

require_once('f_initialize.php');

if(is_post_request()) {

  $in_item_update = [];
  $in_item_update['inItemId'] = e($_POST['inItemId']);
  // $in_item_update['poNumber'] = e($_POST['poNumber']);
  $in_item_update['quantityOfTubs'] = e($_POST['quantityOfTubs']);
  $in_item_update['quantityOfSkids'] = e($_POST['quantityOfSkids']);
  $in_item_update['quantityOfBoxes'] = e($_POST['quantityOfBoxes']);

  $lot_update = [];
  $lot_update['lotId'] = e($_POST['lotId']);
  $lot_update['lotNumber'] = e($_POST['lotNumber']);
  $lot_update['poNumber'] = e($_POST['poNumber']);
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
    redirect_to('in_index.php');
  }

  $inboundBOL = $_GET['id'];
  $lotNumber = $_GET['lot'];
// echo $inboundBOL . " and " . $lotNumber . "were received      ";
// $inbound_head = find_inbound_by_bol($inboundBOL);
}

$item_set = find_inbound_items_by_BOL_and_lot($inboundBOL, $lotNumber);
?>

<?php $page_title = 'Edit Inbound Item'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>



    <div class="page new">
    <h1 class="redFont">Editing Lot# <?php echo h($item_set['lotNumber']); ?></h1>
    <h2>This Lot is on inbound BOL# <?php echo h($inboundBOL); ?></h2>
  <form action="<?php $thisScript; ?>" method="post" autocomplete="off">

      <!-- this input for BOL is just to pass the current bol to next page inside post request -->
    <input type="hidden" id="inboundBOL" name="inboundBOL" value="<?php echo $inboundBOL; ?>"/>
    <input type="hidden" id="inItemId" name="inItemId" value="<?php echo $item_set['inItemId']; ?>"/>
    <input type="hidden" id="lotId" name="lotId" value="<?php echo $item_set['lotId']; ?>"/>

    <dl>
      <dt>Part Number:</dt>
      <dd><input type="text" id="partNumber" name="partNumber" value="<?php echo h($item_set['partNumber']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Lot Number:</dt>
      <dd><input type="text" id="lotNumber" name="lotNumber" value="<?php echo h($item_set['lotNumber']); ?>" required pattern="[0-9]{7}"/></dd>
    </dl>
    <dl>
      <dt>PO Number:</dt>
      <dd><input type="text" id="poNumber" name="poNumber" value="<?php echo h($item_set['poNumber']); ?>" required pattern="[0-9]{7,8}"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Tubs:</dt>
      <dd><input type="text" id="quantityOfTubs" name="quantityOfTubs" value="<?php echo h($item_set['quantityOfTubs']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Skids:</dt>
      <dd><input type="text" id="quantityOfSkids" name="quantityOfSkids" value="<?php echo h($item_set['quantityOfSkids']); ?>"/></dd>
    </dl>
    <dl>
      <dt>Quantity of Boxes:</dt>
      <dd><input type="text" id="quantityOfBoxes" name="quantityOfBoxes" value="<?php echo h($item_set['quantityOfBoxes']); ?>"/></dd>
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

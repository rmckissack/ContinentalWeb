<?php require_once("f_initialize.php"); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$inboundBOL = $_GET['id'];

$inbound_head = find_inbound_by_bol($inboundBOL); //need to make this in query_functions
//  // save for later

// $bol_date = $inbound_head['InDate'];
// $bol_number = $inbound_head['inboundBOL'];
// $bol_note = $inbound_head['note'];

$item_set = find_inbound_items_by_bol($inboundBOL);
?>

<?php $page_title = 'Show Inbound'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>

  <div class="subject show">

    <h1>Inbound BOL#  <?php echo h($inbound_head['inboundBOL']); ?>  Detail:</h1>

    <div class="attributes">
      <dl>
        <dt>Inbound Date:</dt>
        <dd class="strong"><?php echo h($inbound_head['InDate']); ?></dd>
      </dl>
      <dl>
        <dt>BOL Number:</dt>
        <dd class="strong"><?php echo h($inbound_head['inboundBOL']); ?></dd>
      </dl>
      <dl>
        <dt>Trip Number:</dt>
        <dd class="strong"><?php echo h($inbound_head['TripNum']); ?></dd>
      </dl>
      <dl>
        <dt>Note:</dt>
        <dd><?php echo h($inbound_head['Note']); ?></dd>
      </dl>
    </div>

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

      </tr>

      <?php while($item = mysqli_fetch_assoc($item_set)) { ?>
        <tr>
          <td><?php echo h($item['PartNum']); ?></td>
          <td><a class="action" href="<?php echo 'lot_detail.php?id=' . h(u($inbound_head['inboundBOL'])) . '&lot=' . h(u($item['LotNum'])); ?>"><?php echo h($item['LotNum']); ?></a></td>

          <td><?php echo h($item['PoNum']); ?></td>
          <td><?php echo h($item['QtyTubs']); ?></td>
          <td><?php echo h($item['QtySkids']); ?></td>
          <td><?php echo h($item['QtyBoxes']); ?></td>
          <td><?php echo h($item['dueDate']) == '0000-00-00' ? '' : h($item['dueDate']) ; ?></td>
          <td><?php echo h($item['hotList']) == '1' ? '<img src="images/hot.png" alt="Hot List" style="width:40px;height:40px;" ' : ''; ?></td>
          <td><?php echo h($item['completed']) == '1' ? '<img src="images/Approve_icon.svg" alt="Completed" style="width:35px;height:35px;"' : ''; ?></td>
        </tr>
      <?php } ?>
    </table>

  </div>

<?php include('staff_footer.php'); ?>

<?php require_once('f_initialize.php');
$item_set = fifo_list();
$page_title = 'Staff Menu';
include('staff_header.php');
?>


  <h1 class="tbl_title">FIFO LIST</h1>
  <table class="list">

    <tr>
      <th>Date Received</th>
      <th>Part Number</th>
      <th>Lot Number</th>
      <th>PO Number</th>
      <th>Tubs</th>
      <th>Skids</th>
      <th>Boxes</th>
      <th>Due Date</th>
      <th>Hot List</th>
    </tr>

    <?php while($item = mysqli_fetch_assoc($item_set)) { ?>
      <tr>
        <td><a class="action" href="<?php echo 'in_show_inbound_detail.php?id=' . h(u($item['inboundBOL'])); ?>" title="Select to view Bill of Laden for this lot."><?php echo h($item['inDate']); ?></a></td>
        <td><?php echo h($item['partNumber']); ?></td>
        <td><a class="action" href="<?php echo 'in_edit_item.php?id=' . h(u($item['inboundBOL'])) . '&lot=' . h(u($item['lotNumber'])); ?>" title="Select to view or edit details for this lot."><?php echo h($item['lotNumber']); ?></a></td>
        <td><?php echo h($item['poNumber']); ?></td>
        <td><?php echo h($item['quantityOfTubs']); ?></td>
        <td><?php echo h($item['quantityOfSkids']); ?></td>
        <td><?php echo h($item['quantityOfBoxes']); ?></td>
        <td><?php echo h($item['dueDate']) == '0000-00-00' ? '' : h($item['dueDate']) ; ?></td>
        <td><?php echo h($item['hotList']) == '1' ? '<img src="images/hot.png" alt="Hot List" style="width:40px;height:40px;"> ' : ''; ?></td>
      </tr>

    <?php } ?>

  </table>

<?php include('staff_footer.php'); ?>

<?php require_once('f_initialize.php');
$item_set = tally_detail('1295719');
$page_title = 'Tally Detail';
include('staff_header.php');
?>


  <h1 class="tbl_title">Tally Detail</h1>
  <table class="list">

    <tr>
      <th>Part Number</th>
      <th>Lot Number</th>
      <th>PO Number</th>
      <th>Tally ID</th>
      <th>Tally Date</th>
      <th>Tub Complete</th>
      <th>Tubs Received</th>
      <th>Mutilation</th>
      <th>Plating</th>
      <th>Mixed</th>
      <th>Overflow</th>
      <th>Boxes</th>
      <th>Completed</th>
    </tr>

    <?php while($item = mysqli_fetch_assoc($item_set)) { ?>
      <tr>
        <td><?php echo h($item['partNumber']); ?></td>
        <td><?php echo h($item['lotNumber']); ?></td>
        <td><?php echo h($item['poNumber']); ?></td>
        <td><?php echo h($item['tallyId']); ?></td>
        <td><?php echo h($item['tallyDate']); ?></td>
        <td><?php echo h($item['tubComplete']); ?></td>
        <td><?php echo h($item['tubsReceived']); ?></td>
        <td><?php echo h($item['mutilatoion']); ?></td>
        <td><?php echo h($item['plating']); ?></td>
        <td><?php echo h($item['mixed']); ?></td>
        <td><?php echo h($item['overflow']); ?></td>
        <td><?php echo h($item['boxes']); ?></td>
        <td><?php echo h($item['completed']) == '1' ? 'Y' : 'N'; ?></td>
      </tr>

    <?php } ?>

  </table>

<?php include('staff_footer.php'); ?>

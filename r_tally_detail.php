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
        <td><?php echo h($item['Part']); ?></td>
        <td><?php echo h($item['Lot']); ?></td>
        <td><?php echo h($item['PO']); ?></td>
        <td><?php echo h($item['Tally_ID']); ?></td>
        <td><?php echo h($item['Tally_Date']); ?></td>
        <td><?php echo h($item['Tub_Complete']); ?></td>
        <td><?php echo h($item['Tubs_Received']); ?></td>
        <td><?php echo h($item['Mutilatoion']); ?></td>
        <td><?php echo h($item['Plating']); ?></td>
        <td><?php echo h($item['Mixed']); ?></td>
        <td><?php echo h($item['Overflow']); ?></td>
        <td><?php echo h($item['Boxes']); ?></td>
        <td><?php echo h($item['Completed']) == '1' ? 'Y' : 'N'; ?></td>
      </tr>

    <?php } ?>

  </table>

<?php include('staff_footer.php'); ?>

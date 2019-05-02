<table class="list">
  <tr>
    <!--<th>Date</th>-->
    <th>Part Number</th>
    <th>Lot Number</th>
    <th>Tubs</th>
    <th>Skids</th>
    <th>Boxes</th>

  </tr>

  <?php while($item = mysqli_fetch_assoc($item_set)) { ?>
    <tr>
      <!--<td><?php echo h($item['InDate']); ?></td>-->
      <td><?php echo h($item['PartNum']); ?></td>
      <td><?php echo h($item['LotNum']); ?></td>
      <td><?php echo h($item['QtyTubs']); ?></td>
      <td><?php echo h($item['QtySkids']); ?></td>
      <td><?php echo h($item['QtyBoxes']); ?></td>
    </tr>
  <?php } ?>

</table>

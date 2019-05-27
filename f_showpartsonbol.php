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
      <!--<td><?php echo h($item['inDate']); ?></td>-->
      <td><?php echo h($item['partNumber']); ?></td>
      <td><?php echo h($item['lotNumber']); ?></td>
      <td><?php echo h($item['quantityOfTubs']); ?></td>
      <td><?php echo h($item['quantityOfSkids']); ?></td>
      <td><?php echo h($item['quantityOfBoxes']); ?></td>
    </tr>
  <?php } ?>

</table>

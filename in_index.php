<?php require_once('f_initialize.php'); ?>

<?php

  $inbound_set = find_all_inbound_month();

?>

<?php $page_title = 'Inbound List'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>

  <div class="subjects listing">
    <h1>InBound</h1>
    <h2>Displaying last 30 days only</h2>

    <div class="actions">
      <a class="action" href="in_new_inbound.php"><img src="images/truck.svg" alt="Inbound truck" style="float:left;width:75px;height:75px;">Receive Shipment</a>
    </div>
<div id="bolListing">
  	<table class="list">
  	  <tr>
        <th>Date</th>
        <th>BOL</th>
        <th>Trip Number</th>
        <th>Notes</th>
  	    <th></th>
        <th></th>

  	  </tr>

      <?php while($inbound = mysqli_fetch_assoc($inbound_set)) { ?>
        <tr>
          <td><?php echo h($inbound['inDate']); ?></td>
          <td><a class="action" href="<?php echo 'in_show_inbound_detail.php?id=' . h(u($inbound['inboundBOL'])); ?>"><?php echo h($inbound['inboundBOL']); ?></a></td>
          <td><?php echo h($inbound['tripNumber']); ?></td>
          <td><?php echo h($inbound['note']); ?></td>

          <td><a class="action" href="<?php echo 'in_show_inbound_detail.php?id=' . h(u($inbound['inboundBOL'])); ?>">View</a></td>
          <td><a class="action" href="<?php echo 'in_edit.php?id=' . h(u($inbound['inboundBOL'])); ?>">Edit</a></td>
        </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($inbound_set);
    ?>
    </div>
  </div>


<?php include('staff_footer.php'); ?>

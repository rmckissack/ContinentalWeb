<?php require_once('f_initialize.php'); ?>

<?php

  $part_set = find_all_parts();

?>

<?php $page_title = 'Parts'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>

  <div class="pages listing">
    <h1>Parts</h1>

    <div class="actions">
      <a class="action" href="parts_new.php">Create New Part</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>partNumber</th>
        <th>Description</th>
        <th>Packaging</th>
        <!-- <th>Mut</th> -->
  	    <!-- <th>Plt</th> -->
  	    <!-- <th>Mix</th> -->
  	    <!-- <th>NoGo</th> -->
        <th></th>
        <th></th>
        <!-- <th>&nbsp;</th> -->
  	  </tr>

      <?php while($part = mysqli_fetch_assoc($part_set)) { ?>
        <tr>
          <!-- <td><?php echo h($part['partNumber']); ?></td> -->
          <td><a class="action" href="<?php echo 'parts_show.php?partNumber=' . h(u($part['partNumber'])); ?>"><?php echo h($part['partNumber']); ?></a></td>
          <td><?php echo h($part['description']); ?></td>
          <td><?php echo h($part['packaging']); ?></td>
          <!-- <td><?php echo $part['mutilation'] == 1 ? 'X' : ''; ?></td> -->
          <!-- <td><?php echo $part['plating'] == 1 ? 'X' : ''; ?></td> -->
          <!-- <td><?php echo $part['mixed'] == 1 ? 'X' : ''; ?></td> -->
          <!-- <td><?php echo $part['noGo'] == 1 ? 'X' : ''; ?></td> -->
          <td><a class="action" href="<?php echo 'parts_show.php?partNumber=' . h(u($part['partNumber'])); ?>">View</a></td>
          <td><a class="action" href="<?php echo 'parts_edit.php?partNumber=' . h(u($part['partNumber'])); ?>">Edit</a></td>
          <!-- <td><a class="action" href="">Delete</a></td> -->
    	  </tr>
      <?php } ?>
  	</table>

    <!-- <?php mysqli_free_result($page_set); ?> -->

  </div>


<?php include('staff_footer.php'); ?>

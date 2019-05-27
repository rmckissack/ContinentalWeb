<?php require_once('f_initialize.php'); ?>

<?php

if (isset($_GET['id'])) {
  $lot_id = $_GET['id'];
  $table_number = $_GET['table'];
  $date = date('Y-m-d');
  insert_tally_sheet($lot_id, $table_number, $date);
} else if (isset($_GET['table'])) {
  $table_number = $_GET['table'];
} else {
  redirect_to('sort_index.php');
}

  $lot_set = available_lots();
  
?>

<?php $page_title = 'Available Lot List'; ?>
<?php require_once('staff_header.php');
?>

 <div id="lotlist">
   <h2>Lot List</h2>
   <h3>Selected table number is: <?php echo $table_number; ?> </h3>

    
 </div>
 <h1 class="tbl_title">Avaliable Lot List</h1>
 <table class="list" id="lot_list">
   

   <tr>
     <th>Lot Number</th>
     <th>Part Number</th>
     <th>Hot List</th>
   </tr>

   <?php while($lot = mysqli_fetch_assoc($lot_set)) { ?>
     <tr>
       <td><a class="action" href="<?php echo 'sort_index2.php?id=' . h(u($lot['lotId'])) . '&table=' . h(u($table_number)); ?>"><?php echo h($lot['lotNumber']); ?></a></td>
       <td><a class="action" href="<?php echo 'sort_index2.php?id=' . h(u($lot['lotId'])) . '&table=' . h(u($table_number)); ?>"><?php echo h($lot['partNumber']); ?></a></td>
       <td><?php echo h($lot['hotList']) == '1' ? '<img src="images/hot.png" alt="Hot" style="width:40px;height:40px;"> ' : ''; ?></td>
     </tr>
   <?php } ?>

 </table>
 

<?php include('staff_footer.php'); ?>

<?php require_once('f_initialize.php');

$table_list = all_sort_tables();



$page_title = 'Table Select';
include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>


 <div id="lotlist">
   <h2>Starting Tally Sheet</h2>
   <h3>Select your table number:
   <select id="table_dropdown" name="table" required onchange="table_selected()">
   <option value="" disabled selected>- Select -</option>

   <?php while($table = mysqli_fetch_assoc($table_list)) { ?>
   <option value="<?php echo h($table['table_num']); ?>"><?php echo h($table['table_num']); ?></option>
   <?php } ?>
          </select>


    </h3>
 </div>

<script>

document.getElementById("table_dropdown").onchange = function() {
    var table_value = document.getElementById('table_dropdown').value;
  window.location.href = 'sort_index2.php?table=' +  table_value;
};


</script>

<?php include('staff_footer.php'); ?>

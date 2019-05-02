<?php
require_once('f_initialize.php');
// require_once('update_tally_qty.php');



$tally_id = $_GET['tally'];
$selected_lot = $_GET['lot'];
$selected_table = $_GET['table'];



$lot_info = find_by_lot_id($selected_lot); // this is what we will be sorting
$employee_list = find_all_employees(); // get list of employees for drop down list
$part_info = find_part_by_id($lot_info['PartNum']); // just so we can display part details
$tally_info = find_tally_by_id($tally_id);
?>


<?php $page_title = 'Tally Sheet'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>



    <table class="tally_part_tbl">
      <tr>
      <!-- Input row headings for LOT & Part info   -->
        <th>Lot Number</th>
        <th>Part Number</th>
        <th>Box Size</th>
        <th>Parts Per Box</th>
        <th>Boxes Per Skid</th>
        </tr>

      <tr>
          <td>
            <?php echo h($lot_info['LotNum']); ?>
          </td>
          <td>
            <?php echo h($lot_info['PartNum']); ?>
          </td>
          <td>
            <?php echo h($part_info['Packaging']); ?>
          </td>
          <td>
            <?php echo h($part_info['perBox']); ?>
          </td>
          <td>
            <?php echo h($part_info['perSkid']); ?>
          </td>
          </tr>
    </table>

  <div id="additem">
  <h1>Tally ID: <?php echo $tally_id; ?></h1>


    <div class="sort_count">

        <table class="tally_part_tbl sort_count">
          <tr>
          <!-- Inpur row headings   -->
            <th>Mutilated (M)</th>
            <th>Plating (P)</th>
            <th>Mixed (X)</th>
            <th>Box (B)</th>
          </tr>
                  <!-- Input fields for items -->
          <tr>
              <td>
                <input type="text" id="mRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Mutilation'] ?>" readonly style="border:0">
              </td>
              <td>
                <input type="text" id="pRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Plating'] ?>" readonly style="border:0">
              </td>
              <td>
                <input type="text" id="xRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Mixed'] ?>" readonly style="border:0">
              </td>
              <td>
                <input type="text" id="bRunningTotal" class="qtyDisplay" value="0" readonly style="border:0">
              </td>
          </tr>
        </table>

</div>
    <div id="displayParts">
      <h1>Sorting Table: <?php echo $selected_table; ?></h1> <!-- add table number -->


</div> <!-- id="displayParts" -->
</div> <!-- id="additem" -->




<script>
var tallyId = <?php echo $tally_id; ?>; // transfer ID from PHP to JS
var lastKeyPressed = []; // used for undo operation
console.log("last Key Pressed var set") ;

$(document).ready(function(){ // after page loads
  $(document).keypress(function(event) { // listen for keypress anywhere in document
  console.log(event.charCode);
    if (event.charCode == 109 || event.charCode == 112 || event.charCode == 120) { // testing if incroment key was pressed
      lastKeyPressed.push(event.charCode); // capture last key pressed for undo
      console.log("Number of undos" , lastKeyPressed.length);
      dbUpdate(tallyId, event.charCode, 1);


    } else if (event.charCode == 98) { // testing if box key was pressed
      // lastKeyPressed = event.charCode; // capture last key pressed for undo
      // ajax post using json for database update
      $.post("sort_box.php",
        {
          tallyId: tallyId
        },
        // collect data echoed from php page and parse to js object
        function(data){
          // alert("Returned- " + data);
         var returndObj = JSON.parse(data);
        console.log(returndObj);
          document.getElementById("bRunningTotal").value = returndObj['count(*)'];
        });


      } else if (event.charCode == 117) { // testing if box key was pressed
        if (lastKeyPressed.length==0) {
          alert ("I'm sorry, that is as far back as you can go.")
        } else {
          dbUpdate(tallyId, lastKeyPressed.slice(-1)[0], -1);
          lastKeyPressed.pop();
          console.log("*NEW* Number of undos" , lastKeyPressed.length);
        }


      } else {
      alert("Invalid key pressed!");
    }
  });
});

function dbUpdate (tally, char, inc) {
      // ajax post using json for database update
      $.post("sort_incroment.php",
        {
          tallyId: tally,
          charCode: char,
          incroment: inc
        },
        // collect data echoed from php page and parse to js object
        function(data){
          // alert("Returned- " + data);
         var returndObj = JSON.parse(data);
        console.log(data);


          // inserting updated qty value on page
        if ('Mutilation' in returndObj) {
          // console.log("Mutilation");
          document.getElementById("mRunningTotal").value = returndObj.Mutilation;
        } else if ('Plating' in returndObj) {
          // console.log("Plating");
          document.getElementById("pRunningTotal").value = returndObj.Plating;
        } else if ('Mixed' in returndObj) {
          // console.log("Mixed");
          document.getElementById("xRunningTotal").value = returndObj.Mixed;
        } else {
          alert ("There was a problem with updating quantities");
        }

        });
}
</script>



<?php include('staff_footer.php'); ?>

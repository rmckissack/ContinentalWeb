<?php
require_once('f_initialize.php');
// require_once('update_tally_qty.php');



$tally_id = $_GET['tally'];
$selected_lot = $_GET['lot'];
$selected_table = $_GET['table'];

if(is_post_request()) {

  $overrun = e($_POST['overrun']);

  if($overrun > 0) {
  
  overrun($overrun, $tally_id);
  lot_completed($selected_lot);
  }


  redirect_to('sort_index2.php?table=' . $selected_table);

} 



$lot_info = find_by_lot_id($selected_lot); // this is what we will be sorting
$employee_list = find_all_employees(); // get list of employees for drop down list
$part_info = find_part_by_id($lot_info['PartNum']); // just so we can display part details
$tally_info = find_tally_by_id($tally_id);
$photos = find_part_photos($lot_info['PartNum']);
$total_boxes = find_box_qty($tally_id);
$tally_sorter_time = find_employee_time_by_tally_id($tally_id);
// print_r ($lot_info);
$boxTotal = '0';
?>


<?php $page_title = 'Tally Sheet'; ?>
<?php include('sort_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>


  <table class="sortDetail">
    <tr>
      <td rowspan="4">
        <img src="<?php echo $photos['2'] ?>" alt="Part Image" height="150" width="200">
      </td>
      <td class="cell_right">
        Part #:
      </td>
      <td class="cell_left">
        <?php echo h($lot_info['PartNum']); ?>
      </td>
      <td class="cell_right">
        Box Size:
      </td>
      <td class="cell_left">
        <?php echo h($part_info['Packaging']); ?>
      </td>
      <td class="cell_right">
        Total Good:
      </td>
      <td class="cell_left" id="totalGood">
        <?php echo h($total_boxes['count(*)']) * h($part_info['perBox']); ?>
      </td>
      <td class="cell_right">
        Table #:
      </td>
      <td class="cell_left">
        <?php echo $selected_table; ?>
      </td>
    </tr>
    <tr>
      <td class="cell_right">
        Lot #:
      </td>
      <td class="cell_left">
        <?php echo h($lot_info['LotNum']); ?>
      </td>
      <td class="cell_right">
        Parts-Box:
      </td>
      <td class="cell_left">
        <?php echo h($part_info['perBox']); ?>
      </td>
      <td class="cell_right">
        Total Bad:
      </td>
      <td class="cell_left" id="totalBad">

      </td>
      <td class="cell_right">
        Tally ID#:
      </td>
      <td class="cell_left">
        <?php echo $tally_id; ?>
      </td>
    </tr>
    <tr>
      <td class="cell_right">
        PO #:
      </td>
      <td class="cell_left">
        <?php echo h($lot_info['PoNum']); ?>
      </td>
      <td class="cell_right">
        Boxes-Skid:
      </td>
      <td class="cell_left">
        <?php echo h($part_info['perSkid']); ?>
      </td>
      <td class="cell_right">
        Total Parts:
      </td>
      <td class="cell_left" id="totalParts">

      </td>
      <td class="cell_right">
        Date:
      </td>
      <td class="cell_left">
        <?php echo h($tally_info['TallyDate']); ?>
      </td>
    </tr>
    <tr>
      <td class="cell_right">
        Tubs:
      </td>
      <td class="cell_left">
        <?php echo h($lot_info['QtyTubs']); ?>
      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
    </tr>
    <tr>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td>

      </td>
      <td></td>
    </tr>

  </table>




    <!-- <table class="tally_part_tbl">
      <tr>
    Input row headings for LOT & Part info
        <th>Lot Number</th>
        <th>Part Number</th>
        <th>Box Size</th>
        <th>Parts Per Box</th>
        <th>Boxes Per Skid</th>
        </tr>

      <tr>
          <td>

          </td>
          <td>

          </td>
          <td>

          </td>
          <td>

          </td>
          <td>

          </td>
          </tr>
    </table> -->

  <div id="additem">
  <!-- <h1>Tally ID: </h1> -->


    <div class="sort_count clearFloat">

        <table class="tally_part_tbl sort_count">
          <tr>
            <th>M</th>
            <th>P</th>
            <th>X</th>
            <th>U</th>
            <th>B</th>
            <th>Close Tally</th>
          </tr>
          <tr>
            <td>Mutilation</td>
            <td>Plating</td>
            <td>Mixed</td>
            <td>Undo</td>
            <td>Boxes</td>
            <td class="tooltip">
              <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
              <input type="number" id="overrun" name="overrun" placeholder="Overflow Parts">
              <span class="tooltiptext">ONLY put a number in here if this is the end of the lot !!</span>
              
            </td>
            <tr>
            <td>
              <input type="text" id="mRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Mutilation']; ?>" readonly style="border:0">
            </td>
            <td>
              <input type="text" id="pRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Plating']; ?>" readonly style="border:0">
            </td>
            <td>
              <input type="text" id="xRunningTotal" class="qtyDisplay" value="<?php echo $tally_info['Mixed']; ?>" readonly style="border:0">
            </td>
            <td></td>
            <td>
              <input type="text" id="bRunningTotal" class="qtyDisplay" value="<?php echo $total_boxes['count(*)']; ?>" readonly style="border:0">
            </td> 
            <td><input type="submit" value="Click to Close"></td>                 
          </tr>
        </table>

</div>
    





  <div class="additem">

    <!-- <form id="addEmployee" action="<?php $thisScript; ?>" method="post" autocomplete="off"> -->

      <table class="list">
        <tr>
        <!-- Input row headings   -->
          <th>Name</th>
          <th></th>
          <th>Start</th>
          <th></th>
          <th>Stop</th>
          <th>Total</th>
        </tr>
        <?php
        while($sorter = $tally_sorter_time) {
          echo '<tr>';
            echo '<td>' . h($sorter['LastName']) .'</td>';
            echo '<td>BTN</td>';
            echo '<td>' . h($sorter['startTime']) . '</td>';
            echo '<td>BTN</td>';
            echo '<td>' . h($sorter['stopTime']) . '</td>';
          echo '</tr>';
        }
      ?> 

                <!-- Input fields for items -->

        <tr>
            <td>
            <select id="addSorter" name="EmployeeID" autofocus >
              <?php
              $moreSorters = find_all_employees();

              while ($row = mysqli_fetch_assoc($moreSorters)) {


              // while($mp = mysqli_fetch_assoc($moreSorters)) {
                echo '<option value="' . $row['EmployeeID'] . '">' . $row['LastName'] . ', ' . $row['FirstName'] . '</option>';
              }
              ?>
            </select>

            
            </td>
            <td><button id="startBtn">Start Now -> </button></td>
            <td>
              <input type="time" name="startTime" autocomplete="off" >
            </td>
            <td><button id="stopBtn">Stop Now -> </button></td>
            <td>
              <input type="time" name="stopTime" autocomplete="off">
            </td>
            <td>
              <input type="text" name="total" autocomplete="off" readonly>
            </td>
          </tr>
      </table>


      <div id="operations">
        <input type="submit" id="submit_item" value="" />
      </div>
  </form>
    </div>
            </div>











































<script>
var tallyId = <?php echo $tally_id; ?>; // transfer ID from PHP to JS
var partsPerBox = <?php echo h($part_info['perBox']); ?>;
var lastKeyPressed = []; // used for undo operation
var mt = <?php echo $tally_info['Mutilation']; ?>;
var pt = <?php echo $tally_info['Plating']; ?>;
var xt = <?php echo $tally_info['Mixed']; ?>;
var totalParts;
var totalGoodParts = <?php echo h($total_boxes['count(*)']) * h($part_info['perBox']); ?>;
var totalBadTarget = document.getElementById("totalBad");
var totalPartsTarget = document.getElementById("totalParts");
console.log("last Key Pressed var set") ;
console.log("Total good Parts var: " + totalGoodParts) ;

function totalPartCount (passedParts = totalGoodParts) {
console.log(mt);
console.log(pt);
console.log(xt);
console.log("start of totalpertcount function: " + totalGoodParts);
// totalGoodParts = <?php echo h($total_boxes['count(*)']) * h($part_info['perBox']); ?>;
console.log(totalGoodParts);
totalBad = parseInt(mt) + parseInt(pt) + parseInt(xt);
totalBadTarget.innerHTML = totalBad;
totalParts = parseInt(totalBad) + parseInt(passedParts);
totalPartsTarget.innerHTML = totalParts;
}

totalPartCount();
$(document).ready(function(){  // after page loads
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
        function BoxUpdate (data){
          var target = document.getElementById("totalGood");
          // alert("Returned- " + data);
         var returndObj = JSON.parse(data);
        console.log(returndObj);
          document.getElementById("bRunningTotal").value = returndObj['count(*)'];
          totalGoodParts = returndObj['count(*)'] * partsPerBox;
          target.innerHTML = totalGoodParts;
          console.log("Total good Parts in function: " + totalGoodParts) ;
          totalPartCount(totalGoodParts);

        });


      } else if (event.charCode == 117) { // testing if box key was pressed
        if (lastKeyPressed.length==0) {
          alert ("I'm sorry, that is as far back as you can go.")
        } else {
          dbUpdate(tallyId, lastKeyPressed.slice(-1)[0], -1);
          lastKeyPressed.pop();
          console.log("*NEW* Number of undos" , lastKeyPressed.length);
        }


      // } else {
      // alert("Invalid key pressed!");
    }
  });
  totalPartCount();

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
          mt = returndObj.Mutilation;
        } else if ('Plating' in returndObj) {
          // console.log("Plating");
          document.getElementById("pRunningTotal").value = returndObj.Plating;
          pt = returndObj.Plating;
        } else if ('Mixed' in returndObj) {
          // console.log("Mixed");
          document.getElementById("xRunningTotal").value = returndObj.Mixed;
          xt = returndObj.Mixed;
        } else {
          alert ("There was a problem with updating quantities");
        }

        totalPartCount();


        });
        totalPartCount();

}


// function start_new_time()
// document.getElementById("startBtn").addEventListener("click", function() {
//   var e = document.getElementById("addSorter");
//   var sorterID = e.options[e.selectedIndex].value;
//   var startTime = new Date();

//   <?php $start = new DateTime(); ?>
// console.Log("<?php echo $start; ?>");
//   // start_tally_time(tallyId, sorterID, <?php echo $start; ?>);
// });


</script>



<?php include('staff_footer.php'); ?>
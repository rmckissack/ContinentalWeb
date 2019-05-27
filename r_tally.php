<?php

require_once('f_initialize.php');
$table_list = all_sort_tables();
$parts_detail = find_all_parts();

if(is_post_request()) {

  $tally_search = [];
  $tally_search['startDate'] = e($_POST['startDate'] ?? '');
  $tally_search['endingDate'] = e($_POST['endingDate'] ?? '');
  $tally_search['lotNum'] = e($_POST['lotNum'] ?? '');
  $tally_search['partNumber'] = e($_POST['partNumber'] ?? '');
  $tally_search['table'] = e($_POST['table'] ?? '');
  $tally_search['complete'] = e($_POST['complete'] ?? '');
  // echo $_POST['table'];
  // echo "here " . $tally_search['table'] . " to here";
  $result = search_tally_view($tally_search);
  // print_r($result);

} else {

  $tally_lookup = [];
  $tally_lookup['startDate'] = '';
  $tally_lookup['endingDate'] = '';
  $tally_lookup['lotNum'] = '';
  $tally_lookup['partNumber'] = '';
  $tally_lookup['table'] = '';

  // $inbound_set = find_all_inbound();
  // mysqli_free_result($inbound_set);

}

?>

<?php $page_title = 'Create Inbound'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}
?>

<div id="form">



  <div class="page new">
    <h1>Tally sheet report</h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">

    <h2>Search by:</h2>
      <dl>
        <dt>Starting Date</dt>
        <dd><input type="date" id="startDate" name="startDate"  autofocus/></dd>
      </dl>
      <dl>
        <dt>Ending Date</dt>
        <dd><input type="date" id="endingDate" name="endingDate"  /></dd>
      </dl>
      <dl>
        <dt>Lot Number</dt>
        <dd><input type="text" id="lotNum" name="lotNum" /></dd>
      </dl>
      <dl>
        <dt>Part Number</dt>
        <dd><input type="text" id="partNumber" name="partNumber" /></dd>
      </dl>
      <dl>
        <dt>Table Number</dt>
        <dd>
      <select id="table" name="table" onchange="table_selected()">
   <option value="" disabled selected>- Select -</option>

   <?php while($table = mysqli_fetch_assoc($table_list)) { ?>
   <option value="<?php echo h($table['tableNumber']); ?>"><?php echo h($table['tableNumber']); ?></option>
   <?php } ?>
          </select>
          </dd>
    </dl>
    <dl>
      <dd>
      <dt>Select Status:</dt>
      <input type="radio" name="complete" value="2" checked>Both
      <input type="radio" name="complete" value="0" >Not Completed
      <input type="radio" name="complete" value="1" >Completed<br>
      </dd>
    </dl>




      <!-- <dl>
        <dt>Trip Number</dt>
        <dd>
          <select name="tripNumber">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </dd>
      </dl> -->
      

      <div id="operations">
        <input type="submit" value="Search Database" />
      </div>
    </form>
  </div>

<div>
<?php
if(isset($result)) {


(int)$tubsTotal = 0;
(int)$mutilationTotal = 0;
(int)$platingTotal = 0;
(int)$mixedTotal = 0;
(int)$overFlowTotal = 0;
(int)$boxesTotal = 0;
(int)$completedtotal = 0;
(int)$goodPartsTotal = 0;
(int)$partsTotal = 0;
(int)$tallyTotal = 0;

echo "<h1 class='tbl_title'>Tally Detail</h1>";
echo "  <table class='list'>";

echo "    <tr>";
echo "      <th>Part Number</th>";
echo "      <th>Lot Number</th>";
echo "      <th>PO Number</th>";
echo "      <th>Tally ID</th>";
echo "      <th>Table Number</th>";
echo "      <th>Tally Date</th>";
echo "      <th>Tubs Received</th>";
echo "      <th>Mutilation</th>";
echo "      <th>Plating</th>";
echo "      <th>Mixed</th>";
echo "      <th>Overflow</th>";
echo "      <th>Boxes</th>";
echo "      <th>Completed</th>";
echo "      <th>Total Good</th>";
echo "      <th>Total Parts</th>";
echo "    </tr>";

          while($item = mysqli_fetch_assoc($result)) {
echo "      <tr>";
echo "        <td>" . h($item['partNumber']) . "</td>";
echo "        <td>" . h($item['lotNumber']) . "</td>";
echo "        <td>" . h($item['poNumber']) . "</td>";
echo "        <td>" . h($item['tallyId']) . "</td>";
echo "        <td>" . h($item['tableNumber']) . "</td>";
echo "        <td>" . h($item['tallyDate']) . "</td>";
echo "        <td>" . h($item['tubsReceived']) . "</td>";
echo "        <td>" . h($item['mutilatoion']) . "</td>";
echo "        <td>" . h($item['plating']) . "</td>";
echo "        <td>" . h($item['mixed']) . "</td>";
echo "        <td>" . h($item['overflow']) . "</td>";
echo "        <td>" . h($item['boxes']) . "</td>";
echo "        <td>" . h($item['completed'] == '1' ? 'Y' : 'N') . "</td>";
echo "        <td>" . h($item['boxes'] * $item['perBox']) . "</td>";
echo "        <td>" . h($item['boxes'] * $item['perBox'] + $item['mutilatoion'] + $item['plating'] + $item['mixed']) . "</td>";
echo "      </tr>";

$mutilationTotal = $mutilationTotal + (int)$item['mutilatoion'];
$platingTotal = $platingTotal + (int)$item['plating'];
$mixedTotal = $mixedTotal + (int)$item['mixed'];
$overFlowTotal = $overFlowTotal + (int)$item['overflow'];
$boxesTotal = $boxesTotal + (int)$item['boxes'];
$completedtotal = $completedtotal + (int)$item['completed'];
$goodPartsTotal = $goodPartsTotal + (int)$item['boxes'] * (int)$item['perBox'];
$partsTotal = $partsTotal + (((int)$item['boxes'] * (int)$item['perBox']) + (int)$item['mutilatoion'] + (int)$item['plating'] + (int)$item['mixed']);
$tallyTotal++;
// $tubsTotal = $tubsTotal + (int)$item['Tubs_Received'];

         }

echo "      <tr class='total'>";
echo "        <td>Totals</td>";
echo "        <td></td>";
echo "        <td></td>";
echo "        <td>" . $tallyTotal . "</td>";
echo "        <td></td>";
echo "        <td></td>";
echo "        <td></td>";
echo "        <td>" . $mutilationTotal . "</td>";
echo "        <td>" . $platingTotal . "</td>";
echo "        <td>" . $mixedTotal . "</td>";
echo "        <td>" . $overFlowTotal . "</td>";
echo "        <td>" . $boxesTotal . "</td>";
echo "        <td>" . $completedtotal . "</td>";
echo "        <td>" . $goodPartsTotal . "</td>";
echo "        <td>" . $partsTotal . "</td>";
echo "  </table>";

} ?>


</div>












</div>
<script>

// get current date and date for 1st day of current month
// insert first day in startDate and current day as endDate
$(document).ready( function() {
    var now = new Date();
 
    var startDay = ("01");
    var startMonth = ("0" + (now.getMonth() + 1)).slice(-2);
    var startDate = now.getFullYear()+"-"+(startMonth)+"-"+(startDay) ;
    
    var endDay = ("0" + now.getDate()).slice(-2);
    var endMonth = ("0" + (now.getMonth() + 1)).slice(-2);
    var endDate = now.getFullYear()+"-"+(endMonth)+"-"+(endDay) ;


   $('#startDate').val(startDate);
   $('#endingDate').val(endDate);
    
  
});

// end date insert function


</script>
<?php include('staff_footer.php'); ?>

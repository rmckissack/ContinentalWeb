<?php require_once('f_initialize.php');


// $id = isset($_GET['id']) ? $_GET['id'] : '1';
// $inboundBOL = $_GET['inboundBOL'];
// $InboundDate = $_GET['InDate'];
$id = $_GET['id'];
$thisBOL = $id;
// echo $thisBOL;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $date = date('now');
  // $date = strtotime($date);
    $new_LOT = [];
    $new_LOT['LotNum'] = e($_POST['LotNum']);
    $new_LOT['PartNum'] = e($_POST["PartNum"]);
    $new_LOT['dueDate'] = e($_POST["dueDate"]);
    $new_LOT['hotList'] = e($_POST["hotList"]);
    $new_LOT['completed'] = e($_POST["completed"]);
    if($new_LOT['dueDate'] == '') {
      $new_LOT['dueDate'] = '0000-00-00';
    }
    $lotID = insert_LOT($new_LOT);

  $new_item = [];
  $new_item['inboundBOL'] = e($_POST["inboundBOL"]);
  $new_item['PartNum'] = e($_POST["PartNum"]);
  $new_item['LotId'] = $lotID;
  $new_item['PoNum'] = e($_POST['PoNum']);
  $new_item['QtyTubs'] = e($_POST['QtyTubs']);
  $new_item['QtySkids'] = e($_POST['QtySkids']);
  $new_item['QtyBoxes'] = e($_POST['QtyBoxes']);
if($new_item['QtyTubs'] == '') {
  $new_item['QtyTubs'] = '0';
}
if($new_item['QtySkids'] == '') {
  $new_item['QtySkids'] = '0';
}
if($new_item['QtyBoxes'] == '') {
  $new_item['QtyBoxes'] = '0';
}



  $result = insert_inbound_item($new_item);

  $thisBOL = $new_item['inboundBOL'];
  redirect_to('in_new_inbound_items.php?id=' . $thisBOL);

} else {
// var_dump($_SERVER);
  $new_item = [];
  $new_item['inboundBOL'] = $thisBOL;
  $new_item['PartNum'] ='';
  $new_item['LotId'] = '';
  $new_item['PoNum'] = '';
  $new_item['QtyTubs'] = '0';
  $new_item['QtySkids'] = '0';
  $new_item['QtyBoxes'] = '0';
  $new_item['dueDate'] = '';
  $new_item['hotList'] = '0';
}
$inbound = find_inbound_by_BOL($id);
$item_set = find_inbound_items_by_BOL($id);
$part_list = find_all_parts();
$partsArray = [];
while($partNumbers = mysqli_fetch_assoc($part_list)) {
  $partsArray += $partNumbers;
}

$containers = total_tubs_on_bol($thisBOL);
// var_dump($partsArray);
// echo $containers['totalTubs'];
?>


<?php $page_title = 'Show Inbound'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>



  <div class="subject show">

    <h1>Enter Inbound Items:</h1>

    <table class="tbl_head">
      <tr>
      <!-- Inpur row headings   -->
        <th>Inbound Date</th>
        <th>Inbound BOL</th>
        <th>Trip Number</th>
        </tr>

      <tr>
          <td>
            <?php echo h($inbound['InDate']); ?>
          </td>
          <td>
            <?php echo h($inbound['inboundBOL']); ?>
          </td>
          <td>
            <?php echo h($inbound['TripNum']); ?>
          </td>
          </tr>
    </table>


  </div>
  <div id="additem">
  <h1>Add Item:</h1>
  <!-- start new add item form++++++++++++++++++++++++++++++++++++ -->

  <div id="form">


    <div class="additem">

      <form id="addPart" action="<?php $thisScript; ?>" method="post" autocomplete="off">

        <table class="list">
          <tr>
          <!-- Input row headings   -->
            <th>Part Number</th>
            <th>Lot Number</th>
            <th>PO Number</th>
            <th>Tubs</th>
            <th>Skids</th>
            <th>Boxes</th>
            <th>Due Date</th>
            <th>Hot List</th>
          </tr>
          <?php
          while($item = mysqli_fetch_assoc($item_set)) {
            echo '<tr>';
              echo '<td>' . h($item['PartNum']) .'</td>';
              echo '<td>' . h($item['LotNum']) . '</td>';
              echo '<td>' . h($item['PoNum']) . '</td>';
              echo '<td>' . h($item['QtyTubs']) . '</td>';
              echo '<td>' . h($item['QtySkids']) . '</td>';
              echo '<td>' . h($item['QtyBoxes']) . '</td>';

              echo '<td>';
              if(h($item['dueDate']) == '0000-00-00') {
                echo '</td>';
              } else {
                echo h($item['dueDate']) . '</td>';
              }

              echo '<td><input type="checkbox" disabled ';
              if($item['hotList'] == '1') {
                echo ' checked></td>';
              } else {
                echo ' ></td>';
               }
            echo '</tr>';
          }

        ?>

                  <!-- Input fields for items -->

          <tr>

              <td>
              <input list="partNumbers" name="PartNum" autofocus required>
                <datalist id="partNumbers">
                <?php
                $moreParts = find_all_parts();
                while($mp = mysqli_fetch_assoc($moreParts)) {
                  echo "\t\t\t\t<option value=\"" . $mp["PartNum"] . "\">\n";

                }
                ?>
                </datalist>

              <!-- <input type="text" name="PartNum" id="PartNum" autofocus required /> -->
            </td>


              <td>
                <input type="text" name="LotNum" autocomplete="off" required pattern="[0-9]{7}">
                <!-- pattern limits the input to numbers only and a fixed length of 7 digits -->
              </td>
              <td>
                <input type="text" name="PoNum" autocomplete="off" required pattern="[0-9]{7,8}">
                <!-- pattern limits the input to numbers only and a fixed length of 7 or 8 digits
                  length is normally 7 but have had a couple that are 8 digits -->
              </td>

              <td>
                <input class="qty" type="number" name="QtyTubs" autocomplete="off">
              </td>
              <td>
                <input class="qty" type="number" name="QtySkids" autocomplete="off">
              </td>
              <td>
                <input class="qty" type="number" name="QtyBoxes" autocomplete="off">
              </td>
              <td>
                <input type="date" name="dueDate" >
              </td>
              <td>
                <input type="hidden" name="hotList" value="0" />
                <input type="checkbox" name="hotList" value="1"/>
              </td>
              </tr>
        </table>
        <input type="hidden" name="completed" value="0" />
        <input type="hidden" id="inboundBOL" name="inboundBOL" value="<?php echo $id ?>"/>

        <div id="operations">
          <input type="submit" id="submit_item" value="Click Here To Save Current Item" />
          <h2> Total Tubs on BOL =  <?php echo $containers['totalTubs']; ?></h2>
        </div>
    </form>
      </div>
              </div>
</div>

<script>
// $(function() {
//       $("#PartNum").autocomplete({
//         source: "autocomplete_parts.php",

//     });
// });

// function validatePartNum() {
//     var array = $partsArray;
//     var x = document.getElementById("PartNum").value;
//     if (array.includes(x)) {
//         var answer = true;
//       } else {
//         var answer = false;
//       }
//         return answer;
//     }


// window.onload = function() {
//     document.getElementById("PartNum").focus();
// };
</script>

<?php include('staff_footer.php'); ?>

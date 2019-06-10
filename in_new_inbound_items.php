<?php require_once('f_initialize.php');


// $id = isset($_GET['id']) ? $_GET['id'] : '1';
// $inboundBOL = $_GET['inboundBOL'];
// $InboundDate = $_GET['inDate'];
$id = $_GET['id'];
$thisBOL = $id;
// echo $thisBOL;
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $date = date('now');
  // $date = strtotime($date);
    $new_LOT = [];
    $new_LOT['lotNumber'] = e($_POST['lotNumber'] ?? '');
    $new_LOT['poNumber'] = e($_POST['poNumber'] ?? '');
    $new_LOT['partNumber'] = e($_POST["partNumber"] ?? '');
    $new_LOT['dueDate'] = e($_POST["dueDate"] ?? '0000-00-00');
    $new_LOT['hotList'] = e($_POST["hotList"] ?? '');
    $new_LOT['completed'] = e($_POST["completed"] ?? '');


    $lotID = insert_LOT($new_LOT);

  $new_item = [];
  $new_item['inboundBOL'] = e($_POST["inboundBOL"] ?? '');
  $new_item['partNumber'] = e($_POST["partNumber"] ?? '');
  $new_item['lotId'] = $lotID;
  $new_item['quantityOfTubs'] = e($_POST['quantityOfTubs'] ?? '0');
  $new_item['quantityOfSkids'] = e($_POST['quantityOfSkids'] ?? '0');
  $new_item['quantityOfBoxes'] = e($_POST['quantityOfBoxes'] ?? '0');





  $result = insert_inbound_item($new_item);

  $thisBOL = $new_item['inboundBOL'];
  redirect_to('in_new_inbound_items.php?id=' . $thisBOL);

} else {
// var_dump($_SERVER);
  $new_item = [];
  $new_item['inboundBOL'] = $thisBOL;
  $new_item['partNumber'] ='';
  $new_item['lotId'] = '';
  // $new_item['poNumber'] = '';
  $new_item['quantityOfTubs'] = '0';
  $new_item['quantityOfSkids'] = '0';
  $new_item['quantityOfBoxes'] = '0';
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
            <?php echo h($inbound['inDate']); ?>
          </td>
          <td>
            <?php echo h($inbound['inboundBOL']); ?>
          </td>
          <td>
            <?php echo h($inbound['tripNumber']); ?>
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
              echo '<td>' . h($item['partNumber']) .'</td>';
              echo '<td>' . h($item['lotNumber']) . '</td>';
              echo '<td>' . h($item['poNumber']) . '</td>';
              echo '<td>' . h($item['quantityOfTubs']) . '</td>';
              echo '<td>' . h($item['quantityOfSkids']) . '</td>';
              echo '<td>' . h($item['quantityOfBoxes']) . '</td>';

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
              <input list="partNumbers" name="partNumber" autofocus required>
                <datalist id="partNumbers">
                <?php
                $moreParts = find_all_parts();
                while($mp = mysqli_fetch_assoc($moreParts)) {
                  echo "\t\t\t\t<option value=\"" . $mp["partNumber"] . "\">\n";

                }
                ?>
                </datalist>

              <!-- <input type="text" name="partNumber" id="partNumber" autofocus required /> -->
            </td>


              <td>
                <input type="text" name="lotNumber" autocomplete="off" required pattern="[0-9]{7}">
                <!-- pattern limits the input to numbers only and a fixed length of 7 digits -->
              </td>
              <td>
                <input type="text" name="poNumber" autocomplete="off" required pattern="[0-9]{7,8}">
                <!-- pattern limits the input to numbers only and a fixed length of 7 or 8 digits
                  length is normally 7 but have had a couple that are 8 digits -->
              </td>

              <td>
                <input class="qty" type="number" name="quantityOfTubs" autocomplete="off">
              </td>
              <td>
                <input class="qty" type="number" name="quantityOfSkids" autocomplete="off">
              </td>
              <td>
                <input class="qty" type="number" name="quantityOfBoxes" autocomplete="off">
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
//       $("#partNumber").autocomplete({
//         source: "autocomplete_parts.php",

//     });
// });

// function validatepartNumber() {
//     var array = $partsArray;
//     var x = document.getElementById("partNumber").value;
//     if (array.includes(x)) {
//         var answer = true;
//       } else {
//         var answer = false;
//       }
//         return answer;
//     }


// window.onload = function() {
//     document.getElementById("partNumber").focus();
// };
</script>

<?php include('staff_footer.php'); ?>

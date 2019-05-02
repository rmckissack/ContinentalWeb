<?php require_once('f_initialize.php'); ?>

<?php

// $id = isset($_GET['PartNum']) ? $_GET['PartNum'] : '1';
$partNum = $_GET['PartNum'];

$partDetailSet = find_part_by_id($partNum);
// $partDetail = [];
// while($partDetail = mysqli_fetch_assoc($partResult)) {
//   echo '<tr>';
//     echo '<td>' . h($partDetail['PartNum']) .'</td>';
//     echo '<td>' . h($partDetail['Description']) .'</td>';
//     echo '<td>' . h($partDetail['Packaging']) .'</td>';
//     echo '<td>' . h($partDetail['WeightClass']) .'</td>';
//     echo '<td>' . h($partDetail['PiecePrice']) .'</td>';
//     echo '<td>' . h($partDetail['Mutilation']) .'</td>';
//     echo '<td>' . h($partDetail['Plating']) .'</td>';
//     echo '<td>' . h($partDetail['Mixed']) .'</td>';
//     echo '<td>' . h($partDetail['NoGo']) .'</td>';
//   echo '</tr>';
// }

?>


<?php $page_title = 'Show Part'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}
$photos = find_part_photos($partNum);
?>



  <div class="page show">
    <h1>Part Number <?php echo h($partNum); ?> Details</h1>


    <dl>
      <dt>Part Number</dt>
      <dd><?php echo h($partDetailSet['PartNum']); ?></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><?php echo h($partDetailSet['Description']); ?></dd>
    </dl>
    <dl>
      <dt>Packaging</dt>
      <dd><?php echo h($partDetailSet['Packaging']); ?></dd>
    </dl>
    <dl>
      <dt>Pieces Per Box</dt>
      <dd><?php echo h($partDetailSet['perBox']); ?></dd>
    </dl>
    <dl>
      <dt>Boxes Per Skid</dt>
      <dd><?php echo h($partDetailSet['perSkid']); ?></dd>
    </dl>
    <dl>
      <dt>Weight Class</dt>
      <dd><?php echo h($partDetailSet['WeightClass']); ?></dd>
    </dl>
    <dl>
      <dt>Piece Price $</dt>
      <dd><?php echo h($partDetailSet['PiecePrice']); ?></dd>
    </dl>
    <dl>
      <dt>Mutilation</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['Mutilation']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Plating</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['Plating']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Mixed</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['Mixed']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>NoGo</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['NoGo']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Box Only</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['boxOnly']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Comment</dt>
      <dd><?php echo h($partDetailSet['comments']); ?></dd>
    </dl>
    <img src="<?php echo $photos['2'] ?>" alt="Part Image" height="150" width="175">
  </div>



<?php include('staff_footer.php'); ?>

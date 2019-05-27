<?php require_once('f_initialize.php'); ?>

<?php

// $id = isset($_GET['partNumber']) ? $_GET['partNumber'] : '1';
$partNumber = $_GET['partNumber'];

$partDetailSet = find_part_by_id($partNumber);
// $partDetail = [];
// while($partDetail = mysqli_fetch_assoc($partResult)) {
//   echo '<tr>';
//     echo '<td>' . h($partDetail['partNumber']) .'</td>';
//     echo '<td>' . h($partDetail['description']) .'</td>';
//     echo '<td>' . h($partDetail['packaging']) .'</td>';
//     echo '<td>' . h($partDetail['weightClass']) .'</td>';
//     echo '<td>' . h($partDetail['piecePrice']) .'</td>';
//     echo '<td>' . h($partDetail['mutilation']) .'</td>';
//     echo '<td>' . h($partDetail['plating']) .'</td>';
//     echo '<td>' . h($partDetail['mixed']) .'</td>';
//     echo '<td>' . h($partDetail['noGo']) .'</td>';
//   echo '</tr>';
// }

?>


<?php $page_title = 'Show Part'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}
$photos = find_part_photos($partNumber);
?>



  <div class="page show">
    <h1>Part Number <?php echo h($partNumber); ?> Details</h1>


    <dl>
      <dt>Part Number</dt>
      <dd><?php echo h($partDetailSet['partNumber']); ?></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><?php echo h($partDetailSet['description']); ?></dd>
    </dl>
    <dl>
      <dt>Packaging</dt>
      <dd><?php echo h($partDetailSet['packaging']); ?></dd>
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
      <dd><?php echo h($partDetailSet['weightClass']); ?></dd>
    </dl>
    <dl>
      <dt>Piece Price $</dt>
      <dd><?php echo h($partDetailSet['piecePrice']); ?></dd>
    </dl>
    <dl>
      <dt>Mutilation</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['mutilation']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Plating</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['plating']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>Mixed</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['mixed']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
    </dl>
    <dl>
      <dt>NoGo</dt>
      <dd><input type="checkbox" <?php echo h($partDetailSet['noGo']) == '1' ? 'checked' : ''; ?> value="1" onclick="return false;"/></dd>
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

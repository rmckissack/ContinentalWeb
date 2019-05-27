<?php

require_once('f_initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php
$update_part=[];
  $update_part['partNumber'] = e($_POST['partNumber']);
  $update_part['description'] = e($_POST['description']);
  $update_part['packaging'] = e($_POST['packaging']);
  $update_part['perBox'] = e($_POST['perBox']);
  $update_part['perSkid'] = e($_POST['perSkid']);
  $update_part['weightClass'] = e($_POST['weightClass']);
  $update_part['piecePrice'] = e($_POST['piecePrice']);
  $update_part['mutilation'] = test_checkbox(e($_POST['mutilation']));
  $update_part['plating'] = test_checkbox(e($_POST['plating']));
  $update_part['mixed'] = test_checkbox(e($_POST['mixed']));
  $update_part['noGo'] = test_checkbox(e($_POST['noGo']));
  $update_part['boxOnly'] = test_checkbox(e($_POST['boxOnly']));
  $update_part['comments'] = e($_POST['comments']);

$result = update_part($update_part);

  redirect_to('parts_show.php?partNumber=' . $update_part['partNumber']);
} else if(!isset($_GET['partNumber'])) {
  redirect_to('parts_index.php');
} else {

  $partNumber = $_GET['partNumber'];
//
$PartDetail = find_part_by_id($partNumber);
//
//
}

$boxes = find_all_box_type();

?>

<?php $page_title = 'Edit Part'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}
$photos = find_part_photos($partNumber);
?>


  <div class="page new">
    <h1>Edit Part Details for <?php echo h($PartDetail['partNumber']); ?></h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Part Number</dt>
        <dd><input type="text" name="partNumber" required value="<?php echo h($PartDetail['partNumber']); ?>" readonly /></dd>
      </dl>
      <dl>
        <dt>Part Description</dt>
        <dd><input type="text" name="description" value="<?php echo h($PartDetail['description']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Packaging</dt>
        <dd>
          <select name="packaging">
            <?php
            while (($box = mysqli_fetch_assoc($boxes)) !=null) {
              echo "\t\t\t<option value ='" . h($box['box']) . "' ";
              if ($PartDetail['packaging'] == $box['box'])
                echo "selected = 'selected'";
                echo ">{$box['box']}</option>\n";
            }
            ?>
            </select>

        </dd>
      </dl>
      <dl>
        <dt>Pieces Per Box</dt>
        <dd>
          <input type="number" name="perBox" value="<?php echo h($PartDetail['perBox']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Boxes Per Skid</dt>
        <dd>
          <input type="number" name="perSkid" value="<?php echo h($PartDetail['perSkid']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Weight Class</dt>
        <dd>
          <input type="number" name="weightClass" value="<?php echo h($PartDetail['weightClass']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Piece Price $</dt>
        <dd>
          <input type="number" min="0.00000" max="100.00000" step=".00001" name="piecePrice" value="<?php echo h($PartDetail['piecePrice']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Mutilation</dt>
        <dd><input type="checkbox" id="mutilation" name="mutilation" value="1" <?php echo ($PartDetail['mutilation'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Plating</dt>
        <dd><input type="checkbox" id="plating" name="plating" value="1" <?php echo ($PartDetail['plating'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Mixed</dt>
        <dd><input type="checkbox" id="mixed" name="mixed" value="1" <?php echo ($PartDetail['mixed'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>NoGo</dt>
        <dd><input type="checkbox" id="noGo" name="noGo" value="1" <?php echo ($PartDetail['noGo'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Box Only</dt>
        <dd><input type="checkbox" id="boxOnly" name="boxOnly" value="1" <?php echo ($PartDetail['boxOnly'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Comments</dt>
        <dd><textarea name="comments" rows="4" cols="50"><?php echo h($PartDetail['comments']); ?></textarea>
        </dd>
      </dl>
      <img src="<?php echo $photos['2'] ?>" alt="Part Image" height="150" width="175">


      <div id="operations">
        <input type="submit" value="Updat Part Details" />
      </div>
    </form>

  </div>


<?php include('staff_footer.php'); ?>

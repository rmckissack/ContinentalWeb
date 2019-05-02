<?php

require_once('f_initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php
$update_part=[];
  $update_part['PartNum'] = e($_POST['PartNum']);
  $update_part['Description'] = e($_POST['Description']);
  $update_part['Packaging'] = e($_POST['Packaging']);
  $update_part['perBox'] = e($_POST['perBox']);
  $update_part['perSkid'] = e($_POST['perSkid']);
  $update_part['WeightClass'] = e($_POST['WeightClass']);
  $update_part['PiecePrice'] = e($_POST['PiecePrice']);
  $update_part['Mutilation'] = test_checkbox(e($_POST['Mutilation']));
  $update_part['Plating'] = test_checkbox(e($_POST['Plating']));
  $update_part['Mixed'] = test_checkbox(e($_POST['Mixed']));
  $update_part['NoGo'] = test_checkbox(e($_POST['NoGo']));
  $update_part['boxOnly'] = test_checkbox(e($_POST['boxOnly']));
  $update_part['comments'] = e($_POST['comments']);

$result = update_part($update_part);

  redirect_to('parts_show.php?PartNum=' . $update_part['PartNum']);
} else if(!isset($_GET['PartNum'])) {
  redirect_to('parts_index.php');
} else {

  $PartNum = $_GET['PartNum'];
//
$PartDetail = find_part_by_id($PartNum);
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
$photos = find_part_photos($PartNum);
?>


  <div class="page new">
    <h1>Edit Part Details for <?php echo h($PartDetail['PartNum']); ?></h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Part Number</dt>
        <dd><input type="text" name="PartNum" required value="<?php echo h($PartDetail['PartNum']); ?>" readonly /></dd>
      </dl>
      <dl>
        <dt>Part Description</dt>
        <dd><input type="text" name="Description" value="<?php echo h($PartDetail['Description']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Packaging</dt>
        <dd>
          <select name="Packaging">
            <?php
            while (($box = mysqli_fetch_assoc($boxes)) !=null) {
              echo "\t\t\t<option value ='" . h($box['box']) . "' ";
              if ($PartDetail['Packaging'] == $box['box'])
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
          <input type="number" name="WeightClass" value="<?php echo h($PartDetail['WeightClass']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Piece Price $</dt>
        <dd>
          <input type="number" min="0.00000" max="100.00000" step=".00001" name="PiecePrice" value="<?php echo h($PartDetail['PiecePrice']); ?>"/>
        </dd>
      </dl>
      <dl>
        <dt>Mutilation</dt>
        <dd><input type="checkbox" id="Mutilation" name="Mutilation" value="1" <?php echo ($PartDetail['Mutilation'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Plating</dt>
        <dd><input type="checkbox" id="Plating" name="Plating" value="1" <?php echo ($PartDetail['Plating'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>Mixed</dt>
        <dd><input type="checkbox" id="Mixed" name="Mixed" value="1" <?php echo ($PartDetail['Mixed'] == 1 ? 'checked' : '');?>></dd>
      </dl>
      <dl>
        <dt>NoGo</dt>
        <dd><input type="checkbox" id="NoGo" name="NoGo" value="1" <?php echo ($PartDetail['NoGo'] == 1 ? 'checked' : '');?>></dd>
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

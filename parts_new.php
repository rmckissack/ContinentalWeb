<?php

require_once('f_initialize.php');



if(is_post_request()) {

  // Handle form values sent by new.php
$new_part=[];
  $new_part['partNumber'] = e($_POST['partNumber']);
  $new_part['description'] = e($_POST['description']);
  $new_part['packaging'] = e($_POST['packaging']);
  $new_part['perBox'] = e($_POST['perBox']);
  $new_part['perSkid'] = e($_POST['perSkid']);
  $new_part['weightClass'] = e($_POST['weightClass']);
  $new_part['piecePrice'] = e($_POST['piecePrice']);
  $new_part['mutilation'] = e($_POST['mutilation']);
  $new_part['plating'] = e($_POST['plating']);
  $new_part['mixed'] = e($_POST['mixed']);
  $new_part['noGo'] = e($_POST['noGo']);
  $new_part['boxOnly'] = e($_POST['boxOnly']);
  $new_part['comments'] = e($_POST['comments']);

$result = insert_part($new_part);

  redirect_to('parts_show.php?partNumber=' . $new_part['partNumber']);
} else {

  $partNumber = '';
  $description = '';
  $packaging = '';
  $perBox = '';
  $perSkid = '';
  $weightClass = '';
  $piecePrice = '';
  $mutilation = '0';
  $plating = '0';
  $mixed = '0';
  $noGo = '0';
  $boxOnly = '0';
  $comments = '';


}

$boxes = find_all_box_type();
?>

<?php $page_title = 'Create Part'; ?>
<?php include('staff_header.php');

if($_SESSION['level'] !="9" && $_SESSION['level'] !="5") {
  header("Location: noaccess.php");
}

?>


  <div class="page new">
    <h1>Enter Part Details</h1>

    <form action="<?php $thisScript; ?>" method="post" autocomplete="off">
      <dl>
        <dt>Part Number</dt>
        <dd><input type="text" name="partNumber" required value="<?php echo h($partNumber); ?>" /></dd>
      </dl>
      <dl>
        <dt>Part Description</dt>
        <dd><input type="text" name="description" value="<?php echo h($description); ?>" /></dd>
      </dl>
      <dl>
        <dt>Packaging</dt>
        <dd>
          <select name="packaging">
            <option selected disabled value="">-Select Packaging-</option>
            <?php while($box = mysqli_fetch_assoc($boxes)) { ?>
              <option value=<?php echo h($box['box']); ?>><?php echo h($box['box']); ?></option>
            <?php } ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Pieces Per Box</dt>
        <dd>
          <input type="number" name="perBox"/>
        </dd>
      </dl>
      <dl>
        <dt>Boxes Per Skid</dt>
        <dd>
          <input type="number" name="perSkid"/>
        </dd>
      </dl>
      <dl>
        <dt>Weight Class</dt>
        <dd>
          <input type="number" name="weightClass"/>
        </dd>
      </dl>
      <dl>
        <dt>Piece Price $</dt>
        <dd>
          <input type="number" min="0.00000" max="100.00000" step=".00001" name="piecePrice"/>
        </dd>
      </dl>
      <dl>
        <dt>Mutilation</dt>
        <dd><input type="hidden" id="mutilation" name="mutilation" value="0"/>
          <input type="checkbox" id="mutilation" name="mutilation" value="1"/></dd>
      </dl>
      <dl>
        <dt>Plating</dt>
        <dd><input type="hidden" id="plating" name="plating" value="0"/>
          <input type="checkbox" id="plating" name="plating" value="1"/></dd>
      </dl>
      <dl>
        <dt>Mixed</dt>
        <dd><input type="hidden" id="mixed" name="mixed" value="0"/>
          <input type="checkbox" id="mixed" name="mixed" value="1"/></dd>
      </dl>
      <dl>
        <dt>NoGo</dt>
        <dd><input type="hidden" id="noGo" name="noGo" value="0"/>
          <input type="checkbox" id="noGo" name="noGo" value="1"/></dd>
      </dl>
      <dl>
        <dt>Box Only</dt>
        <dd><input type="hidden" id="boxOnly" name="boxOnly" value="0"/>
          <input type="checkbox" id="boxOnly" name="boxOnly" value="1"/></dd>
      </dl>
      <dl>
        <dt>Comments</dt>
        <dd><textarea name="comments" row="4" cols="50"></textarea>
        </dd>
      </dl>


      <div id="operations">
        <input type="submit" value="Create Part" />
      </div>
    </form>

  </div>

</div>

<?php include('staff_footer.php'); ?>

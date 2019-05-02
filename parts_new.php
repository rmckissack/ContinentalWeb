<?php

require_once('f_initialize.php');



if(is_post_request()) {

  // Handle form values sent by new.php
$new_part=[];
  $new_part['PartNum'] = e($_POST['PartNum']);
  $new_part['Description'] = e($_POST['Description']);
  $new_part['Packaging'] = e($_POST['Packaging']);
  $new_part['perBox'] = e($_POST['perBox']);
  $new_part['perSkid'] = e($_POST['perSkid']);
  $new_part['WeightClass'] = e($_POST['WeightClass']);
  $new_part['PiecePrice'] = e($_POST['PiecePrice']);
  $new_part['Mutilation'] = e($_POST['Mutilation']);
  $new_part['Plating'] = e($_POST['Plating']);
  $new_part['Mixed'] = e($_POST['Mixed']);
  $new_part['NoGo'] = e($_POST['NoGo']);
  $new_part['boxOnly'] = e($_POST['boxOnly']);
  $new_part['comments'] = e($_POST['comments']);

$result = insert_part($new_part);

  redirect_to('parts_show.php?PartNum=' . $new_part['PartNum']);
} else {

  $PartNum = '';
  $Description = '';
  $Packaging = '';
  $perBox = '';
  $perSkid = '';
  $WeightClass = '';
  $PiecePrice = '';
  $Mutilation = '0';
  $Plating = '0';
  $Mixed = '0';
  $NoGo = '0';
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
        <dd><input type="text" name="PartNum" required value="<?php echo h($PartNum); ?>" /></dd>
      </dl>
      <dl>
        <dt>Part Description</dt>
        <dd><input type="text" name="Description" value="<?php echo h($Description); ?>" /></dd>
      </dl>
      <dl>
        <dt>Packaging</dt>
        <dd>
          <select name="Packaging">
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
          <input type="number" name="WeightClass"/>
        </dd>
      </dl>
      <dl>
        <dt>Piece Price $</dt>
        <dd>
          <input type="number" min="0.00000" max="100.00000" step=".00001" name="PiecePrice"/>
        </dd>
      </dl>
      <dl>
        <dt>Mutilation</dt>
        <dd><input type="hidden" id="Mutilation" name="Mutilation" value="0"/>
          <input type="checkbox" id="Mutilation" name="Mutilation" value="1"/></dd>
      </dl>
      <dl>
        <dt>Plating</dt>
        <dd><input type="hidden" id="Plating" name="Plating" value="0"/>
          <input type="checkbox" id="Plating" name="Plating" value="1"/></dd>
      </dl>
      <dl>
        <dt>Mixed</dt>
        <dd><input type="hidden" id="Mixed" name="Mixed" value="0"/>
          <input type="checkbox" id="Mixed" name="Mixed" value="1"/></dd>
      </dl>
      <dl>
        <dt>NoGo</dt>
        <dd><input type="hidden" id="NoGo" name="NoGo" value="0"/>
          <input type="checkbox" id="NoGo" name="NoGo" value="1"/></dd>
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

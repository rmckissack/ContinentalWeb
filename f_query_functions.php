<?php
// this group of functions relate to the parts list
  function find_all_parts() {
    global $db;

    $sql = "SELECT * FROM PART ";
    $sql .= "ORDER BY PartNum ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  // function autocomplete_parts() {
  //   global $db;
  //
  //   $sql = "SELECT * FROM PART ";
  //   $sql .= "ORDER BY PartNum ASC";
  //   $result = mysqli_query($db, $sql);
  //   confirm_result_set($result);
  //   $auto_list = mysqli_fetch_assoc($result);
  //   echo json_encode($auto_list);
  // }

  function find_part_by_id($id) {
    global $db;

    $sql = "SELECT * FROM PART ";
    $sql .= "WHERE PartNum='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $partResult = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $partResult; // returns an assoc. array
  }

  function insert_part($part) {
    global $db;

    $sql = "INSERT INTO PART ";
    $sql .= "(PartNum, Description, Packaging, perBox, perSkid, WeightClass, PiecePrice, Mutilation, Plating, Mixed, NoGo, boxOnly, comments) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $part['PartNum']) . "',";
    $sql .= "'" . db_escape($db, $part['Description']) . "',";
    $sql .= "'" . db_escape($db, $part['Packaging']) . "',";
    $sql .= "'" . db_escape($db, $part['perBox']) . "',";
    $sql .= "'" . db_escape($db, $part['perSkid']) . "',";
    $sql .= "'" . db_escape($db, $part['WeightClass']) . "',";
    $sql .= "'" . db_escape($db, $part['PiecePrice']) . "',";
    $sql .= "'" . db_escape($db, $part['Mutilation']) . "',";
    $sql .= "'" . db_escape($db, $part['Plating']) . "',";
    $sql .= "'" . db_escape($db, $part['Mixed']) . "',";
    $sql .= "'" . db_escape($db, $part['NoGo']) . "',";
    $sql .= "'" . db_escape($db, $part['boxOnly']) . "',";
    $sql .= "'" . db_escape($db, $part['comments']) . "')";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_part($part) {
    global $db;

    $sql = "UPDATE PART SET ";
    $sql .= "PartNum='" . db_escape($db, $part['PartNum']) . "', ";
    $sql .= "Description='" . db_escape($db, $part['Description']) . "', ";
    $sql .= "Packaging='" . db_escape($db, $part['Packaging']) . "', ";
    $sql .= "perBox='" . db_escape($db, $part['perBox']) . "', ";
    $sql .= "perSkid='" . db_escape($db, $part['perSkid']) . "', ";
    $sql .= "WeightClass='" . db_escape($db, $part['WeightClass']) . "', ";
    $sql .= "PiecePrice='" . db_escape($db, $part['PiecePrice']) . "', ";
    $sql .= "Mutilation='" . db_escape($db, $part['Mutilation']) . "', ";
    $sql .= "Plating='" . db_escape($db, $part['Plating']) . "',";
    $sql .= "Mixed='" . db_escape($db, $part['Mixed']) . "', ";
    $sql .= "NoGo='" . db_escape($db, $part['NoGo']) . "', ";
    $sql .= "boxOnly='" . db_escape($db, $part['boxOnly']) . "', ";
    $sql .= "comments='" . db_escape($db, $part['comments']) . "'";
    $sql .= "WHERE PartNum='" . db_escape($db, $part['PartNum']) . "' ";
    $sql .= "LIMIT 1";


    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function find_part_photos($partNum) {
    global $db;

    $sql = "SELECT * FROM PHOTOS ";
    $sql .= "WHERE partNum='" . db_escape($db, $partNum) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $partResult = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $partResult; // returns an assoc. array
  }



// start section for inbound functions

function find_all_inbound() {
  global $db;

  $sql = "SELECT * FROM INBOUND ";
  $sql .= "ORDER BY InDate ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_all_inbound_month() {
  global $db;

  $sql = "SELECT * FROM INBOUND ";
  $sql .= "WHERE InDate between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()";
  $sql .= "ORDER BY InDate ASC ";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_inbound_by_date($InDate) {
  global $db;

  $sql = "SELECT * FROM INBOUND ";
  $sql .= "WHERE InDate='" . db_escape($db, $InDate) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $InBound = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $InBound; // returns an assoc. array
}

function find_inbound_by_BOL($inboundBOL) {
  global $db;

  $sql = "SELECT * FROM INBOUND ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $InBoundResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $InBoundResult; // returns an assoc. array
}

function insert_inbound($inbound) {
  global $db;

  $sql = "INSERT INTO INBOUND ";
  $sql .= "(InDate, inboundBOL, TripNum, Note) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $inbound['InDate']) . "',";
  $sql .= "'" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "'" . db_escape($db, $inbound['TripNum']) . "',";
  $sql .= "'" . db_escape($db, $inbound['Note']) . "')";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function insert_inbound_item($new_item) {
  global $db;

  $sql = "INSERT INTO IN_ITEMS ";
  $sql .= "(inboundBOL, LotId, PoNum, QtyTubs, QtySkids, QtyBoxes) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $new_item['inboundBOL']) . "',";
  // $sql .= "'" . db_escape($db, $new_item['PartNum']) . "',";
  $sql .= "'" . db_escape($db, $new_item['LotId']) . "',";
  $sql .= "'" . db_escape($db, $new_item['PoNum']) . "',";
  $sql .= "'" . db_escape($db, $new_item['QtyTubs']) . "',";
  $sql .= "'" . db_escape($db, $new_item['QtySkids']) . "',";
  $sql .= "'" . db_escape($db, $new_item['QtyBoxes']) . "');";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function insert_LOT($new_LOT) {
  global $db;

  $sql = "INSERT INTO LOT ";
  $sql .= "(LotNum, PartNum, dueDate, hotList, completed) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $new_LOT['LotNum']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['PartNum']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['dueDate']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['hotList']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['completed']) . "');";

  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    $last_id = $db->insert_id;
    return $last_id;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_inbound_items_by_date($InDate) {
  global $db;

  $sql = "SELECT * FROM IN_ITEMS ";
  $sql .= "WHERE InDate='" . db_escape($db, $InDate) . "'";
  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  return $item_result;
}


function find_inbound_items_by_BOL($inboundBOL) {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "'";

  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  return $item_result;
}

function find_inbound_items_by_BOL_and_lot($inboundBOL, $LotNum) {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "' ";
  $sql .= "AND LotNum='" . db_escape($db, $LotNum) . "';";

  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  $itemSet = mysqli_fetch_assoc($item_result);
  mysqli_free_result($item_result);
  return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}
function find_by_lot($LotNum) {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE LotNum='" . db_escape($db, $LotNum) . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}

function update_inbound($inbound) {
  global $db;

  $sql = "UPDATE INBOUND SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "InDate='" . db_escape($db, $inbound['InDate']) . "',";
  $sql .= "TripNum='" . db_escape($db, $inbound['TripNum']) . "',";
  $sql .= "Note='" . db_escape($db, $inbound['Note']) . "'";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function update_inbound_item($in_item_update) {
  global $db;

  $sql = "UPDATE IN_ITEMS SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "PoNum='" . db_escape($db, $in_item_update['PoNum']) . "', ";
  $sql .= "QtyTubs='" . db_escape($db, $in_item_update['QtyTubs']) . "', ";
  $sql .= "QtySkids='" . db_escape($db, $in_item_update['QtySkids']) . "', ";
  $sql .= "QtyBoxes='" . db_escape($db, $in_item_update['QtyBoxes']) . "' ";
  $sql .= "WHERE inItemID='" . db_escape($db, $in_item_update['inItemID']) . "' ";
  $sql .= "LIMIT 1;";


  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function update_inbound_lot($lot_update) {
  global $db;

  $sql = "UPDATE LOT SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "LotNum='" . db_escape($db, $lot_update['LotNum']) . "', ";
  $sql .= "PartNum='" . db_escape($db, $lot_update['PartNum']) . "', ";
  $sql .= "dueDate='" . db_escape($db, $lot_update['dueDate']) . "', ";
  $sql .= "hotList='" . db_escape($db, $lot_update['hotList']) . "', ";
  $sql .= "completed='" . db_escape($db, $lot_update['completed']) . "' ";
  $sql .= "WHERE LOT.LotId='" . db_escape($db, $lot_update['LotId']) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function fifo_list() {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE completed = '0' or completed is null ";
  $sql .= "ORDER BY hotList DESC, CASE WHEN dueDate = '0000-00-00' THEN 2 ELSE 1 END,  dueDate, InDate, LotNum";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
return $item_result;

}

function find_all_box_type() {
  global $db;

  $sql = "SELECT * FROM BOX ";
  $sql .= "ORDER BY box ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_all_outbound_month() {
  global $db;

  $sql = "SELECT * FROM OUTBOUND ";
  $sql .= "WHERE DateOut between (CURDATE() - INTERVAL 1 MONTH ) and (CURDATE() + INTERVAL 1 MONTH )";
  $sql .= "ORDER BY DateOut ASC ";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}


function insert_outbound($outBound) {
  global $db;

  $sql = "INSERT INTO OUTBOUND ";
  $sql .= "(DateOut, tripNum, EmptyTubs, Note) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $outBound['DateOut']) . "',";
  // $sql .= "'" . db_escape($db, $inbound['BOL']) . "',";
  $sql .= "'" . db_escape($db, $outBound['tripNum']) . "',";
  $sql .= "'" . db_escape($db, $outBound['EmptyTubs']) . "',";
  $sql .= "'" . db_escape($db, $outBound['Note']) . "')";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


// functions for sorting

function available_lots() {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE completed = '0' or completed is null ";
  $sql .= "ORDER BY  hotList DESC, LotNum";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
return $item_result;

}



function find_all_employees() {
  global $db;

  $sql = "SELECT * FROM EMPLOYEE ";
  $sql .= "ORDER BY LastName ASC, FirstName ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_employee_by_id($id) {
  global $db;

  $sql = "SELECT * FROM EMPLOYEE ";
  $sql .= "WHERE EmployeeID='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $employeeResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $employeeResult; // returns an assoc. array
}

function insert_employee($employee) {
  global $db;

  $sql = "INSERT INTO EMPLOYEE ";
  $sql .= "(LastName, FirstName, HomePhone, CellPhone, Address, City, State, Zip, StartDate, EndDate, WorkStatusID, dob) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $employee['LastName']) . "',";
  $sql .= "'" . db_escape($db, $employee['FirstName']) . "',";
  $sql .= "'" . db_escape($db, $employee['HomePhone']) . "',";
  $sql .= "'" . db_escape($db, $employee['CellPhone']) . "',";
  $sql .= "'" . db_escape($db, $employee['Address']) . "',";
  $sql .= "'" . db_escape($db, $employee['City']) . "',";
  $sql .= "'" . db_escape($db, $employee['State']) . "',";
  $sql .= "'" . db_escape($db, $employee['Zip']) . "',";
  $sql .= "'" . db_escape($db, $employee['StartDate']) . "',";
  $sql .= "'" . db_escape($db, $employee['EndDate']) . "',";
  $sql .= "'" . db_escape($db, $employee['WorkStatusID']) . "',";
  $sql .= "'" . db_escape($db, $employee['dob']) . "')";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_employee($details) {
  global $db;

  $sql = "UPDATE EMPLOYEE SET ";
  $sql .= "EmployeeID='" . db_escape($db, $details['EmployeeID']) . "', ";
  $sql .= "LastName='" . db_escape($db, $details['LastName']) . "', ";
  $sql .= "FirstName='" . db_escape($db, $details['FirstName']) . "', ";
  $sql .= "HomePhone='" . db_escape($db, $details['HomePhone']) . "', ";
  $sql .= "CellPhone='" . db_escape($db, $details['CellPhone']) . "', ";
  $sql .= "Address='" . db_escape($db, $details['Address']) . "', ";
  $sql .= "City='" . db_escape($db, $details['City']) . "', ";
  $sql .= "State='" . db_escape($db, $details['State']) . "', ";
  $sql .= "Zip='" . db_escape($db, $details['Zip']) . "',";
  $sql .= "StartDate='" . db_escape($db, $details['StartDate']) . "', ";
  $sql .= "EndDate='" . db_escape($db, $details['EndDate']) . "', ";
  $sql .= "WorkStatusID='" . db_escape($db, $details['WorkStatusID']) . "', ";
  $sql .= "dob='" . db_escape($db, $details['dob']) . "'";
  $sql .= "WHERE EmployeeID='" . db_escape($db, $details['EmployeeID']) . "' ";
  $sql .= "LIMIT 1";


  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
  } else {
    // UPDATE failed

    db_disconnect($db);
    return mysqli_error($db);
    exit;
  }

}

function find_all_work_status() {
  global $db;

  $sql = "SELECT * FROM WORK_STATUS ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function all_sort_tables() {
  global $db;

  $sql = "SELECT * FROM SORT_TABLES ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_by_lot_id($LotId) {
  global $db;

  $sql = "SELECT * FROM in_with_lot ";
  $sql .= "WHERE LotId='" . db_escape($db, $LotId) . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}

function find_tally_by_id($tallyId) {
  global $db;

  $sql = "SELECT * FROM TALLY ";
  $sql .= "WHERE TallyID='" . db_escape($db, $tallyId) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $tally = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $tally; // returns an assoc. array
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function update_tally_qty($tallyId, $category, $change) {
  global $db;

  // echo ("SRB seaperation complete" . $tallyId . $category . $change . " XXX");
  $sql = "UPDATE TALLY SET ";
  // echo ("sql statement" . $sql);
  $sql .= $category . " = " . $category . " + " . $change;
  // echo ("sql statement" . $sql);
  $sql .= " WHERE TallyID=" . $tallyId;

  echo ("db statement" . $db . "\n");
  echo ("sql statement" . $db . "\n" . $sql . "\n");

  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
    // find_tally_qty($tallyId, $category);
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function find_tally_qty($tallyId, $category) {
  global $db;

  $sql = "SELECT " . $category . " FROM TALLY ";
  $sql .= "WHERE TallyID='" . $tallyId . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

}

function find_box_qty($tallyId) {
  global $db;



  $sql = "SELECT count(*) FROM BOX_COUNT ";
  $sql .= "WHERE tallyID = " . $tallyId ;

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

}

function employee_names() {
  find_all_employees();
$employee_list = find_all_employees(); // get list of employees for drop down list


while($name1 = mysqli_fetch_assoc($employee_list)) {
    echo '<option value="' . h($name1['EmployeeID']) .'">' . h($name1['LastName']) . ', ' . h($name1['FirstName']) . '</option>';
    }
  }




function total_tubs_on_bol($thisBOL)   {
      global $db;

    $sql = "SELECT SUM(QtyTubs) ";
    $sql .= "AS totalTubs ";
    $sql .= "FROM IN_ITEMS ";
    $sql .= "WHERE inboundBOL ='" . db_escape($db, $thisBOL) . "';";


  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  $itemSet = mysqli_fetch_assoc($item_result);
  return $itemSet;


}

function insert_user($user) {
  global $db;

  $sql = "INSERT INTO USERS ";
  $sql .= "(username, password, firstName, lastName, time, email, dateAdded, active, level) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $user['username']) . "',";
  $sql .= "'" . db_escape($db, $user['password']) . "',";
  $sql .= "'" . db_escape($db, $user['firstName']) . "',";
  $sql .= "'" . db_escape($db, $user['lastName']) . "',";
  $sql .= "'" . db_escape($db, $user['time']) . "',";
  $sql .= "'" . db_escape($db, $user['email']) . "',";
  $sql .= "'" . db_escape($db, $user['dateAdded']) . "',";
  $sql .= "'" . db_escape($db, $user['active']) . "',";
  $sql .= "'" . db_escape($db, $user['level']) . "')";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    // echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function dbUserData($username) {
  global $db;

  $sql = "SELECT * FROM USERS ";
  $sql .= "WHERE username ='" . db_escape($db, $username) . "'";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $userResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $userResult;
}

function find_employee_time_by_tally_id($tally_id) {
  global $db;

  $sql = "SELECT * FROM TALLY_TIME ";
  $sql .= "WHERE TallyID='" . db_escape($db, $tally_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}


function lot_completed($lotId) {
  global $db;
echo "lot completed";
  $sql = "UPDATE LOT SET ";
  $sql .= "completed = '1' ";
  $sql .= "WHERE LotId = '" . $lotId . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // mysql_free_result($result);
    return;
}

function overrun($overrun, $tallyId) {
  global $db;
echo "overrun" . $overrun;
  $sql = "UPDATE TALLY SET ";
  $sql .= "Overflow = '" . $overrun . "' ";
  $sql .= "WHERE TallyID = '" . $tallyId . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // mysql_free_result($result);
  return;

}

function employee_tally_list($tally_id) {
global $db;

$sql = "SELECT TALLY_TIME.timeId, TALLY_TIME.EmployeeID, TALLY_TIME.startTime, TALLY_TIME.stopTime, TALLY_TIME.TallyID, EMPLOYEE.EmployeeID, ";
$sql .= "CONCAT_WS (',', `LastName`, `FirstName`) AS `whole_name` "; 
$sql .= "FROM EMPLOYEE ";
$sql .= "INNER JOIN TALLY_TIME ON TALLY_TIME.EmployeeID=EMPLOYEE.EmployeeID ";
$sql .= "WHERE TALLY_TIME.TallyID = '" . $tally_id . "' ";

$result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;

}

function stop_time($timeId) {
global $db;

$sql = "UPDATE TALLY_TIME SET ";
$sql .= "stopTime = '" . NOW()  . "' ";
$sql .= "WHERE timeId = '" . $timeId . "' ";

}

?>

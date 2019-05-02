<?php




// $tally_search['startDate']
// $tally_search['endingDate']
// $tally_search['lotNum']
// $tally_search['partNum'] 
// $tally_search['table']


function search_tally_view($tally_search) {
    global $db;

//   echo "Start Date " . $tally_search['startDate'];
    $sql = "SELECT * FROM TALLY_VIEW WHERE 1 ";
    
    if(!empty($tally_search['startDate']) && !empty($tally_search['endingDate'])) {
        $sql .= "and Tally_Date >= '" . $tally_search['startDate'] . "' AND Tally_Date <= '" . $tally_search['endingDate'] . "' "; 
    } elseif(!empty($tally_search['startDate']) && empty($tally_search['endingDate'])) {
        $sql .= "and Tally_Date >= '" . $tally_search['startDate'] . "' AND Tally_Date <= '9999-99-99' "; 
    } elseif(empty($tally_search['startDate']) && !empty($tally_search['endingDate'])) {
        $sql .= "and Tally_Date >= '0000-00-00' AND Tally_Date <= '" . $tally_search['endingDate'] . "' "; 
    // } elseif(empty($tally_search['startDate']) && empty($tally_search['endingDate'])) {
    //     $sql .= "WHERE "; 
    }

    if(!empty($tally_search['lotNum'])) {
        $sql .= "and Lot = '" . $tally_search['lotNum'] . "' ";
    }
    
    if(!empty($tally_search['partNum'])) {
        $sql .= "and Part = '" . $tally_search['partNum'] . "' ";
    }

    if(!empty($tally_search['table'])) {
        $sql .= "and table_num = '" . $tally_search['table'] . "' ";
    }

    if($tally_search['complete'] != '2') {
        $sql .= "and completed = '" . $tally_search['complete'] . "' ";
    }
// echo "SQL " . $sql;


    // $sql .= "WHERE completed = '0' or completed is null ";
    // $sql .= "ORDER BY hotList DESC, CASE WHEN dueDate = '0000-00-00' THEN 2 ELSE 1 END,  dueDate, InDate, LotNum";
  
  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  return $item_result;
  
  }






?>
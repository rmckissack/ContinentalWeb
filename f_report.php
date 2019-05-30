<?php




// $tally_search['startDate']
// $tally_search['endingDate']
// $tally_search['lotNum']
// $tally_search['partNumber'] 
// $tally_search['table']


function search_tally_view($tally_search) {
    global $db;

//   echo "Start Date " . $tally_search['startDate'];
    $sql = "SELECT * FROM V_TallyView WHERE 1 ";
    
    if(!empty($tally_search['startDate']) && !empty($tally_search['endingDate'])) {
        $sql .= "and tallyDate >= '" . $tally_search['startDate'] . "' AND tallyDate <= '" . $tally_search['endingDate'] . "' "; 
    } elseif(!empty($tally_search['startDate']) && empty($tally_search['endingDate'])) {
        $sql .= "and tallyDate >= '" . $tally_search['startDate'] . "' AND tallyDate <= '9999-99-99' "; 
    } elseif(empty($tally_search['startDate']) && !empty($tally_search['endingDate'])) {
        $sql .= "and tallyDate >= '0000-00-00' AND tallyDate <= '" . $tally_search['endingDate'] . "' "; 
    // } elseif(empty($tally_search['startDate']) && empty($tally_search['endingDate'])) {
    //     $sql .= "WHERE "; 
    }

    if(!empty($tally_search['lotNumber'])) {
        $sql .= "and lotNumber = '" . $tally_search['lotNumber'] . "' ";
    }
    
    if(!empty($tally_search['partNumber'])) {
        $sql .= "and partNumber = '" . $tally_search['partNumber'] . "' ";
    }

    if(!empty($tally_search['poNumber'])) {
        $sql .= "and poNumber = '" . $tally_search['poNumber'] . "' ";
    }
    
    if(!empty($tally_search['tableNumber'])) {
        $sql .= "and tableNumber = '" . $tally_search['tableNumber'] . "' ";
    }

    if($tally_search['complete'] != '2') {
        $sql .= "and completed = '" . $tally_search['complete'] . "' ";
    }
echo "SQL " . $sql;


    // $sql .= "WHERE completed = '0' or completed is null ";
    // $sql .= "ORDER BY hotList DESC, CASE WHEN dueDate = '0000-00-00' THEN 2 ELSE 1 END,  dueDate, inDate, lotNumber";
  
  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  
    // if($tally_search['csv'] == '1') {
    //     $arrayForCSV = mysqli_fetch_assoc($item_result);
    //     sendCSV($arrayForCSV);
    // }

  return $item_result;
  
  }






?>
<?php require_once('f_initialize.php');



// Get search term
$searchTerm = $_GET['term'];

// Get matched data from skills table
$query = $db->query("SELECT * FROM EMPLOYEE WHERE LastName LIKE '".$searchTerm."%' ORDER BY LastName ASC");

// Generate skills data array
$employee_list = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['LastName'];
        array_push($employee_list, $data);
    }
}

// Return results as json encoded array
echo json_encode($employee_list);

?>

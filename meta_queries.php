<?php
require_once("f_initialize.php");
global $db;
// Build query string for keyword query
$query = "SELECT keyword
FROM metaKeywords
WHERE pageID = '$pageID'
ORDER BY position";

// Execute keyword query
$result = mysqli_query($db,$query)
or
die ("<b>Query Failed</b><br />$query<br />" . mysqli_error($db));

$keywordList = ""; // initialize an empty string

// loop through the result set
while ($row = mysqli_fetch_row($result))
{
$keywordList .= $row[0] . ","; // build keyword list with comma
}

$keywordList = rtrim($keywordList, ","); // remove the trailing comma

// Build query string for description query
$query = "SELECT description
FROM metaDescription
WHERE pageID = '$pageID'";

// Execute description query
$result = mysqli_query($db,$query)
or
die ("<b>Query Failed</b><br />$query<br />" . mysqli_error($db));

$row = mysqli_fetch_row($result); // only one row; no loop needed
$metaDescription = $row[0]; // assign description to variable
?>

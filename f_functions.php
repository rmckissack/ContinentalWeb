<?php


function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function e($string="") {
  global $db;
  return mysqli_real_escape_string($db,stripslashes($string));
}




function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function es($subject) {
  if(!isset($subject) || trim($subject) === '') {
    return ' ';
    }
    else
    {
      return $subject;
    }
}

function test_checkbox($check) {
  $checked = 1;
  if(!isset($check) || trim($check) === '') {
    return '0';
    }
    else
    {
      return $checked;
    }
}












?>

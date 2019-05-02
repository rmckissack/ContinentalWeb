<?php
  if(!isset($page_title)) { $page_title = 'Continental Quality'; }
$thisScript  = htmlspecialchars($_SERVER['PHP_SELF']);

echo "<!doctype html>\n";
echo "<html lang=\"en\">\n";
echo "<head>\n";
echo "<title>Continental Quality - $page_title </title>\n";
echo "<meta charset=\"utf-8\">\n";
echo "\t<meta name=\"keywords\" content=\"$keywordList\" />\n";
echo "\t<meta name=\"description\" content=\"$metaDescription\" />\n";
echo "<link rel=\"stylesheet\" href=\"public.css\">\n";
echo "</head>\n";
echo "<body>\n";
echo "<div id=\"wrapper\">\n";
echo "<header class=\"home\">\n";
echo "<div id=\"banner\" role=\"banner\">\n";
echo "<img src=\"images/CQELogoB.png\" alt=\"Continental Company Logo\">\n";

echo "</div> <!-- banner -->\n";
echo "</header>\n";

?>

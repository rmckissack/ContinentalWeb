<?php
$pageID = "home";
$title = "Home Page";
// require("meta_queries.php");
require ("public_header.inc");


echo <<<HEREDOC
<nav class="home">
    <ul>
        <li><button class="active">Home</button></li>
        <li><button onclick="window.location.href = 'contact.php';">Contact Us</button></li>
        <li><button onclick="window.location.href = 'login.php';">User Login</button></li>
    </ul>

</nav>
   <article>
        <h3>WE MAKE WORKING WITH A QUALITY SERVICE PROVIDER A TRUE PERFORMANCE PARTNERSHIP.</h3>
    <img class="qGraphic" src="images/Q-Welcome.gif" alt="Q gear graphic">
    <div class="indent">
        <p>We understand manufacturing and have designed our processes, systems and tools with both the manufacturer and the supplier in mind. We cover all types of industries while supplying a robust suite of services to complement your quality systems.</p>
        <p>If you're looking for a true partner to enhance your manufacturing efforts and mirror your professional culture, then look no further than Continental Quality. We're set to jump in during a crisis and quickly perform at the highest level. Or, we can fill-in for a current provider who may not be delivering to your expectations.</p>
        <p>Your desired results are our primary mission. Whether you're the manufacturer or supplier, our unique ability to leverage thirty years of quality engineering experience to your advantage will:</p>

        <ul class="home_ul">
            <li>REDUCE RISK</li>
            <li>INCREASE PERFORMANCE</li>
            <li>INCREASE PROFITABILITY</li>
            <li>PROTECT YOUR REPUTATION</li>
        </ul>
        </div>
   </article>

HEREDOC;

require ("public_footer.inc");
?>

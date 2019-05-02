<?php
// contact form that customer or visitor can submit and it will be emailed
$pageID = "Contact";
$title = "Contact Us";
$thisScript = htmlspecialchars($_SERVER['PHP_SELF']);
// contact form destination
$contactFirstName = "Leann";
$contactLastName = "McKissack";
$contactEmail = "randy@mckissack.net";
require("meta_queries.php");
require ("public_header.inc");
echo <<<HEREDOC
<nav class="home">
    <ul>
        <li><button onclick="window.location.href = 'index.php';">Home</button></li>
        <li><button class="active">Contact Us</button></li>
        <li><button onclick="window.location.href = 'login.php';">User Login</button></li>
    </ul>

</nav>
   <article>
HEREDOC;



// aontact information

echo "<h1>Contact information:</h1>";
echo "<pre>";
echo "Continental Quality
1524 Jackson Street
Anderson, IN 46016

Phone 765-622-9008";

echo "</pre>";

// google map will not validate Per: Barry with a head ache it will not count against me
echo <<<HEREMAP
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3051.8616980349198!2d-85.68199984890374!3d40.10079637930205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8814d981530a8235%3A0x9aeb94aedd86f50f!2s1524+Jackson+St%2C+Anderson%2C+IN+46016!5e0!3m2!1sen!2sus!4v1544061872158" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
HEREMAP;

//  contact form
if (!isset($_POST['submit']))
{

echo <<<HEREDOC
<form action="$thisScript" method="post" id="emailForm">
<fieldset>
<legend>Send us an email</legend>
<p><label class="oneForty">First Name</label>
<input type="text" name="fname" maxlength="25" placeholder="First Name" autofocus required />
</p>
<p><label class="oneForty">Last Name</label>
<input type="text" name="lname" maxlength="25" placeholder="Last Name" required/>
</p>
<p><label class="oneForty">Email Address</label>
<input type="email" name="email" placeholder="username@domain.com" required />
</p>
<p><label class="oneForty">Telephone</label>
<input type="text" name="telephone" />
</p>
<p><label class="oneForty">Subject</label>
<input type="text" name="subject" required />
</p>
<p>
Message:<br>
<textarea rows="4" cols="50" name="message" form="emailForm">
</textarea>
</p>
</fieldset>
<fieldset>
<input type="reset" name="reset" value="Clear" />
<input type="submit" name="submit" value="Send Message" />
</fieldset>
<fieldset id="msg">
</fieldset>
</form>

HEREDOC;
}
else
{
// Prepare to insert the record
$firstName = e($_POST['fname']);
$lastName = e($_POST['lname']);
$email = e($_POST['email']);
$telephone = e($_POST['telephone']);
$subject = e($_POST['subject']);
$message = e($_POST['message']);

// email message to the user
echo "<p>Your message has been sent.</p>";
echo "<p>Thank you for contacting us.</p>";



// build email headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "To: $contactFirstName $contactLastName <$contactEmail>\r\n";
$headers .= "From: $firstName $lastName <$email>\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-MSMail-Priority: High\r\n";
$headers .= "X-Mailer: PHP / ".phpversion()."\r\n";
$subject = "$subject";

// build email body
$body = "$message<br><br>\n";
$body .= "Sent from: $firstName $lastName<br>\n";
$body .= "Email: $email<br>\n";
$body .= "Telephone: $telephone<br>\n";
$body = stripslashes($body);

// send the email
mail("",$subject,$body,$headers);
}// end IF !ISSET




echo "</article>";

require ("public_footer.inc");

/* JavaScript for chapter14d.php
this script was created by Barry Sullens


*/

var password1 = document.getElementById("pw1");
var password2 = document.getElementById("pw2");
var msgBox    = document.getElementById("msg");

/* validate passwords */
function validatePasswords()
{
  if (password1.value != password2.value)
  {
    msgBox.innerHTML = "Passwords do not match"
    msgBox.style.background = "rgb(255,204,204)";
    msgBox.style.border = "1px solid rgb(255,0,0)";
    password1.focus();
    password1.style.background = "rgb(255,204,204)";
    password1.style.outline = "1px solid rgb(255,0,0)";
    password2.style.background = "rgb(255,204,204)";
    password2.style.outline = "1px solid rgb(255,0,0)";
  }
  else
  {
    msgBox.innerHTML = "";
    msgBox.style.background = "rgb(255,255,255)";
    msgBox.style.border = "2px solid rgb(204,204,204)";
    password1.style.background = "rgb(255,255,255)";
    password1.style.outline = "none";
    password2.style.background = "rgb(255,255,255)";
    password2.style.outline = "none";
  }
}// END FUNCTION validatePasswords

/* create event listeners */
function createEventListeners()
{
   if (password2.addEventListener)
{
     password2.addEventListener("change", validatePasswords, false);
}
else if (password2.attachEvent)
{
     password2.attachEvent("onchange", validatePasswords);
}// END IF password2
}// END FUNCTION createEventListeners

/* run initial form configuration functions */
function setUpPage()
{
   createEventListeners();
} // END FUNCTION setUpPage

/* run setup functions when page finishes loading */
if (window.addEventListener)
{
   window.addEventListener("load", setUpPage, false);
}
else if (window.attachEvent)
{
   window.attachEvent("onload", setUpPage);
}

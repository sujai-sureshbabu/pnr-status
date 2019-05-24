<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style type="text/css">

.submitbutton {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3e7ede), color-stop(1, #5459b8) );
	background:-moz-linear-gradient( center top, #3e7ede 5%, #5459b8 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3e7ede', endColorstr='#5459b8');
	background-color:#3e7ede;
	-moz-border-radius:12px;
	-webkit-border-radius:12px;
	border-radius:12px;
	border:1px solid #ccc0cc;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:23px;
	font-weight:bold;
	padding:7px 20px;
	text-decoration:none;
}.submitbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5459b8), color-stop(1, #3e7ede) );
	background:-moz-linear-gradient( center top, #5459b8 5%, #3e7ede 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5459b8', endColorstr='#3e7ede');
	background-color:#5459b8;
}.submitbutton:active {
	position:relative;
	top:1px;
}


a:hover {

color:yellow;

}

table
{
background-color:grey;
border-color:black;
border-collapse:collapse;
}
body
{
background-color:lightgrey;
}
font.overall
{
font-family:verdana;
}

</style>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<title>Pnr Status checking</title>

<script>
function validateForm()
{
var x=document.forms["pnrstatus"]["pnr"].value;

if (x==null || x=="" || x.length <10 || x.length>10)
  {
  alert("Enter Correct PNR Value");
  return false;
  }
  var numbers = /^[0-9]+$/;
  
	 if(x.match(numbers))  
      {        
      return true;  
	  }
	  else
	  {
			alert("Enter Valid PNR");
			return false;
	  }
  
  
}
</script>

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=317146438410827";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<!--<div style="font-family:verdana;padding:100px;border-radius:30px;border:5px solid #EE872A;"><center>-->
<center><font class="overall">
<table border=1 width=875px height=575px><td>
<font color=#9F9 size="+3"><center><br>Welcome to traininfo.tk ! Check your pnr status </font></center>
<form name="pnrstatus" action="formattedpnr.php" onsubmit="return validateForm()" method="post" id="target"  ><br />
                                         <br /><center><font color=#9F9>Enter Pnr number <input type="text" name="pnr" id="pnr" placeholder="For Eg:4704005910" title="Enter your pnr number" /><br /><br />
                                                      <input type="submit" name="submit" class="submitbutton" id="submit" value="Get Status" title="Click to get pnr status"  /></font><br /><br /><a href="http://traininfo.netii.net/form/">Please give us your feedback</a></center><br><br><hr>
                                                      
                                                              

</form>
<?php
$page = $_SERVER['PHP_SELF'] ;
include ( 'counter.php');
addinfo($page);

 
?>
<h6>Please show your support by liking us</h6>
<div class="fb-like-box" data-href="https://www.facebook.com/Pnrstatusonline" data-width="292" data-show-faces="true" data-colorscheme="light" data-stream="true" data-header="true"></div></td></table></font></center>

</div>
</body>
</html>
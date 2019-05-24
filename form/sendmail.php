<?php
$name=$_POST['Name'];
$email=$_POST['email'];
$feedback=$_POST['Feedback'];

$to="sujaisuresh23@gmail.com";
$subject="feed back fom site";
$msg="NAME: $name\n".
"EMAIL:$email\n".
"FEEDBACK:$feedback";

if(($name!='')&&($email!='')&&($feedback!=''))
{

if(mail($to,$subject,$msg,'From:'.$email))
{

echo "<br>Thank you for your feedback ".$name."<br>";
}
else
{
	echo "feedback not sent";
}
}
else
{
	echo "<h1><br>please fill all the fields</h1>";
}





?>
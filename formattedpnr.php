<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style type="text/css">
th.heading{
	font:Verdana, Geneva, sans-serif;
	color:#C3C;
	background-color:#9F9;
}
td.data{
	font:Verdana, Geneva, sans-serif;
	color:#000;
}
td.legends{
	font:Verdana, Geneva, sans-serif;
	color:#66C;
	
	
}
td.meaning{
	font:Verdana, Geneva, sans-serif;
	color:#63C;
	
}
table
{
	border-collapse:collapse;
	
}
body
{
//background-color:grey;
}

</style>
<body>
<div style="font-family:verdana;padding:50px;border-radius:30px;border:5px solid #FF99CC;">

<?php


$v_p=$_POST['pnr'];

$len=mb_strlen($v_p);

$vali=ctype_digit($v_p);

error_reporting(0);

if($len>=10)
{
	if(!ctype_digit($v_p))
	{
	echo "<font color=#0033FF><center>Invalid Pnr number!Please Enter Valid Pnr number</center></font>";
	}

	else
	{	
		if(isset($v_p))
		{
			$data=array('lccp_pnrno1'=>$v_p,'submit'=>"Wait+For+PNR+Enquiry%21");
			$l=http_build_query($data);
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,"http://www.indianrail.gov.in/cgi_bin/inet_pnrstat_cgi.cgi");
			$headers=array('Accept'=>"text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
			'Accept-Charset'=>"ISO-8859-1,utf-8;q=0.7,*;q=0.3",
			'Accept-Encoding'=>"gzip,deflate,sdch",
			'Accept-Language'=>"en-US,en;q=0.8",
			'Cache-Control'=>"max-age=0",
			'Connection'=>"keep-alive",'Content-Length'=>"53",
			'Content-Type'=>"application/x-www-form-urlencoded",
			'DNT'=>"1",
			'Host'=>"www.indianrail.gov.in",
			'Origin'=>"http://www.indianrail.gov.in",
			'Referer'=>"http://www.indianrail.gov.in/pnr_Enq.html",
			'User-Agent'=>"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.14 Safari/537.17");


			curl_setopt($ch, CURLOPT_USERAGENT,"Chrome/24.0.1312.14");
			curl_setopt($ch,CURLOPT_POSTFIELDS,$headers);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$l);

			curl_setopt($ch,CURLOPT_POST,1);

			curl_setopt($ch,CURLOPT_HEADER,true);

			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

			$str=curl_exec($ch);

			if($str=="")
				{
					echo "Data not returned. <br>1)Your connection might be slow <br>2)Go to <a href=http://traininfo.tk>traininfo.tk</a> and try giving input again ";
				}

				require('simple_html_dom.php');

				$dom_doc = new DOMDocument();

				$dom_doc->loadHTML( $str);

				$titles=$dom_doc->getElementsByTagName('title');
		
				echo "<center><b><font color=#99CC00 >Welcome to PNR Status Checking System by traininfo</font><br><br>";
				//echo "<br><br><center><b><font color=red >Your Query for PNR:".$v_p; 
				//echo "<br/><br/></font>";

				$h1=$dom_doc->getElementsByTagName('h1');
				foreach($h1 as $heading1)
				{
					echo "<br/>";
					echo "<center><b><font color=#99CC00 >" .$heading1->nodeValue;
					echo "<br/><br/></font>";
				}
				 
				
				$xpath = new DOMXPath($dom_doc);
				$ts = $xpath->query('//td[@class="inside_heading_text"]');
				foreach ($ts as $t) 
				{
    
					echo "<center><b><font color=#9933CC>".$t->nodeValue."\n";
					echo "</font>";
   
				}


				$details=$xpath->query('//td[@class="table_border_both"]');
				foreach($details as $det)
				{
					$array[]=$det->nodeValue;
	
				}

				$checksize=sizeof($array);
				

				if($checksize !=0)
				{
					echo "<table border=1>";
					echo "<font color=#FF6600>";
					echo "<br><br>Journey Details - PNR:".$v_p." <br>";
					echo "</font>";
					//echo "<br>";
					echo "<font color=#9933CC>";
					echo "<th class=heading>Train number</th>&nbsp;&nbsp; ";
					echo "<th class=heading>Train name</th>&nbsp;&nbsp; ";
					echo "<th class=heading>Boarding Date</th>&nbsp;&nbsp;";
					echo "<th class=heading>From</th>&nbsp;&nbsp;";
					echo "<th class=heading>To</th>&nbsp;&nbsp;";
					echo "<th class=heading>Reserved upto</th>&nbsp;&nbsp;";
					echo "<th class=heading>Boarding point</th>&nbsp;&nbsp;";
					echo "<th class=heading>Reserved Class</th>&nbsp;&nbsp;";
					echo "<tr>";
					echo "<td class=data>".$array[0]."</td>";
					echo "<td class=data>".$array[1]."</td>";
					echo "<td class=data>".$array[2]."</td>";
					echo "<td class=data>".$array[3]."</td>";
					echo "<td class=data>".$array[4]."</td>";
					echo "<td class=data>".$array[5]."</td>";
					echo "<td class=data>".$array[6]."</td>";
					echo "<td class=data>".$array[7]."</td>";
					echo "</tr>";
					echo "</table>";
					echo "<br>";

					$thtt=$xpath->query('//td[@class="table_border_both" and position()=last()-3 ]');

					$bookingstatus=$xpath->query('//td[@class="table_border_both" and position()=last()-2 ]');

					$currentstatus=$xpath->query('//td[@class="table_border_both" and position()=last()-1 ]');

					$coachposition=$xpath->query('//td[@class="table_border_both" and position()=last() ]');
					
					$charstat=$xpath->query('//td[@class="table_border_both" and position()=last() ]');


					foreach($charstat as $chst)
					{
						$chart[]=$chst->nodeValue;
						
					}
					
					$chartsize=sizeof($chart);
					
					$charting=$chst->nodeValue;
					
					//print_r($chart);
					//print_r($charting);
					
					foreach($coachposition as $cp)
					{
						$cpn[]=$cp->nodeValue;
						
					}
					
					
					//print_r($cpn);
					$coachsize=sizeof($cpn)-2;

					$chartprep="   CHART PREPARED   ";
					$chartnotprep=" CHART NOT PREPARED ";
					
					$checkingcoachposition  = (array_filter($cpn,'is_int'));

					if($charting==$chartnotprep)
					{
					
					$thtt=$xpath->query('//td[@class="table_border_both" and position()=last()-2 ]');

					$bookingstatus=$xpath->query('//td[@class="table_border_both" and position()=last()-1 ]');

					$currentstatus=$xpath->query('//td[@class="table_border_both" and position()=last() ]');
					}

					foreach($currentstatus as $cs)
					{
						$cst[]=$cs->nodeValue;
						
					}
					$si=sizeof($cst);

					foreach($bookingstatus as $bs)
					{	
						$bst[]=$bs->nodeValue;
					}
					$sz=sizeof($bst);

					foreach($thtt as $tht)
					{
						$arr[]=$tht->nodeValue;
					}
					echo "<br>";
					$size=sizeof($arr);

					echo "<font color=#FF6600>";
					echo " Passenger Details<br><br>";
					echo "</font>";
					echo "<table border=1><th class=heading>S.No</th>";
					echo "<th class=heading>Booking Status <hr>(coach no,berth no,quota)</hr></th>";
					echo "<th class=heading>*Current Status<hr>(coach no,berth no)</hr></th>";
					echo "<th class=heading>Coach Position</th>";
					echo "<tr>";
					for($k=1,$l=1;$k<$size;$k++,$l++)
					{

						echo "<td class=data>";
						echo $arr[$k];
						echo "</td>";
						echo "<td class=data>";
						echo $bst[$k];
						echo "</td>";
						echo "<td class=data>";
						echo $cst[$l];
						echo "</td>";
						if($charting==$chartprep)
						{
							echo "<td class=data>";
							echo $cpn[$l];
							echo "</td>";
						}
						else
						{
							echo "<td class=data>";
							echo $charting;
							echo "</td>";
						}
						echo "</tr>";

					}
					echo "</table>";

					echo "<br><br>";
					echo "<font color=#FF6600>";
					echo "Charting Status:</font><font color=#FF0033>".$charting;
					echo "</font>";

					}

					else
					{

						$status=$dom_doc->getElementsByTagName('h2');
						foreach($status as $stat)
						{
							echo "<br/><br/>";
							echo "<center><b><font color=#00CCFF > ".$stat->nodeValue;
						}

						$msg=$dom_doc->getElementsByTagName('h3');
						foreach($msg as $m)
						{
							echo "<br/><br/>";
							echo "<center><b><font color=#00CCFF >".$m->nodeValue;
						}
					}

					$server=$xpath->query("(//b)[position()=last()]");

					foreach($server as $serv)
					{
						echo "<br/><br/>";
						echo "<center><b><font color=#FF0033 ></b>".$serv->nodeValue;
					}
					echo "<hr>";
					echo "<br>";
					echo "<center><b>LEGENDS</b></center><br>";
					echo "<table border=1>";
					echo "<th width=25% class=heading>Symbol</th>";
					echo "<th width=75% class=heading>Meaning</th>";
					echo "<tr>";
					echo "<td class=legends>CAN / MOD</td>";
					echo "<td class=meaning>Cancelled or Modified Passenger</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>CNF / Confirmed</td>";
					echo "<td class=meaning>Confirmed (Coach/Berth number will be available after chart preparation)></td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>RAC</td>";
					echo "<td class=meaning>Reservation Against Cancellation</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>WL #</td>";
					echo "<td class=meaning>Waiting List Number</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>RLWL</td>";
					echo "<td class=meaning>Remote Location Wait List</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>GNWL</td>";
					echo "<td class=meaning>General Wait List</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>PQWL</td>";
					echo "<td class=meaning>Pooled Quota Wait List</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>REGRET/WL</td>";
					echo "<td class=meaning>No More Booking Permitted</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>RELEASE</td>";
					echo "<td class=meaning>Ticket Not Cancelled but Alternative Accommodation Provided</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class=legends>R# #</td>";
					echo "<td class=meaning>RAC Coach Number Berth Number</td>";
					echo "</tr>";
					echo "</table>";

					curl_close($ch);
					unset($v_p);
					}
else
{
header('Location:http://localhost/pnrstatsv2/index.php');
}
}
}
else
{
	echo "<br><center><font color=#FF0066>Invalid Pnr number!Pnr number Must be 10digits.Please Try valid pnr number</font></center>";
}
//error_reporting(E_ERROR | E_PARSE);
//error_reporting(E_ALL^ E_WARNING);
?>
</head>
</div>
</body>
</html>
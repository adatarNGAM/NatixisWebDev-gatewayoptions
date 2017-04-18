<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
		<title>Gateway Option Stats Tool</title>

<style type="text/css">
.breakerBar {
    background-color: #775577;
    color: #FFFFFF;
    padding: 0 0 1px 2px;
}
</style>
<style>   
.error{color:red;text-align:left;margin-left:12%}  
</style>
  <script type="text/javascript" src="../js/epoch_classes.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/epoch_styles.css" />
 </head>
 <body>
 <?php include ("banner.php"); ?>
  <?php
  
 session_start();
 if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome , <b>" . $_SESSION['username'] . "</b>!";
} else {	
    echo "Please log in first to see this page.";
	header("Location: login.php");
    die;    
}
 ?><div><a href="logout.php" id="logout-button">Log Out</a></div>
 <div style="text-align:center;margin-left:12%;margin-top:10px;">   
 <form name="LoginOptionForm" method="post" id="loginOptionFormId" action='<?php echo $_SERVER['PHP_SELF']; ?>' accept-charset='UTF-8'>
<table>
	<tr>	
		<td align="left"><strong>Select Gateway Option:</strong></td> 
		 <td style="padding-left:1px"><select name="gatewayoption" id="gatewayoption" required="Please choose a Gateway Option.">
				<option selected="selected" value="-1">Please Choose&hellip;</option>						
					<option value="1">Gateway Fund</option>								
					<option value="2" selected>Gateway Equity Fund</option>															
			
			</select>
		</td>					
	</tr>		
</table>
</form>

<script>
(function (){
var sel = document.getElementById('gatewayoption');
if (sel) {
	sel.onchange = function () {	
		document.location = 'mdomestic.php';
	};
}
}());
</script>
</div>

 <div style="text-align:center;margin-left:12%;margin-top:20px;"> 
 <?php 
 
 include ("databaseUtil.php"); 

$riskAdjustedFactor = "";
$txtrafCall = "";
$txtrafPut = "";

$percentHedgedWithOptions = "";
$txtphwoCall = "";
$txtphwoPut = "";

$weightedPercentOfStrikePrices = "";
$txtwpospCall = "";
$txtwpospPut = "";
						
$daysToExpirationWeighted = "";
$txtdtewCall = "";
$txtdtewPut = "";
			
$weightedPercentOfAnnualizedCashFlow = "";
$txtwpoacfCall = "";
$txtwpoacfPut = "";

$weightedPercentOfAnnualizedCost = "";
$txtwpoacCall = "";
$txtwpoacPut = "";

$checkdateinDBmodifiedlast = fetchLastModifiedDate('2');  
$gatewaydatedefualt =  $checkdateinDBmodifiedlast;


$gatewayOptions = "2";
$date="";
$category="";
$calls="";
$puts="";


			
			
$sql = "call ank23_ngam_spnGatewayOptionPortfolioStatistics(2);";

	$counter = 0;
foreach ($connection->query($sql) as $obj) {	
	++$counter;
	
	$category = $obj[1];
	$calls = $obj[2];
	$puts = $obj[3];	
	
	if ($counter==1) {
			$riskAdjustedFactor = $category;
			$txtrafCall = $calls;
			$txtrafPut = $puts; 
			} elseif ($counter==2) {
				$percentHedgedWithOptions = $category;
				$txtphwoCall = $calls;
				$txtphwoPut = $puts; 				
				} elseif ($counter==3) {
					$weightedPercentOfStrikePrices = $category;
					$txtwpospCall = $calls;
					$txtwpospPut = $puts; 					
				} elseif ($counter==4) {
					$daysToExpirationWeighted = $category;
					$txtdtewCall = $calls;
					$txtdtewPut = $puts; 					
				} elseif ($counter==5) {
					$weightedPercentOfAnnualizedCashFlow = $category;
					$txtwpoacfCall = $calls;
					$txtwpoacfPut = $puts;					
				} else {
					$weightedPercentOfAnnualizedCost = $category;
					$txtwpoacCall = $calls;
					$txtwpoacPut = $puts;
					}
					
   }
		

?>
  <script type="text/javascript"> 
			var popupcalendar; 
			window.onload = function() { 
				/*get a handle on the containing elements for the 2 calendars*/ 
				var popupGatewayElement = document.getElementById('gatewaydate'); 
			
				/*Initialize the calendars*/ 
				popupcalendar = new Epoch('popupcal','popup',popupGatewayElement,false); 
				
			};
		</script>
		
<form name="domesticLoginForm" method="post" id="domesticloginFormId" action='<?= $_SERVER['REQUEST_URI'] ?>' accept-charset='UTF-8'> 
	<div id="addgatewayForm">
    <table id="heading_info">
      <tr>
        <td align="left">
          <strong>Gateway Fund Option Portfolio Statistics</strong>
        </td>
      </tr>
	  <tr>
        <td>
          &nbsp;
        </td> 
      </tr>	
      <tr>
        <td width="560" style="background-color: #775577;">
          &nbsp;
        </td>
      </tr>
    </table>
    <table cellpadding="2" cellspacing="0" id="main_info" width="563">
      <tr>        
        <td><label for="gatewaydate"><strong>As of date:</strong></label> 
					<input type="text" name="gatewaydate" value="<?php print($gatewaydatedefualt)?>" maxlength="20" id="gatewaydate"/><br/>  					
        </td>        
      </tr>      
      <tr style="background-color: #775577;">
        <td>
          &nbsp;
        </td>
        <td style="color: White; font-weight: bold;" align="center">
          Calls
        </td>        
      </tr>
      <tr class="input">        
        <td>
          	<input type="hidden" name="txtrafCall" id="txtrafCall" value="0000" />	
        </td>
        <td>
          <input type="hidden" name="txtrafPut" id="txtrafPut" value="0000" />	
        </td>	
	
      </tr>
      <tr>
        <td id="PHWO">          
		  <label for="txtphwoCall"><?php print($percentHedgedWithOptions)?>:</label>  
        </td>
        <td>
          <input name="txtphwoCall" type="text"  value="<?php print($txtphwoCall)?>" maxlength="20" id="txtphwoCall" />
          <span id="RequiredFieldValidator3" style="color:Red;display:none;">*</span>
        </td>
        <td>
          <input name="txtphwoPut" type="hidden"  value="<?php print($txtphwoPut)?>" maxlength="20" id="txtphwoPut" />
          <span id="RequiredFieldValidator4" style="color:Red;display:none;">*</span>
        </td>
      </tr>
      <tr>
        <td id="WPOSP">         
		    <label for="txtwpospCall"><?php print($weightedPercentOfStrikePrices)?>:</label>  
        </td>
        <td>
          <input name="txtwpospCall" type="text"  value="<?php print($txtwpospCall)?>" maxlength="20" id="txtwpospCall" />
          <span id="RequiredFieldValidator5" style="color:Red;display:none;">*</span>
        </td>
        <td>
          <input name="txtwpospPut" type="hidden"  value="<?php print($txtwpospPut)?>" maxlength="20" id="txtwpospPut" />
          <span id="RequiredFieldValidator6" style="color:Red;display:none;">*</span>
        </td>
      </tr>
      <tr>
        <td id="DTEW">         
		  <label for="txtdtewCall"><?php print($daysToExpirationWeighted)?>:</label>  
        </td>
        <td>
          <input name="txtdtewCall" type="text"  value="<?php print($txtdtewCall)?>" maxlength="20" id="txtdtewCall" />
          <span id="RequiredFieldValidator7" style="color:Red;display:none;">*</span>
        </td>
        <td>
          <input name="txtdtewPut" type="hidden" value="<?php print($txtdtewPut)?>" maxlength="20" id="txtdtewPut" />
          <span id="RequiredFieldValidator8" style="color:Red;display:none;">*</span>
        </td>
      </tr>
      <tr>
        <td id="WPOACF">           
		   	  <label for="txtwpoacfCall"><?php print($weightedPercentOfAnnualizedCashFlow)?>:</label>
        </td>
        <td>
          <input name="txtwpoacfCall" type="text" value="<?php print($txtwpoacfCall)?>" maxlength="20" id="txtwpoacfCall" />
          <span id="RequiredFieldValidator9" style="color:Red;display:none;">*</span>
        </td>
        <td>
          <input name="txtwpoacfPut" type="hidden"  value="<?php print($txtwpoacfPut)?>" maxlength="20" id="txtwpoacfPut" />
          <span id="RequiredFieldValidator10" style="color:Red;display:none;">*</span>
        </td>
      </tr>
      <tr>
        <td id="WPOAC">           
		     <label for="txtwpoacCall"><?php //print($weightedPercentOfAnnualizedCost)?></label>
        </td>
        <td>
          <input name="txtwpoacCall" type="hidden"  value="<?php print($txtwpoacCall)?>" maxlength="20" id="txtwpoacCall" />
          <span id="RequiredFieldValidator11" style="color:Red;display:none;">*</span>
        </td>
        <td>
          <input name="txtwpoacPut" type="hidden"  value="<?php print($txtwpoacPut)?>" maxlength="20" id="txtwpoacPut" />
          <span id="RequiredFieldValidator12" style="color:Red;display:none;">*</span>
        </td>
      </tr>
      <tr>
        <td>
          &nbsp;
        </td>
      </tr>
      <tr>
        <td>          
					<input type="submit" name = "gatewaysubmit" value="Submit" /> 
					<input type="hidden" name="gatewaydomesticoption" id="gatewaydomesticoption" value="1" />				
        </td>
      </tr>
    </table>
  </div>
</form>
</div>
<br/>
<?php

$txtraf_Call="";
$txtraf_Put="";

$txtphwo_Call="";
$txtphwo_Put="";

$txtwposp_Call="";
$txtwposp_Put="";

$txtdtew_Call="";
$txtdtew_Put="";

$txtwpoacf_Call="";
$txtwpoacf_Put="";

$txtwpoac_Call="";
$txtwpoac_Put="";

$gateway_date="";
$today_date="";

$seven = 7;
$eight = 8;
$nine = 9;
$ten = 10;
$eleven = 11;
$twelve = 12; 


if(isset($_POST['gatewaydomesticoption'])) {
echo "<meta http-equiv='refresh' content='0'>";
$txtraf_Call=$_POST['txtrafCall'];
//$txtraf_Put=$_POST['txtrafPut'];
$txtraf_Put='0000';

$txtphwo_Call=$_POST['txtphwoCall'];
//$txtphwo_Put=$_POST['txtphwoPut'];
$txtphwo_Put='0000';

$txtwposp_Call=$_POST['txtwpospCall'];
//$txtwposp_Put=$_POST['txtwpospPut'];
$txtwposp_Put = '0000';

$txtdtew_Call=$_POST['txtdtewCall'];
//$txtdtew_Put=$_POST['txtdtewPut'];
$txtdtew_Put = '0000';

$txtwpoacf_Call=$_POST['txtwpoacfCall'];
//$txtwpoacf_Put=$_POST['txtwpoacfPut'];
$txtwpoacf_Put= '0000';

//$txtwpoac_Call=$_POST['txtwpoacCall'];
$txtwpoac_Call='0000';
//$txtwpoac_Put=$_POST['txtwpoacPut'];
$txtwpoac_Put = '0000';

$gateway_date=$_POST['gatewaydate'];


$localDateTime = DateTime::createFromFormat('m/d/Y', $gateway_date);


	if (!isset($gateway_date) || $gateway_date !== '') {  
	$today_date = $localDateTime->format('Y-m-d H:i:s');
	
}

 
$errorMessages = "";
		
	if (empty($txtphwo_Call)){     
		$errorMessages = $errorMessages ."% hedged with options Call cannot be empty ";    
		
	} 
	
	if (empty($txtphwo_Put)){     
		$errorMessages = $errorMessages ."% hedged with options Put cannot be empty <br/>";    
		
	}
 	
	if (empty($txtwposp_Call)){     
		$errorMessages = $errorMessages ."Weighted average moneyness Call cannot be empty ";    
		
	} 
	
	if (empty($txtwposp_Put)){     
		$errorMessages = $errorMessages ."Weighted average moneyness Put cannot be empty <br/>";    
		
	}
	
	if (empty($txtdtew_Call)){     
		$errorMessages = $errorMessages ."Days to expiration (weighted) Call cannot be empty ";    
		
	} 
	
	if (empty($txtdtew_Put)){     
		$errorMessages = $errorMessages ."Days to expiration (weighted) Put cannot be empty <br/>";    
		
	}
	
	if (empty($txtwpoacf_Call)){     	
		$errorMessages = $errorMessages ."Weighted % of annualized cash flow  Call cannot be empty";    
	} 
	
	if (empty($txtwpoacf_Put)){     
		$errorMessages = $errorMessages ."Weighted % of annualized cash flow  Put cannot be empty <br/>"; 
		
	}
	
	if (empty($txtwpoac_Call)){     
		$errorMessages = $errorMessages ."Weighted % of annualized cost  Call cannot be empty";    
		
	} 
	
	if (empty($txtwpoac_Put)){     
		$errorMessages = $errorMessages ."Weighted % of annualized cost Put cannot be empty <br/>";
		
	}
	
	
	if (empty($gateway_date)){     
		$errorMessages = $errorMessages ."As of date cannot be empty <br/>";				
		
		} elseif(strtotime($gateway_date) < strtotime($checkdateinDBmodifiedlast)) {
			$errorMessages = $errorMessages . " The as of date entered, " .$gateway_date." must be the same or after the previous as of date ".$checkdateinDBmodifiedlast.". Please select a new as of date.";  
			
			} elseif(strtotime($gateway_date) < strtotime($gateway_date)) {
				$errorMessages = $errorMessages . "As of Date entered cannot be a future date ".$gateway_date;   	
			} 
	}		
			

$link = $connection; 

    $sth = $link->prepare('call ank23_ngam_spnInsertOrUpdateGatewayOptions(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    if (!$sth) {
        die('Prepare failed: ' . $link->error); //TODO: a better error handling
    }
	
	if (!empty($today_date)){ 
		$sth->bindParam(1, $today_date, PDO::PARAM_STR, 12);
		$sth->bindParam(2, $seven, PDO::PARAM_STR, 12);
		$sth->bindParam(3, $txtraf_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(4, $txtraf_Call, PDO::PARAM_STR, 12);
		$sth->bindParam(5, $eight, PDO::PARAM_STR, 12);
		$sth->bindParam(6, $txtphwo_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(7, $txtphwo_Call, PDO::PARAM_STR, 12);
		$sth->bindParam(8, $nine, PDO::PARAM_STR, 12);
		$sth->bindParam(9, $txtwposp_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(10, $txtwposp_Call, PDO::PARAM_STR, 12);
		$sth->bindParam(11, $ten, PDO::PARAM_STR, 12);
		$sth->bindParam(12, $txtdtew_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(13, $txtdtew_Call, PDO::PARAM_STR, 12);
		$sth->bindParam(14, $eleven, PDO::PARAM_STR, 12);
		$sth->bindParam(15, $txtwpoacf_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(16, $txtwpoacf_Call, PDO::PARAM_STR, 12);
		$sth->bindParam(17, $twelve, PDO::PARAM_STR, 12);
		$sth->bindParam(18, $txtwpoac_Put, PDO::PARAM_STR, 12);
		$sth->bindParam(19, $txtwpoac_Call, PDO::PARAM_STR, 12);
		
		if(!$sth->execute()) {
			die('Execute failed: ' . $link->error); //TODO: a better error handling
		}
	}

echo '<div style="text-align:center; margin-right: 52%;font-weight:bold"><a style="text-decoration:none;" href="https://ngam.natixis.com/us/mutual-funds/gateway-equity-call-premium-fund/GCPAX" target="_blank">Click here to view Gateway Equity Call Premium Fund Detail Page</a></div>';	
 
?>

 <?php include ("footer.php"); ?>
 <!-- end div main -->
 </div>
</body>


<?php 

function fetchLastModifiedDate($gatewayoption) {
include ("databaseUtil.php");	

if ($gatewayoption == '2') {
$gatewaylastmoddate = "";

$sql = "SELECT  date_format(`date`, '%m/%d/%Y')  as gatewayOptionDate FROM ank23_ngam_gatewaystats gs, ank23_ngam_gatewaystatslabels gsl where gs.labelID = gsl.GatewayStatsLabelID  AND gs.labelID IN (7,8,9,10,11,12) order by gs.date desc limit 1";
$counter=0;
 			foreach ($connection->query($sql) as $row) {
		++$counter;			
		if($counter = 1) {			
			  $gatewaylastmoddate = $row[0];

		} 
        
    
	
}


return $gatewaylastmoddate;

			
}
			 
        
	

	
	
}
?>
</html>
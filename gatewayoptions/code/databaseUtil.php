 <?php


static $username = "gwuser";
static $password = "l3tm3inGW1";

static $dbname = "natixis";
static $prefix = "ank23_";
$localservername = "localhost";
$localusername = "root";
$localpassword = "";
$localdbname = "natixis";

$use_PDO = true; 
$pdo_error = false;
    try{
        if($use_PDO) {
			
            $connection = new PDO("mysql:host=uat-cms-joomla.cfyebswj6eai.us-east-1.rds.amazonaws.com;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "AWS DB Connected success : ";			
				
        }else{					
			$connection = new PDO("mysql:host=localhost;dbname=natixis", 'root', '');
			//echo "localhost DB Connected success";			
	} 
	}catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        $pdo_error = true;
		
    }
	
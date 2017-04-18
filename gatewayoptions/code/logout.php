<?php
session_start();
if(session_destroy()){
	$url="http://ngam.natixis.com/cs/ContentServer?pagename=ngaMaster/FlushGatewayCache"; 
	$urloutput=file_get_contents($url); 
	echo $urloutput;
header("Location: login.php");
}

?>
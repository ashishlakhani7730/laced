<?php
	//date_default_timezone_set("CST");
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	try 
	{
	    $db = new PDO("mysql:host=$servername;dbname=laced_web_2", $username, $password);
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
	    //echo "Connection failed: " . $e->getMessage();
	}

	define("FIREBASE_API_KEY", "AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ");

	$SiteTitle = "Laced";
/*
   	$DefaultUrl = "http://golaced.com/admin/Items/";
	$DefaultPath = "http://golaced.com/admin/";
   	$DefaultEmailID = "Info@Laced.com";
   	$DefaultEmailSenderName = "Laced";
	*/
	$DefaultUrl = "http://localhost/lacednew/Items/";
	$DefaultPath = "http://localhost/lacednew/";
   	$DefaultEmailID = "Info@Laced.com";
   	$DefaultEmailSenderName = "Laced";

	$mode = "test"; // enviorment of stripe test/production.

   	//check the enviorment it's switch nothing any else.
   	if($mode == "test")
   	{
   		$stripeapikey = "sk_test_fusISb6VHHH4YNsM1n7nHQpk";
   	}
   	else
   	{
   		$stripeapikey = "";
   	}
?>
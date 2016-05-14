<?php 

/*
 *	@author: S. West
 *	@affiliation: Code Alliance
 *	@date: May 2016
 *	@license: cc-by-nc-sa 3.0 IGO
 *
*/

	//get contents from post
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
	$tabloc = mysql_real_escape_string($request["tablelocation"]);

	//temporary array to find which questions and weights were filled out
	$data = array();
	//TODO: revise code to implement POST to MySQL
	foreach($request as $k => $v){
		if(!empty($k)){
			if(!empty($v)){
				$data[$k] = $v;
			}
		}
	}
	//prepare SQL query string
	$final = "INSERT INTO " . $tabloc . " (survrespid,";
	$finalhalf = ") VALUES (";
	
	//attempt to connect to database
	$link = mysql_connect("localhost:3306", "root", "");
	if(! $link ){
		die(mysql_error());
	}
	
	//attempt to load database
	$dbs = mysql_select_db(explode(".",$tabloc)[0],$link);
	if(! $dbs ){
		die(mysql_error());
	}

	//check to see if there is a survey already saved in the database
	$testq1 = mysql_query("SELECT survrespid FROM " . $tabloc . " WHERE survrespid != ''");
	//if not, we'll make the first survey ID as 1
	if($testq1 == ''){
		$finalhalf .= "1,";
	}
	else{
		//find the highest survey id value and increment
		$testq2 = mysql_query("SELECT MAX(survrespid) FROM " . $tabloc);
		$q2row = mysql_fetch_row($testq2);
		$max = intval($q2row[0]);
		$newvar = $max + 1;
		//incremented value is new survey id
		$finalhalf .= $newvar . ",";
	}
	
	foreach($data as $k => $v){
		//don't include the location of the database table in our query
		if($k != "tablelocation"){
			$final .= mysql_real_escape_string($k) . ",";
			//if we have not added a weight to our query string
			//make sure we specify its value is a string rather than an integer
			if($k == "surveyid"){
				$finalhalf .= mysql_real_escape_string($v) . ",";
			}
			else{
				$finalhalf .= "'" . mysql_real_escape_string($k) . ":" . mysql_real_escape_string($v) . "'" . ",";
			}
		}
	}
	//remove trailing commas from our query strings
	$final = rtrim($final, ",");
	$finalhalf = rtrim($finalhalf,",");

	//close our query string values with a right parenthesis and join query substrings together
	$finalhalf .= ")";
	$final .= $finalhalf;
	
	//attempt to post survey to database
	mysql_query($final) or die(mysql_error());
	mysql_close();	
?>
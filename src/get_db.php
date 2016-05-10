<?php

	$link = mysqli_connect("localhost:3306","root","","surveydb");
	if(! $link ){
		die(mysqli_error($link));
	}
	$dbs = mysqli_select_db($link,"surveydb");
	if(! $dbs ){
		die(mysqli_error($link));
	}
	$outstr = "";
	$testfindq = "SELECT survid FROM surveydb.surveyqtb WHERE survid != ''";
	if($testfindq == ''){
			
	}
	else{
		$maxquery = "SELECT MAX(survid) FROM surveydb.surveyqtb";
		$testmq = mysqli_query($link,$maxquery);
		$q2row = mysqli_fetch_row($testmq);
		$max = intval($q2row[0]);
		$surveyq = mysqli_query($link,"SELECT * FROM surveydb.surveyqtb WHERE survid = " .$max);
		if($surveyq->num_rows > 0){
			while($row = $surveyq->fetch_assoc()){
				$teststr = $row;
			}
			foreach($teststr as $r){
				if((!is_numeric($r)) and ($r != '')){
					$outstr .= $r . ",";
				}
			}
		}
	}
	$outstr .= "surveyid:" . $max;
	mysqli_close($link);
	echo $outstr;
?>
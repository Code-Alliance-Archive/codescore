<?php 
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
	$data = array();
	//TODO: revise code to implement POST to MySQL
	$data["s1wt"] = $request["s1wt"];
    echo json_encode($data);
?>
<?php

/*
 *	@author: S. West
 *	@affiliation: Code Alliance
 *	@date: May 2016
 *	@license: cc-by-nc-sa 3.0 IGO
 *
*/

	//retrieve contents from POST
	$postdata = file_get_contents("php://input");
	$request = json_decode("$postdata",true);
	$dbname = mysql_real_escape_string($request["setupname"]);
	$tb1 = mysql_real_escape_string($request["qtab"]);
	$tb2 = mysql_real_escape_string($request["atab"]);

	//create SQL query strings
	$querydbstr = "CREATE DATABASE IF NOT EXISTS " . $dbname;
	$querytb1str = "CREATE TABLE IF NOT EXISTS " . $dbname . "." . $tb1;
	$querytb2str = "CREATE TABLE IF NOT EXISTS " . $dbname . "." . $tb2;
	
	//attempt to connect to MySQL server
	$link = mysql_connect("localhost:3306", "root", "");
	if(! $link ){
		die(mysql_error());
	}
	
	//attempt to create database
	mysql_query($querydbstr) or die(mysql_error());	

	//attempt to load database
	$dbs = mysql_select_db($dbname,$link);
	if(! $dbs ){
		die(mysql_error());
	}

	//attempt to create table for survey questions if it does not already exist
	mysql_query($querytb1str . " (
		survid int(8) NOT NULL AUTO_INCREMENT,
		s1wt int(3),
		s2wt int(3),
		s3wt int(3),
		s4wt int(3),
		s5wt int(3),
		s6wt int(3),
		s7wt int(3),
		s8wt int(3),
		s1q1 nvarchar(255),
		s1q2 nvarchar(255),
		s1q3 nvarchar(255),
		s1q1wt int(3),
		s1q2wt int(3),
		s1q3wt int(3),
		s2q1 nvarchar(255),
		s2q2 nvarchar(255),
		s2q3 nvarchar(255),
		s2q1wt int(3),
		s2q2wt int(3),
		s2q3wt int(3),
		s3q1 nvarchar(255),
		s3q2 nvarchar(255),
		s3q3 nvarchar(255),
		s3q1wt int(3),
		s3q2wt int(3),
		s3q3wt int(3),
		s4q1 nvarchar(255),
		s4q2 nvarchar(255),
		s4q3 nvarchar(255),
		s4q1wt int(3),
		s4q2wt int(3),
		s4q3wt int(3),
		s5q1 nvarchar(255),
		s5q2 nvarchar(255),
		s5q3 nvarchar(255),
		s5q1wt int(3),
		s5q2wt int(3),
		s5q3wt int(3),
		s6q1 nvarchar(255),
		s6q2 nvarchar(255),
		s6q3 nvarchar(255),
		s6q1wt int(3),
		s6q2wt int(3),
		s6q3wt int(3),
		s7q1 nvarchar(255),
		s7q2 nvarchar(255),
		s7q3 nvarchar(255),
		s7q1wt int(3),
		s7q2wt int(3),
		s7q3wt int(3),
		s8q1 nvarchar(255),
		s8q2 nvarchar(255),
		s8q3 nvarchar(255),
		s8q1wt int(3),
		s8q2wt int(3),
		s8q3wt int(3),
		PRIMARY KEY(survid)
	)") or die(mysql_error());
	
	//attempt to create table for survey responses if it does not already exist
	mysql_query($querytb2str . " (
		survrespid int(8) NOT NULL AUTO_INCREMENT,
		surveyid int(8),
		s1q1a nvarchar(255),
		s1q2a nvarchar(255),
		s1q3a nvarchar(255),
		s2q1a nvarchar(255),
		s2q2a nvarchar(255),
		s2q3a nvarchar(255),
		s3q1a nvarchar(255),
		s3q2a nvarchar(255),
		s3q3a nvarchar(255),
		s4q1a nvarchar(255),
		s4q2a nvarchar(255),
		s4q3a nvarchar(255),
		s5q1a nvarchar(255),
		s5q2a nvarchar(255),
		s5q3a nvarchar(255),
		s6q1a nvarchar(255),
		s6q2a nvarchar(255),
		s6q3a nvarchar(255),
		s7q1a nvarchar(255),
		s7q2a nvarchar(255),
		s7q3a nvarchar(255),
		s8q1a nvarchar(255),
		s8q2a nvarchar(255),
		s8q3a nvarchar(255),
		PRIMARY KEY(survrespid),
		FOREIGN KEY (surveyid) REFERENCES surveyqtb(survid)
	)") or die(mysql_error());
				
?>
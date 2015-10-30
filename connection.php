<?php 



function getConnection()  //standard function so that other methods call this to make a new connection
	
		{
	    $conn = @mysql_connect (HOST , USER , PASSWORD);
		mysql_select_db (MAIN_DATABASE, $conn);
		return $conn;
	}
	
	
?>
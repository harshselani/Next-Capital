<?php

function createUser($email,$password){
	    $conn = getConnection();
	    $auth_key="Basic ".base64_encode($email.":".$password);
	   // echo $auth_key;
	    //echo $email;
		$query = "SELECT * FROM user WHERE auth_key LIKE '".$auth_key."' AND activeflag =1";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$insert_id;
		if($rows==0)
		{
			$query = "INSERT INTO user(email ,activeflag ,dateCreated ,loginflag,auth_key) 
					VALUES('".$email."',1 , NOW(),1,'".$auth_key."')";
			$result = mysql_query($query);
			
			if($result)
			{
				$insert_id=mysql_insert_id();
				$message="Success";				
			}
			else{ 
			$insert_id=0;
			$message="Error";				
			}
		}
		else
		{
			$insert_id=0;
			$message="Similar User exists";
		}

		return json_encode(array("id"=>$insert_id,"email"=>$email,"message"=>$message));
}

function login($auth_header){
	$conn = getConnection();
	
	$query = "SELECT * FROM user WHERE auth_key LIKE '".$auth_header."' AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$insert_id;
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		return array(true,$member['ID'],$member['email']);
	}
	else 
		return array(false,0,"");
}

function verifyLogin($auth_header) {
	list($flag,$id,$email)=login($auth_header);
	return json_encode(array("id"=>$id,"email"=>$email));
	
	
}

function createLeague($userID,$name){
	
	    $conn = getConnection();
	    $query = "SELECT * FROM league WHERE name LIKE '".$name."' AND activeflag =1";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		$insert_id;
		if($rows==0)
		{
			$query = "INSERT INTO league(name ,userID, activeflag)
					VALUES('".$name."',".$userID." , 1)";
			$result = mysql_query($query);
				
			if($result)
			{
				$insert_id=mysql_insert_id();
				$message="Success";
			}
			else{
				$insert_id=0;
				$message="Error";
			}
		}
		else
		{
			$insert_id=0;
			$message="Similar League exists";
		}
		
		return json_encode(array("id"=>$insert_id,"user_id"=>$userID,"name"=>$name,"message"=>$message));
		
}

function listAllLeagues(){
	
	$conn = getConnection();
	$query = "SELECT * FROM league WHERE activeflag =1";
	$result = mysql_query($query);
	$output=array();
	while($member = mysql_fetch_array($result)){
		array_push($output, array("id"=>$member['ID'],"user_id"=>$member['userID'],"name"=>$member['name']));
	}
	return json_encode($output);
	
}

function getOneleague($leagueID){
	
	$conn = getConnection();
	$query = "SELECT * FROM league WHERE ID = ".$leagueID." AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		return json_encode(array("id"=>$member['ID'],"user_id"=>$member['userID'],"name"=>$member['name']));
	}
	else
		return json_encode(array("id"=>0,"user_id"=>0,"name"=>""));
		
		
}

function createBowler($userID,$name){
	$conn = getConnection();
	$query = "SELECT * FROM bowler WHERE name LIKE '".$name."' AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$insert_id;
	if($rows==0)
	{
		$query = "INSERT INTO bowler(name ,userID, activeflag)
					VALUES('".$name."',".$userID." , 1)";
		$result = mysql_query($query);
	
		if($result)
		{
			$insert_id=mysql_insert_id();
			$message="Success";
		}
		else{
			$insert_id=0;
			$message="Error";
		}
	}
	else
	{
		$insert_id=0;
		$message="Similar Bowler exists";
	}
	
	return json_encode(array("id"=>$insert_id,"user_id"=>$userID,"name"=>$name,"message"=>$message));
	
}

function listAllBowlers(){
	$conn = getConnection();
	$query = "SELECT * FROM bowler WHERE activeflag =1";
	$result = mysql_query($query);
	$output=array();
	while($member = mysql_fetch_array($result)){
		array_push($output, array("id"=>$member['ID'],"user_id"=>$member['userID'],"name"=>$member['name']));
	}
	return json_encode($output);
	
}

function getOneBowler($bowlerID){
	$conn = getConnection();
	$query = "SELECT * FROM bowler WHERE ID = ".$bowlerID." AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		return json_encode(array("id"=>$member['ID'],"user_id"=>$member['userID'],"name"=>$member['name']));
	}
	else
		return json_encode(array("id"=>0,"user_id"=>0,"name"=>""));
	
}

function addBowlerToLeague($leagueID,$bowlerID,$userID){
	$conn = getConnection();
	$query = "SELECT * FROM league_bowlers WHERE leagueID = '".$leagueID."' AND bowlerID = '".$bowlerID."' AND activeflag = 1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$insert_id;
	if($rows==0)
	{
		$query = "INSERT INTO league_bowlers(leagueID ,bowlerID,userID, activeflag)
					VALUES('".$leagueID."',".$bowlerID.",".$userID." , 1)";
		$result = mysql_query($query);
	
		if($result)
		{
			$insert_id=mysql_insert_id();
			$message="Success";
			$name=getBowler($bowlerID)->getName();
		}
		else{
			$insert_id=0;
			$message="Error";
			$name="";
		}
	}
	else
	{
		$insert_id=0;
		$message="Similar Bowler exists";
		$name="";
	}
	
	return json_encode(array("id"=>$insert_id,"user_id"=>$userID,"name"=>$name,"message"=>$message));
	
}

function listAllBowlerInLeague($leagueID){
	$conn = getConnection();
	$query = "SELECT * FROM league_bowlers WHERE leagueID = '".$leagueID."' AND activeflag =1";
	$result = mysql_query($query);
	$output=array();
	while($member = mysql_fetch_array($result)){
		array_push($output, array("id"=>$member['ID'],"user_id"=>$member['userID'],"name"=>getBowler($member['bowlerID'])->getName()));
	}
	return json_encode($output);
	
}

function createLottery($leagueID,$fromDate,$jackpot){
	$conn = getConnection();
	
	$query = "INSERT INTO lottery (leagueID ,jackpot, activeflag, status)
					VALUES('".$leagueID."',".$jackpot.",1, 0)";
	$result = mysql_query($query);
	
}

function listAllLoteriesInLeague($leagueID){
	$conn = getConnection();
	$query = "SELECT * FROM lottery WHERE leagueID = '".$leagueID."' AND activeflag =1";
	$result = mysql_query($query);
	$output=array();
	while($member = mysql_fetch_array($result)){
		if($member['status']==0)
			$payout=null;
		else
			$payout=$member['winnerPaid'];
		
		array_push($output, array("id"=>$member['ID'],"league_id"=>$member['leagueID'],"balance"=>$member['jackpot']-$member['winnerPaid'],"payout"=>$payout));
	}
	return json_encode($output);
	
}

function getLoterryInLeague($leagueID,$lotteryID){
	$conn = getConnection();
	$query = "SELECT * FROM lottery WHERE ID = ".$lotteryID." AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		
		if($member['status']==0)
			$payout=null;
		else
			$payout=$member['winnerPaid'];
		
				
		return json_encode(array("id"=>$member['ID'],"league_id"=>$member['leagueID'],"balance"=>$member['jackpot']-$member['winnerPaid'],"payout"=>$payout));
	}
	else
		return json_encode(array("id"=>0,"league_id"=>0,"balance"=>"","payout"=>$payout));
	
}

function buyLoteryOfLeague($leagueID,$lotteryID,$bowlerID,$price){
	$conn = getConnection();
	$query = "INSERT INTO league_tickets (lotteryID ,bowlerID,price, activeflag)
					VALUES('".$lotteryID."',".$bowlerID.",".$price.",1)";
	$result = mysql_query($query);
	if($result){
		$insert_id=mysql_insert_id();
		$flag = increaseLotteryJackpot($lotteryID,$price);
		
		return json_encode(array("id"=>1,"lottery_id"=>$lotteryID,"bowler_id"=>$bowlerID,"price"=>$price,"is_winner"=>false));
	
	}
	else
		return json_encode(array("id"=>0,"lottery_id"=>0,"bowler_id"=>0,"price"=>0,"is_winner"=>false));
		
	
}

function increaseLotteryJackpot($lotteryID,$price){
	$query = "SELECT * FROM lottery WHERE ID = ".$lotteryID." AND activeflag =1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		$jackpot=$member['jackpot']+$price;
		

		$query = "UPDATE lottery SET jackpot = '".$jackpot."' WHERE ID= ".$lotteryID;
		$result = mysql_query($query);
		
		return true;
	}
	else
		return false;
	
}

function listTicketsJackpot($leagueID,$lotteryID) {
	
	$conn = getConnection();
	$query = "SELECT * FROM league_tickets WHERE lotteryID = '".$lotteryID."' AND activeflag =1";
	$result = mysql_query($query);
	$output=array();
	while($member = mysql_fetch_array($result)){
		
		if($member['status']==0)
			$status = false;
		else
			$status = true;
		
		array_push($output, array("id"=>$member['ID'],"lottery_id"=>$member['lotteryID'],
				"bowler_id"=>$member['bowlerID'],"price"=>$member['price'],"is_winner"=>$status));
	}
	return json_encode($output);
	
	
}

function drawTicket($leagueID,$lotteryID){
	
	$conn = getConnection();
	

	$query = "SELECT * FROM lottery WHERE ID = '".$lotteryID."' AND activeflag = 1 ";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		
		if($member['status']==0)
		{

			$query = "SELECT * FROM league_tickets WHERE lotteryID = '".$lotteryID."' AND activeflag = 1 ORDER BY RAND()
LIMIT 1";
			$result = mysql_query($query);
			$rows = mysql_num_rows($result);
			if($rows==1)
			{
				$member = mysql_fetch_array($result);
			
				$query = "UPDATE lottery SET winnerID = '".$member['bowlerID']."',status =1 WHERE ID= ".$lotteryID;
				$result = mysql_query($query);
			
				createLottery($lotteryID,null,0);
				
				return json_encode(array("id"=>1,"lottery_id"=>$member['lotteryID'],
						"bowler_id"=>$member['bowlerID'],"pin_count"=>null,"payout"=>null));
			
			}
			else
			{
				return json_encode(array("id"=>null,"lottery_id"=>null,
						"bowler_id"=>null,"pin_count"=>null,"payout"=>null));
			
			}
				
		}
		
		if($member['status']==1){
			return json_encode(array("id"=>1,"lottery_id"=>$lotteryID,
					"bowler_id"=>$member['winnerID'],"pin_count"=>null,"payout"=>null));
				
		}
		
	}
		
	
}

function recordRoll($leagueID,$lotteryID,$pin_count){
	
	//if($pin_count==10)
	
	$query = "SELECT * FROM lottery WHERE ID = '".$lotteryID."' AND activeflag = 1 AND status = 1";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		if($pin_count==10)
			$winnerPaid = $member['jackpot'];
		else
			$winnerPaid = $member['jackpot']*0.1;
		
		$query = "UPDATE lottery SET winnerPin = '".$pin_count."',winnerPaid = '".$winnerPaid."',status =2 WHERE ID= ".$lotteryID;
		$result = mysql_query($query);
		$nextLottery=findNextLottery($lotteryID);
		
		increaseLotteryJackpot($nextLottery,$member['jackpot']-$winnerPaid);
		
		return json_encode(array("id"=>1,"lottery_id"=>$lotteryID,
				"bowler_id"=>$member['winnerID'],"pin_count"=>$pin_count,"payout"=>$winnerPaid));
		
	}
	else
		return json_encode(array("id"=>null,"lottery_id"=>null,
				"bowler_id"=>null,"pin_count"=>null,"payout"=>null));
			
}


function findNextLottery($lotteryID){
	$query = "SELECT * FROM lottery WHERE ID > '".$lotteryID."' AND activeflag = 1 AND status = 0";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	
	if($rows==1)
	{
		$member = mysql_fetch_array($result);
		return $member['ID'];
	}
	else
		return 0;
}



?>
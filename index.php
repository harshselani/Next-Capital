<?php
//print_r($_GET);
include_once 'classes.php';

$temp =apache_request_headers();
$auth_code = $temp['Authorization'];

$condition = $_GET['id'];
//echo $condition;
if($condition=='create-user'){
	$data = json_decode(file_get_contents('php://input'), true);
	$email=$data['email'];
	$password=$data['password'];
	echo createUser($email, $password);
	}
	
	if($condition=='verify-login'){
		
		echo verifyLogin($auth_code);
	}
	
	if($condition=='league'){
		list($flag,$id,$email)=login($auth_code);
		
		if($flag){
		$data = json_decode(file_get_contents('php://input'), true);
		if(isset($data['name'])){
			$name=$data['name'];
			echo createLeague($id,$name);
		}
		else
			echo listAllLeagues();
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
		
	}
	
	if($condition=='get-league'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$leagueID=$_GET['leagueID'];
			echo getOneleague($leagueID);
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	
	}
	
	if($condition=='bowler'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$data = json_decode(file_get_contents('php://input'), true);
			if(isset($data['name'])){
				$name=$data['name'];
				echo createBowler($id,$name);
			}
			else
				echo listAllBowlers();
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	
	}
	
	if($condition=='get-bowler'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$bowlerID=$_GET['bowlerID'];
			echo getOneBowler($bowlerID);
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	
	}
	
	if($condition=='league-bowler'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$leagueID=$_GET['leagueID'];
				
			$data = json_decode(file_get_contents('php://input'), true);
			
			if(isset($data['bowler_id'])){
				$bowlerID=$data['bowler_id'];
			    echo addBowlerToLeague($leagueID,$bowlerID,$id);
			}
			else
				echo listAllBowlerInLeague($leagueID);
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	
	}
	
	if($condition=='league-lotteries'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$leagueID=$_GET['leagueID'];
	
			echo listAllLoteriesInLeague($leagueID);
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	}
	
	if($condition=='get-league-lottery'){
		list($flag,$id,$email)=login($auth_code);
	
	if($flag){
			$lotteryID=$_GET['lotteryID'];
			$leagueID=$_GET['leagueID'];
			//echo $lotteryID;
			echo getLoterryInLeague($leagueID,$lotteryID);
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	}
	
	if($condition=='lottery-ticket'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$lotteryID=$_GET['lotteryID'];
			$leagueID=$_GET['leagueID'];
			$data = json_decode(file_get_contents('php://input'), true);
			
			if(isset($data['bowler_id'])){
				$bowlerID=$data['bowler_id'];
				$price = 10;
				echo buyLoteryOfLeague($leagueID,$lotteryID,$bowlerID,$price);
			}
			else
				echo listTicketsJackpot($leagueID,$lotteryID);
			
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	}
	
	if($condition=='lottery-draw'){
		list($flag,$id,$email)=login($auth_code);
	
		if($flag){
			$lotteryID=$_GET['lotteryID'];
			$leagueID=$_GET['leagueID'];
			
			$data = json_decode(file_get_contents('php://input'), true);
				
			if(isset($data['pin_count'])){
				$pin_count=$data['pin_count'];
				echo recordRoll($leagueID,$lotteryID,$pin_count);
				//echo buyLoteryOfLeague($leagueID,$lotteryID,$bowlerID,$price);
			}
			else
				echo drawTicket($leagueID,$lotteryID);
					
				
			
		}
		else{
			json_encode(array("message"=>"Incorrect credentials!"));
		}
	
	}
	
?>
<?php

include_once 'constant.php';
include_once 'connection.php';
include_once 'functions.php';
include_once 'classsFunctions.php';

class User{
	var $ID;
	var $email;
	var $password;
	var $activeflag;
	var $lastlogin;
	var $loginip;
	var $dateCreated;
	var $loginflag;
	var $auth_key;
	
	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}
	
	function getID()
	{
		return $this->ID;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function getPassword()
	{
		return $this->password;
	}
	
	function getActiveflag()
	{
		return $this->activeflag;
	}
	
	function getLastlogin()
	{
		return $this->lastlogin;
	}
	
	function getLoginIp()
	{
		return $this->loginip;
	}
	
	function getDateCreated()
	{
		return $this->dateCreated;
	}
	
	function getLoginflag()
	{
		return $this->loginflag;
	}
	
	function getAuthKey()
	{
		return $this->auth_key;
	}
	
	function setEmail($temp)
	{
		$this->email=$temp;
	}
	
	function setPassword($temp)
	{
		$this->password=$temp;
	}
	
	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}
	
	function setLastlogin($temp)
	{
		$this->lastlogin=$temp;
	}
	
	function setLoginIp($temp)
	{
		$this->loginip=$temp;
	}
	
	function setDateCreated($temp)
	{
		$this->dateCreated=$temp;
	}
	
	function setLoginflag($temp)
	{
		$this->loginflag=$temp;
	}
	
	function setAuthKey($temp)
	{
		$this->auth_key=$temp;
	}
	
	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM user WHERE ID='".$this->ID."'";
		$result = mysql_query($query);
	
		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);
			$this->setEmail(trim($member['email']));
			$this->setPassword(trim($member['password']));
			$this->setActiveflag(trim($member['activeflag']));
			$this->setLastlogin(trim($member['lastlogin']));
			$this->setLoginIp(trim($member['loginip']));
			$this->setDateCreated(trim($member['datecreated']));
			$this->setLoginflag(trim($member['loginflag']));
			$this->setAuthKey(trim($member['auth_key']));
		}
	
	}
}

class Bowler{
	var $ID;
	var $name;
	var $userID;	
	var $activeflag;
	

	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}

	function getID()
	{
		return $this->ID;
	}

	function getName()
	{
		return $this->name;
	}

	function getActiveflag()
	{
		return $this->activeflag;
	}
	
	function getUserID()
	{
		return $this->userID;
	}

	function setName($temp)
	{
		$this->name=$temp;
	}

	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}
	
	function setUserID($temp)
	{
		$this->userID=$temp;
	}

	
	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM bowler WHERE ID='".$this->ID."'";
		$result = mysql_query($query);

		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);
			$this->setName(trim($member['name']));
			$this->setActiveflag(trim($member['activeflag']));
			$this->setUserID(trim($member['userID']));
				
		}

	}
}

class League{
	var $ID;
	var $name;
	var $userID;
	var $activeflag;


	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}

	function getID()
	{
		return $this->ID;
	}

	function getName()
	{
		return $this->name;
	}
	
	function getUserID()
	{
		return $this->userID;
	}

	function getActiveflag()
	{
		return $this->activeflag;
	}

	function setName($temp)
	{
		$this->name=$temp;
	}

	function setUserID($temp)
	{
		$this->userID=$temp;
	}
	
	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}


	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM league WHERE ID='".$this->ID."'";
		$result = mysql_query($query);

		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);
			$this->setName(trim($member['name']));
			$this->setUserID(trim($member['userID']));
			$this->setActiveflag(trim($member['activeflag']));
				
		}

	}
}

class League_Bowlers{
	var $ID;
	var $leagueID;
	var $bowlerID;
	var $activeflag;


	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}

	function getID()
	{
		return $this->ID;
	}

	function getLeagueID()
	{
		return $this->leagueID;
	}

	function getBowlerID()
	{
		return $this->bowlerID;
	}

	function getActiveflag()
	{
		return $this->activeflag;
	}

	function setLeagueID($temp)
	{
		$this->leagueID=$temp;
	}

	function setBowlerID($temp)
	{
		$this->bowlerID=$temp;
	}

	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}


	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM league_bowlers WHERE ID='".$this->ID."'";
		$result = mysql_query($query);

		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);
		
			$this->setBowlerID(trim($member['bowlerID']));
			$this->setLeagueID(trim($member['leagueID']));
				
			$this->setActiveflag(trim($member['activeflag']));

		}

	}
}

class League_Tickets{
	var $ID;
	var $leagueID;
	var $bowlerID;
	var $activeflag;
	var $league_bowlers_ID;


	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}

	function getID()
	{
		return $this->ID;
	}

	function getLeagueID()
	{
		return $this->leagueID;
	}

	function getBowlerID()
	{
		return $this->bowlerID;
	}

	function getActiveflag()
	{
		return $this->activeflag;
	}
	
	function getLeagueBowlersID()
	{
		return $this->$league_bowlers_ID;
	}

	function setLeagueID($temp)
	{
		$this->leagueID=$temp;
	}

	function setBowlerID($temp)
	{
		$this->bowlerID=$temp;
	}

	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}
	
	function setLeagueBowlersID($temp)
	{
		$this->league_bowlers_ID=$temp;
	}


	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM league_bowlers_ID WHERE ID='".$this->ID."'";
		$result = mysql_query($query);

		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);

			$this->setBowlerID(trim($member['bowlerID']));
			$this->setLeagueID(trim($member['leagueID']));
			$this->setLeagueBowlersID(trim($member['league_bowlers_ID']));
			$this->setActiveflag(trim($member['activeflag']));

		}

	}
}

class Lottery{
	var $ID;
	var $leagueID;
	var $fromDate;
	var $toDate;
	var $jackpot;
	var $winnerID;
	var $winnerPin;
	var $winnerPaid;
	var $activeflag;
	var $status;


	function __construct($ID)
	{
		$this->ID = $ID;
		$this->read();
	}

	function getID()
	{
		return $this->ID;
	}
	
	function getLeagueID()
	{
		return $this->leagueID;
	}

	function getFromDate()
	{
		return $this->fromDate;
	}
	
	function getToDate()
	{
		return $this->toDate;
	}
	
	function getJackpot()
	{
		return $this->jackpot;
	}
	
	function getWinnerID()
	{
		return $this->winnerID;
	}
	
	function getWinnerPin()
	{
		return $this->winnerPin;
	}
	
	function getWinnerPaid()
	{
		return $this->winnerPaid;
	}
	
	function getActiveflag()
	{
		return $this->activeflag;
	}
	
	function getStatus()
	{
		return $this->status;
	}
	


	function setLeagueID($temp)
	{
		$this->leagueID=$temp;
	}
	
	function setFromDate($temp)
	{
		$this->fromDate=$temp;
	}
	
	function setToDate($temp)
	{
		$this->toDate=$temp;
	}
	
	function setJackpot($temp)
	{
		$this->jackpot=$temp;
	}
	
	function setWinnerID($temp)
	{
		$this->winnerID=$temp;
	}
	
	function setWinnerPin($temp)
	{
		$this->winnerPin=$temp;
	}
	
	function setWinnerPaid($temp)
	{
		$this->winnerPaid=$temp;
	}
	
	function setActiveflag($temp)
	{
		$this->activeflag=$temp;
	}
	
	function setStatus($temp)
	{
		$this->status=$temp;
	}


	function read()
	{
		$conn = getConnection();
		$query = "SELECT * FROM lottery WHERE ID='".$this->ID."'";
		$result = mysql_query($query);

		if(!$result)return;
		else
		{
			$member = mysql_fetch_array($result);

			$this->setLeagueID(trim($member['leagueID']));
			$this->setFromDate(trim($member['fromDate']));
			$this->setToDate(trim($member['toDate']));
			$this->setJackpot(trim($member['jackpot']));
			$this->setWinnerID(trim($member['winnerID']));
			$this->setWinnerPin(trim($member['winnerPin']));
			$this->setWinnerPaid(trim($member['winnerPaid']));
			$this->setActiveflag(trim($member['activeflag']));
			$this->setStatus(trim($member['status']));

		}

	}
}
?>
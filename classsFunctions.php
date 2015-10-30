<?php

function getBowler($ID)
{
	$conn=getConnection();
	$query = "SELECT * FROM bowler WHERE ID = '".$ID."'";
	$result = mysql_query($query);
	$numrows = mysql_affected_rows();

	if($numrows == 1)
	{
		$member = mysql_fetch_array($result);
		$tempObj = new Bowler($member['ID']);
		return $tempObj;
	}
	return NULL;
}

?>
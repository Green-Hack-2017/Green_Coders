<?php

require_once 'dbconnect.php';

if(isset($_GET['tickets'])){
	$a = $_GET['tickets'];
	$tickets = explode(',', $a);
	$data = array();
	foreach($tickets as $ticket){
		$query = $DBcon->query("SELECT * FROM complaint WHERE complaint_id = '$ticket'");
		if($query->num_rows==1){
			while($row=$query->fetch_assoc()){
				array_push($data, $row);
			}
		}
	}
	$d = array('count'=>count($tickets), 'data'=>$data);
} else {
	$d = array('count'=>0);
}

echo json_encode($d);

$DBcon->close();
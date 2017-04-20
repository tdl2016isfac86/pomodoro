<?php

function dbQuery($sqlRequest) {
    $mysql = new mysqli(db_server, db_username, db_pass, db_database);
    $result = $mysql->query($sqlRequest);
    
 	if ($result === FALSE) {
 		return FALSE;
 	}
 	elseif (preg_match("/INSERT/", $sqlRequest)) {
 		return $mysql->insert_id;
 	}
    else {
     	if($result === TRUE) {
        	return TRUE;
     	}
     	else {
     		$result_array = array();
     		while($i = $result->fetch_assoc()) {
     			array_push($result_array, $i);
        	}
 		    return $result_array;
 	    }
    }
}
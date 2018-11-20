<?php
	define("MA_DB_PREFIX", "ma_");
	define("MA_HOST", "10.250.7.98");
	define("MA_PORT", 3306);
	define("MA_USER", "memarea_user");
	define("MA_PASS", "m3mb3rs@r3aU$3r");
	define("MA_DB", "members_area");
	
	function row_count($query){
		return mysql_num_rows($query); 
	}
	function fetch_assoc($query){
		return mysql_fetch_assoc($query);
	}
	function fetch_array($query){
		return mysql_fetch_array($query);
	}
	function execute_query($query, $con){
		$sql="";
		$sql = mysql_query($query, $con);
		
		if(!$sql){
			die("Invalid query: ".mysql_error());
			break;
		}
		else{
			return $sql;
		}
	}
	function db_connect($database){
		$con = mysql_connect(MA_HOST .":". MA_PORT, MA_USER, MA_PASS);
		mysql_select_db(MA_DB, $con);
		
		return $con;
	}
	function db_close($con){
		mysql_close($con);
	}
	function db_select($query, $con){
		$sql="";
		$sql = execute_query($query, $con);
		$max = row_count($sql);
		
		if($max > 0){
			for($ctr = 0; $ctr < $max; $ctr++){
				$row = fetch_assoc($sql);
				$output[$ctr] = $row;
			}
			
			return $output;
		}
		else{
			return false;
		}
	}
?>
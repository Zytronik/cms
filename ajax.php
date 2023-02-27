<?php include("functions.php");
ignore_user_abort(true);

if(isset($_POST["action"]) && !empty($_POST["action"])) {
	include 'dbConfig.php';
	$action = $_POST["action"];

	function addBlockToPage($conn) {
		$block_index = $_POST['index'];
		$block = "SELECT * FROM block WHERE name='".$_POST['block_val']."'";
        $block = $conn->query($block);
        if ($block->num_rows > 0) {
            $blockrow = $block->fetch_assoc();
            $fields = "SELECT * FROM blockhasfield WHERE block='".$blockrow['ID']."'";
            $fields = $conn->query($fields);
            if ($fields->num_rows > 0) {
            	$index = 1;
            	while($fields_row = $fields->fetch_assoc()){
            		includeField($fields_row['fieldtype'], $fields_row['field'], $conn, $index, $block_index);
            		$index++;
            	}
        	}
        }
		exit();
	}

	function addAnalytics($conn) {
		function convertBool($string){
			if($string == "true"){
				return "true";
			}
			return "false";
		}

		$data = $_POST['data'];
		$insert_data = "INSERT into analytics (
			timeOpened,
			timeLeft,
			timezone,
			pageon,
			historyLenght,
			browserName,
			browserLanguage,
			os,
			location,
			ip,
			isMobile,
			windowWidth,
			windowHeight,
			linkClickhistory
		) VALUES (
			'".$data["timeOpened"]."',
			'".$data["timeLeft"]."',
			'".$data["timezone"]."',
			'".$data["pageon"]."',
			'".$data["historyLenght"]."',
			'".$data["browserName"]."',
			'".$data["browserLanguage"]."',
			'".$data["os"]."',
			'".json_encode($data["location"])."',
			'".$data["ip"]."',
			".convertBool($data["isMobile"]).",
			'".$data["windowWidth"]."',
			'".$data["windowHeight"]."',
			'".json_encode($data["linkClickhistory"])."'
		)";
		echo $insert_data;
		$conn->query($insert_data);
		exit();
	}

	$action($conn);
}


?>
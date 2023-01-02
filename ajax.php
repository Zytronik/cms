<?php include("functions.php");

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

	$action($conn);
}


?>
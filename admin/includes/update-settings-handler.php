<?php include '../dbConfig.php';

	foreach ($_POST as $key => $value) {
		preg_match('/^[A-Za-z_]+-data-\d-(\d)$/', $key, $matches);
		if(isset($matches[1]) && !empty($matches[1]) && $key != "update-settings-submit"){
			$update_settings = "UPDATE custom_fields set data='".$value."' WHERE ID=".$matches[1];
			if ($conn->query($update_settings) === TRUE) {
				//echo "Record updated successfully";
				$errors = "";
			} else {
				$errors[] = "Error updating record: " . $conn->error;
			}
		}else{
			if($key != "update-settings-submit"){
				$errors[] = "Ungültige ID bei:".$key;
			}
		}
	}

	/*if(empty($errors)){
		echo "no errors alles tuti fruti";
	}else{
		echo "oh boy öpis isch falsch bi dem: <br>";
		foreach ($errors as $error) {
			echo $error."<br>";
		}
	}*/
?>
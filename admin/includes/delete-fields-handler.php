<?php //dump($_POST); 
if(isset($_POST["delete-block-submit"]) && isset($_POST['delete-id']) && !empty($_POST['delete-id'])){
	include '../dbConfig.php';
	$errors = false;

	$delete_block = "DELETE FROM block WHERE ID=".$_POST['delete-id'];
	if ($conn->query($delete_block) === TRUE) {
		$delete_blockonpage = "DELETE FROM pagehasblock WHERE block=".$_POST['delete-id'];
		if ($conn->query($delete_blockonpage) === TRUE) {
			$select_block_fields = "SELECT * FROM blockhasfield WHERE block=".$_POST['delete-id'];
			$select_block_fields = $conn->query($select_block_fields);
			if($select_block_fields->num_rows > 0){
				while ($field = $select_block_fields->fetch_assoc()) {
					$delete_field = "DELETE FROM f_".$field['fieldtype']." WHERE block=".$_POST['delete-id'];
					if ($conn->query($delete_field) === TRUE) {

					}else{
						$errors[] = $delete_field;
					}
					$delete_field_data = "DELETE FROM d_".$field['fieldtype']." WHERE field=".$field['field'];
					if ($conn->query($delete_field_data) === TRUE) {

					}else{
						$errors[] = $delete_field_data;
					}
				}
			}
			$delete_block_fields = "DELETE FROM blockhasfield WHERE block=".$_POST['delete-id'];
			if ($conn->query($delete_block_fields) === TRUE) {

			}else{
				$errors[] = $delete_block_fields;
			}
		}else{
			$errors[] = $delete_blockonpage;
		}
	}else{
		$errors[] = $delete_block;
	}

	/*if(empty($errors)){
		echo "no errors alles tuti fruti";
	}else{
		echo "oh boy öpis isch falsch bi dem: <br>";
		foreach ($errors as $error) {
			echo $error."<br>";
		}
	}*/
} ?>
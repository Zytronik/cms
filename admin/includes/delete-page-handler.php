<?php //dump($_POST); 
if(isset($_POST["delete-page-submit"]) && isset($_POST['delete-id']) && !empty($_POST['delete-id']) && isset($_POST['delete-name']) && !empty($_POST['delete-name'])){
	include '../dbConfig.php';
	$errors = false;

	$delete_page = "DELETE FROM page WHERE ID=".$_POST['delete-id'];
	if ($conn->query($delete_page) === TRUE) {
		$select_pagehasblockID = "SELECT ID FROM pagehasblock WHERE page=".$_POST['delete-id'];
		$select_pagehasblockID = $conn->query($select_pagehasblockID);
		if($select_pagehasblockID->num_rows > 0){
			while ($pagehasblock = $select_pagehasblockID->fetch_assoc()) {
				$delete_pagehasblock = "DELETE FROM pagehasblock WHERE ID=".$pagehasblock['ID'];
				if ($conn->query($delete_pagehasblock) === TRUE) {
					$fieldtypes = getAllFieldTypes();
					foreach ($fieldtypes as $fieldtype) {
						$delete_field_data = "DELETE FROM d_".$fieldtype." WHERE pagehasblock=".$pagehasblock['ID'];
						if ($conn->query($delete_field_data) !== TRUE) {
							$errors[] = $delete_field_data;
						}
					}
				}else{
					$errors[] = $delete_pagehasblock;
				}
			}
		}
		$dirPath = "../".substr($_POST['delete-name'], 0, -6);
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}else{
		$errors[] = $delete_page;
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
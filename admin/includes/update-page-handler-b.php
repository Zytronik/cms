<?php include '../dbConfig.php';
/*dump($_FILES);
dump($_POST);*/

function deleteBlocks($delete_ids, $conn) {
	global $errors;
	if(isset($delete_ids) && !empty($delete_ids)){
		if(!is_array($delete_ids)){
			$delete_ids_array = explode(", ", $delete_ids);
		}else{
			$delete_ids_array[] = $delete_ids;
		}
		foreach ($delete_ids_array as $key => $id) {
			$select_blockid = "SELECT * FROM pagehasblock WHERE ID=".$id;
			$select_blockid = $conn->query($select_blockid);
			if ($select_blockid->num_rows > 0){
				$pagehasblock_row = $select_blockid->fetch_assoc();
				$id_block = $pagehasblock_row["block"];
				$position_deleted[] = $pagehasblock_row["position"];
				$delete_block = "DELETE FROM pagehasblock WHERE ID=".$id;
				if ($conn->query($delete_block) === TRUE) {
					$fields = "SELECT * FROM blockhasfield WHERE block=".$id_block;
					$fields = $conn->query($fields);
					if ($fields->num_rows > 0) {
						while($fields_row = $fields->fetch_assoc()){
							$delete_block_data = "DELETE FROM d_".$fields_row['fieldtype']." WHERE pagehasblock=".$id;
							if ($conn->query($delete_block_data) !== TRUE) {
								$errors[] = $delete_block_data;
							}
						}
					}else{
						$errors[] = $fields;
					}
				}else{
					$errors[] = $delete_block;
				}
			}else{
				$errors[] = $select_blockid;
			}
		}
	}
}

function insertBlock($index, $conn, $post){
	global $errors;
	$block_id = $post["block-id-".$index];
	$insert_pagehasblock = "INSERT into pagehasblock (page, block, position) VALUES ('".$post['page-id']."', '".$block_id."', '".$index."')";
	if ($conn->query($insert_pagehasblock) === TRUE) {
		$id_pagehasblock = $conn->insert_id;
		$fields = "SELECT * FROM blockhasfield WHERE block=".$block_id;
		$fields = $conn->query($fields);
		if ($fields->num_rows > 0) {
			while($fields_row = $fields->fetch_assoc()){
				insertFields($fields_row, $index, $id_pagehasblock, $post, $conn);
			}
		}
	}else {
		$errors[] = $insert_pagehasblock;
	}
}

function insertFields($fields_row, $index,  $id_pagehasblock, $post, $conn){
	global $errors;
	if($fields_row['fieldtype'] === "image" ){
		$file = $_FILES[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
		if(!empty($file["name"][0]) || !empty($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])){
			if(empty($file["name"][0]) && !empty($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])){
				$fileName = $post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
				$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
				if ($conn->query($insert_data) !== TRUE) {
					$errors[] = $insert_data;
				}
			}else{
				$targetDir = "uploads/";
				$fileName = basename($file["name"][0]);
				$targetFilePath = $targetDir . $fileName;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				$allowTypes = array('jpg','png','jpeg','gif');
				if(in_array(strtolower($fileType), $allowTypes)){
					if(move_uploaded_file($file["tmp_name"][0], $targetFilePath)){
						$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
						if ($conn->query($insert_data) !== TRUE) {
							$errors[] = $insert_data;
						}
					}else{
						$errors[] = "Sorry, there was an error uploading your file.";
					}
				}else{
					$errors[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
				}
			}
		}
	}else if($fields_row['fieldtype'] === "gallery" ){
		$file = $_FILES[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
		$post_gallery = json_decode($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']]);
		if(!empty($file["name"][0]) || !empty($post_gallery)){
			if(empty($file["name"][0]) && !empty($post_gallery)){
				foreach ($post_gallery as $key => $fileName) {
					$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
					if ($conn->query($insert_data) !== TRUE) {
						$errors[] = $insert_data;
					}
				}
			}else{
				foreach ($file["name"] as $key => $value) {	
					$targetDir = "uploads/";
					$fileName = basename($file["name"][$key]);
					$targetFilePath = $targetDir . $fileName;
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					$allowTypes = array('jpg','png','jpeg','gif');
					if(in_array(strtolower($fileType), $allowTypes)){
						if(move_uploaded_file($file["tmp_name"][$key], $targetFilePath)){
							$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
							if ($conn->query($insert_data) !== TRUE) {
								$errors[] = $insert_data;
							}
						}else{
							$errors[] = "Sorry, there was an error uploading your file.";
						}
					}else{
						$errors[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
					}
				}
			}
		}
	}else{
		$data = $post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
		$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($data)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
		if ($conn->query($insert_data) !== TRUE) {
			$errors[] = $insert_data;
		}
	}
}

function updateBlock($id_pagehasblock, $block_id, $index, $conn, $post) {
	global $errors;
	$fields = "SELECT * FROM blockhasfield WHERE block=".$block_id;
	$fields = $conn->query($fields);
	while($fields_row = $fields->fetch_assoc()){
		if($fields_row['fieldtype'] === "image"){
			$file = $_FILES[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
			if(!empty($file["name"][0]) || !empty($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])){
				if(empty($file["name"][0]) && !empty($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])){
					$fileName = $post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
					$update_data = "UPDATE d_".$fields_row['fieldtype']." SET data='".dbSanitize($fileName)."' WHERE pagehasblock='".$id_pagehasblock."'  AND field='".$fields_row["field"]."'";
					if ($conn->query($update_data) !== TRUE) {
						$errors[] = $update_data;
					}
				}else{
					if(isset($file["name"]) && is_string($file["name"])){
						foreach ($file as $key => $string) {
							$file[$key] = [$string];
						}
					}
					$targetDir = "uploads/";
					$fileName = basename($file["name"][0]);
					$targetFilePath = $targetDir . $fileName;
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					$allowTypes = array('jpg','png','jpeg','gif');
					if(in_array(strtolower($fileType), $allowTypes)){
						if(move_uploaded_file($file["tmp_name"][0], $targetFilePath)){
							if(empty($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])){
								$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
								if ($conn->query($insert_data) !== TRUE) {
									$errors[] = $insert_data;
								}
							}else{
								$update_data = "UPDATE d_".$fields_row['fieldtype']." SET data='".dbSanitize($fileName)."' WHERE pagehasblock='".$id_pagehasblock."'  AND field='".$fields_row["field"]."'";
								if ($conn->query($update_data) !== TRUE) {
									$errors[] = $update_data;
								}
							}
						}else{
							$errors[] = "Sorry, there was an error uploading your file.";
						}
					}else{
						$errors[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
					}
				}
			}
		}else if($fields_row['fieldtype'] === "gallery"){
			$file = $_FILES[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
			$post_gallery = $post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']];
			if(!empty($file["name"][0]) || !empty($post_gallery)){
				if(empty($file["name"][0]) && !empty($post_gallery)){
					$delete_block_data = "DELETE FROM d_".$fields_row['fieldtype']." WHERE pagehasblock=".$id_pagehasblock;
					if ($conn->query($delete_block_data) === TRUE) {
						$post_gallery = json_decode($post_gallery);
						foreach ($post_gallery as $key => $fileName) {
							$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
							if ($conn->query($insert_data) !== TRUE) {
								$errors[] = $insert_data;
							}
						}
					}else{
						$errors[] = $delete_block_data;
					}
				}else if(!empty($file["name"][0]) && (empty($post_gallery) || $post_gallery === "[]")){
					$delete_block_data = "DELETE FROM d_".$fields_row['fieldtype']." WHERE pagehasblock=".$id_pagehasblock;
					if ($conn->query($delete_block_data) === TRUE) {
						if(isset($file["name"]) && is_string($file["name"])){
							foreach ($file as $key => $string) {
								$file[$key] = [$string];
							}
						}
						foreach ($file["name"] as $key => $value) {
							$targetDir = "uploads/";
							$fileName = basename($file["name"][$key]);
							$targetFilePath = $targetDir . $fileName;
							$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
							$allowTypes = array('jpg','png','jpeg','gif');
							if(in_array(strtolower($fileType), $allowTypes)){
								if(move_uploaded_file($file["tmp_name"][$key], $targetFilePath)){
									$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
									if ($conn->query($insert_data) !== TRUE) {
										$errors[] = $insert_data;
									}
								}else{
									$errors[] = "Sorry, there was an error uploading your file.";
								}
							}else{
								$errors[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
							}
						}
					}else{
						$errors[] = $delete_block_data;
					}
				}else{
					if(isset($file["name"]) && is_string($file["name"])){
						foreach ($file as $key => $string) {
							$file[$key] = [$string];
						}
					}
					foreach ($file["name"] as $key => $value) {
						$targetDir = "uploads/";
						$fileName = basename($file["name"][$key]);
						$targetFilePath = $targetDir . $fileName;
						$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
						$allowTypes = array('jpg','png','jpeg','gif');
						if(in_array(strtolower($fileType), $allowTypes)){
							if(move_uploaded_file($file["tmp_name"][$key], $targetFilePath)){
								$insert_data = "INSERT into d_".$fields_row['fieldtype']." (data, pagehasblock, field) VALUES ('".dbSanitize($fileName)."', '".$id_pagehasblock."', '".$fields_row["field"]."')";
								if ($conn->query($insert_data) !== TRUE) {
									$errors[] = $insert_data;
								}
							}else{
								$errors[] = "Sorry, there was an error uploading your file.";
							}
						}else{
							$errors[] = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
						}
					}
				}
			}else if(empty($file["name"][0]) && !is_null($post_gallery) ){
				$delete_block_data = "DELETE FROM d_".$fields_row['fieldtype']." WHERE pagehasblock=".$id_pagehasblock;
				if($conn->query($delete_block_data) !== TRUE) {
					$errors[] = $delete_block_data;
				}
			}
		}else{
			$update_data = "UPDATE d_".$fields_row['fieldtype']." SET data='".dbSanitize($post[$fields_row['fieldtype'].'-data-'.$index.'-'.$fields_row['position']])."' WHERE pagehasblock='".$id_pagehasblock."'  AND field='".$fields_row["field"]."'";
			if ($conn->query($update_data) !== TRUE) {
				$errors[] = $update_data;
			}
		}
	}
}

if(isset($_POST["update-page-submit"])){
	$errors = false;
	global $errors;
	$index = 1;
	deleteBlocks($_POST["delete-block-ids"], $conn);
	while(isset($_POST["block-id-".$index])){
		$block_id = $_POST["block-id-".$index];
		$select_pagehasblock = "SELECT ID FROM pagehasblock WHERE page=".$_POST['page-id']." AND position=".$index;
		$select_pagehasblock = $conn->query($select_pagehasblock);
		/*Falls an position ein block ist --> update block --> else insert new block*/
		if ($select_pagehasblock->num_rows > 0) {
			/*speichert id von pagehasblock an falls index und block typ übereinstimmen*/
			$select_pagehasblock = "SELECT ID FROM pagehasblock WHERE page=".$_POST['page-id']." AND block=".$block_id." AND position=".$index;
			$select_pagehasblock = $conn->query($select_pagehasblock);
			/*Falls an position gleicher Blocktyp ist --> update block values --> else delete und insert block*/
			if ($select_pagehasblock->num_rows > 0){
				$id_pagehasblock = $select_pagehasblock->fetch_assoc()["ID"];
				updateBlock($id_pagehasblock, $block_id, $index, $conn, $_POST);
			}else{
				/*select block an diesem index*/
				$select_pagehasblock = "SELECT * FROM pagehasblock WHERE page=".$_POST['page-id']." AND position=".$index;
				$select_pagehasblock = $conn->query($select_pagehasblock);
				$pagehasblock_row = $select_pagehasblock->fetch_assoc();
				deleteBlocks($pagehasblock_row["ID"], $conn);
				insertBlock($index, $conn, $_POST);
			}
		}else{
			insertBlock($index, $conn, $_POST);
		}
		$index++;
	}

	/* Alle unnötigen Index löschen */
	$delete_block_data = "DELETE FROM pagehasblock WHERE page = ".$_POST['page-id']." AND position >= ".$index;
	if ($conn->query($delete_block_data) !== TRUE) {
		$errors[] = $delete_block_data;
	}

	//dump($errors);

	/*if(empty($errors)){
		echo "no errors alles tuti fruti";
	}else{
		echo "oh boy öpis isch falsch bi dem: <br>";
		foreach ($errors as $error) {
			echo $error."<br>";
		}
	} */
} ?>
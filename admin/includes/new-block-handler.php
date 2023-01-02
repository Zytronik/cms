<?php //dump($_POST); 
if(isset($_POST["new-block-submit"])){
	include '../dbConfig.php';

	function getBlockTypes($haystack) {
		$maches = preg_grep("/^block_type-/", array_keys($haystack));
		return array_intersect_key($haystack, array_flip($maches));
	}

	$errors = false;
	$blockTypes = getBlockTypes($_POST);
	$id_fields = "";

	if(isset($_POST["blocktitel"]) && !empty($_POST["blocktitel"]) && isset($_POST["blockname"]) && !empty($_POST["blockname"])) {
		$insert_block = "INSERT into block (title, name) VALUES ('".$_POST['blocktitel']."', '".$_POST["blockname"]."')";
		if ($conn->query($insert_block) === TRUE) {
			$id_block = $conn->insert_id;
			//echo "New record created successfully.";
		}else {
			$errors[] = $insert_block;
		}
	}

	function insert_blockhasfield($fieldId, $id_block, $conn, $type, $position) {
		$insert_blockhasfield = "INSERT into blockhasfield (block, field, fieldtype, position) VALUES ('".$id_block."', '".$fieldId."', '".$type."', '".$position."')";
		if ($conn->query($insert_blockhasfield) === TRUE) {
			$id_blockhasfield = $conn->insert_id;
			//echo "New record created successfully.";
		}else {
			$errors[] = $insert_blockhasfield;
		}
	}

	foreach ($blockTypes as $key => $type) {
		$index = preg_replace("/[^0-9]/", "", $key);
		switch ($type) {
			case 'text-simple':
				$name = $_POST["text-simple-name-".$index];
				if(is_string($name) && $name){
					$insert_text_simple = "INSERT into f_text_simple (title, block, fieldtype) VALUES ('".$name."', '".$id_block."', 'text_simple')";
					if ($conn->query($insert_text_simple) === TRUE) {
						$id_text_simple = $conn->insert_id;
						//echo "New record created successfully.";
					}else {
						$errors[] = $insert_text_simple;
					}
					insert_blockhasfield($id_text_simple, $id_block, $conn, "text_simple", $index);
				}else {
					$errors[] = "ungültige Eingabe bei Index = ".$index;
				}
			break;
			case 'text-area':
				$name = $_POST["text-area-name-".$index];
				$rows = $_POST["rows-".$index];
				if(is_string($name) && $name && $rows && is_numeric($rows)){
					$insert_text_area = "INSERT into f_text_area (title, rows_count, block, fieldtype) VALUES ('".$name."', '".$rows."', '".$id_block."', 'text_area')";
					if ($conn->query($insert_text_area) === TRUE) {
						$id_text_area = $conn->insert_id;
						//echo "New record created successfully.";
					}else {
						$errors[] = $insert_text_area;
					}
					insert_blockhasfield($id_text_area, $id_block, $conn, "text_area", $index);
				}else{
					$errors[] = "ungültige Eingabe bei Index = ".$index;
				}
			break;
			case 'image':
				$name = $_POST["image-name-".$index];
				if(is_string($name) && $name){
					$insert_image = "INSERT into f_image (title, block, fieldtype) VALUES ('".$name."', '".$id_block."', 'image')";
					if ($conn->query($insert_image) === TRUE) {
						$id_image = $conn->insert_id;
						//echo "New record created successfully.";
					}else {
						$errors[] = $insert_image;
					}
					insert_blockhasfield($id_image, $id_block, $conn, "image", $index);
				}else{
					$errors[] = "ungültige Eingabe bei Index = ".$index;
				}
			break;
			case 'gallery':
				$name = $_POST["gallery-name-".$index];
				if(is_string($name) && $name){
					$insert_gallery = "INSERT into f_gallery (title, block, fieldtype) VALUES ('".$name."', '".$id_block."', 'gallery')";
					if ($conn->query($insert_gallery) === TRUE) {
						$id_gallery = $conn->insert_id;
						//echo "New record created successfully.";
					}else {
						$errors[] = $insert_gallery;
					}
					insert_blockhasfield($id_gallery, $id_block, $conn, "gallery", $index);
				}else{
					$errors[] = "ungültige Eingabe bei Index = ".$index;
				}
			break;
			default:
				$errors[] = "undefined block Type";
			break;
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
} ?>
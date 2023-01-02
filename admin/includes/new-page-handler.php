<?php //dump($_POST); 
include '../dbConfig.php';
if(isset($_POST["new-page-submit"])){

	$errors = false; 

	if(isset($_POST["pagename"]) && !empty($_POST["pagename"]) && isset($_POST["pagetitle"]) && !empty($_POST["pagetitle"])) {
		$insert_titel = "INSERT into page (title) VALUES ('".$_POST["pagetitle"]."')";
		if ($conn->query($insert_titel) === TRUE) {
			$id_page = $conn->insert_id;
			//echo "New record created successfully.";
			$update_page_name = "UPDATE page set name ='".$_POST["pagename"]."/index' WHERE ID='".$id_page."'";
			if ($conn->query($update_page_name) === TRUE) {
  				//echo "New record created successfully.";
				$dir = "../".$_POST["pagename"];
				$file_to_write = 'index.php';
				$content_to_write = "<?php include '../header.php'; ?><main class='content-wrapper'><article><?php get_blocks($"."pagename); ?></article></main><?php include '../footer.php'; ?>";
				if( is_dir($dir) === false ){
					mkdir($dir);
					$file = fopen($dir . '/' . $file_to_write,"w");
					fwrite($file, $content_to_write);
					fclose($file);
				}
			}else { 
				$errors[] = $update_page_name;
			}
		}else {
			$errors[] = $insert_titel;
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
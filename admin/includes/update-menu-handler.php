<?php include '../dbConfig.php';

	//dump($_POST);

	if(isset($_POST["update-header-menu"]) || isset($_POST["update-footer-menu"])) {
		$index = 1;
		if(isset($_POST["update-header-menu"])){
			$menu = "header";
		}else if(isset($_POST["update-footer-menu"])){
			$menu = "footer";
		}else{
			$errors[] = "Kein Menu ausgewählt.";
		}
		$delete_menu = "DELETE FROM menu_".$menu;
		if ($conn->query($delete_menu) === TRUE) {
			while ( isset($_POST["menu-".$menu."-name-".$index]) ) {
				$menu_name = $_POST['menu-'.$menu.'-name-'.$index];
				$menu_url = $_POST['menu-'.$menu.'-link-'.$index];
				$menu_icon = $_POST['menu-'.$menu.'-icon-'.$index];
				if(isset($_POST['menu-'.$menu.'-page-'.$index])){
					$menu_page = json_encode($_POST['menu-'.$menu.'-page-'.$index]);
					$insert_data = "INSERT into menu_".$menu." (name, url, icon, pages) VALUES ('".$menu_name."', '".$menu_url."', '".$menu_icon."', '".$menu_page."')";
					if ($conn->query($insert_data) !== TRUE) {
						$errors[] = $insert_data;
					}else{
						$errors = "";
					}
				}
				$index++;
			}
		}else{
			$errors[] = $delete_menu;
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
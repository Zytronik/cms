<?php 
/* ------------ Ändern bevor live gang ------------- */
function get_pagename() {
    return str_replace("//localhost/cms/", "" , str_replace("//www.", "//", "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."index"));
}

function get_directory_url(){
    return "//".$_SERVER['HTTP_HOST']."/cms/";
}
/* ------------ Ändern bevor live gang ------------- */

function get_blocks($pagename) {
	include 'dbConfig.php';
	$page_name = "SELECT ID FROM page WHERE name='".$pagename."'";
	$page_name = $conn->query($page_name);
	if ($page_name->num_rows === 1) {
		$page_id = $page_name->fetch_assoc()["ID"];
		$blocks = "SELECT * FROM pagehasblock WHERE page=".$page_id." ORDER BY position ASC";
		$blocks = $conn->query($blocks);
		if ($blocks->num_rows > 0) {
			while($pagehasblock = $blocks->fetch_assoc()){
				$select_block = "SELECT * FROM block WHERE ID=".$pagehasblock["block"];
				$select_block = $conn->query($select_block);
				if ($select_block->num_rows === 1) {
					$block = $select_block->fetch_assoc();
					$block_name = $block["name"];
					$block_id = $block["ID"];
					$pagehasblock_id = $pagehasblock["ID"];
					include 'blocks/'.$block_name.'/'.$block_name.'.php';
				}
			}
            return true;
		} 
	}
    echo "<section><div class='container'><p style='margin-top:50px;'>Es gibt momentan keine Blöcke auf der Seite.</p></div></section>";
}

function getPageId($pagename) {
    include 'dbConfig.php';
    $page_name = "SELECT ID FROM page WHERE name='".$pagename."'";
    $page_name = $conn->query($page_name);
    if ($page_name->num_rows === 1) {
        $page_id = $page_name->fetch_assoc()["ID"];
        return $page_id;
    }
}

function includeField($fieldtype, $field_id, $conn, $index, $block_index, $pagehasblock_id = false){
    $field = "SELECT * FROM f_".$fieldtype." WHERE ID=".$field_id;
    $field = $conn->query($field);
    if ($field->num_rows > 0) {
        while($field_row = $field->fetch_assoc()){
            if($pagehasblock_id){
                $field_data = "SELECT * FROM d_".$fieldtype." WHERE field=".$field_id." AND pagehasblock=".$pagehasblock_id;
                $field_data = $conn->query($field_data);
                if ($field_data->num_rows > 0) {
                    while($field_data_row = $field_data->fetch_assoc()){
                        $value[] = $field_data_row["data"];
                    }
                    if(count($value) <= 1) {
                        $value = implode("", $value);
                    }else{
                        $value = json_encode($value);
                    }
                }
            }else{
                $value = "";
            }
            switch ($field_row['fieldtype']) {
                case 'text_simple':
                    $title = $field_row['title'];
                    break;
                case 'text_area':
                    $title = $field_row['title'];
                    $rows = $field_row['rows_count'];
                    break;
                case 'image':
                    $title = $field_row['title'];
                    break;
                case 'gallery':
                    $title = $field_row['title'];
                    break;
                default:
                    break;
            }
            include("admin/includes/fields/".$field_row['fieldtype'].".php");
        }
    } 
}

function dump( ...$variables ) {
    foreach ( $variables as $variable ) {
        echo gettype( $variable ) . '<br>';
        echo '<pre>';
        print_r( $variable );
        echo '</pre>';
    }
}

function get_fields($block_id, $pagehasblock_id){
    include 'dbConfig.php';
    $data = array();
    $select_block_fields = "SELECT * FROM blockhasfield WHERE block=".$block_id;
    $select_block_fields = $conn->query($select_block_fields);
    if ($select_block_fields->num_rows > 0) {
        while($field = $select_block_fields->fetch_assoc()){
            $select_field = "SELECT * FROM f_".$field['fieldtype']." WHERE block=".$block_id;
            $select_field = $conn->query($select_field);
            if ($select_field->num_rows > 0) {
                while($field = $select_field->fetch_assoc()){
                    $field_title = $field["title"];
                    $field_id = $field["ID"];
                    $select_field_data = "SELECT * FROM d_".$field['fieldtype']." WHERE pagehasblock=".$pagehasblock_id." AND field=".$field_id;
                    $select_field_data = $conn->query($select_field_data);
                    if ($select_field_data->num_rows > 0) {
                        if($field['fieldtype'] === "gallery"){
                            while($gallery = $select_field_data->fetch_assoc()){
                                $data[$field_title][] = $gallery["data"];
                            }
                        }else{
                            $data[$field_title] = $select_field_data->fetch_assoc()["data"];
                        }
                    }
                }
            }
            
        }
        return $data;
    }
    return false;
}

function get_field($title){
    include 'dbConfig.php';
    if($title){
        $select_field = "SELECT * FROM custom_fields WHERE title='".$title."'";
        $select_field = $conn->query($select_field);
        if ($select_field->num_rows > 0) {
            $data = $select_field->fetch_assoc()["data"];
            return $data;
        }
    }
    return false;
}

function admin(){
    if(session_status() != 2){
    	session_start();
    	if((isset($_COOKIE["key"]) && $_COOKIE["key"] == "bN8cOfHd75Ks8mYBnAWW5uK49hBjjQnf") || isset($_SESSION['login'])){
    		return true;
    	} else {
    		return false;
    	}
    }
}
 
function getHeaderMenu($page_id) {
    include 'dbConfig.php';
    $select_header_menu = "SELECT * FROM menu_header";
    $select_header_menu = $conn->query($select_header_menu);
    if ($select_header_menu->num_rows > 0) {
        $return = array();
        while($field = $select_header_menu->fetch_assoc()){
            if(in_array($page_id, json_decode($field["pages"])) ){
                $return[] = $field;
            }   
        }
        return $return;
    }
}

function getFooterMenu($page_id) {
    include 'dbConfig.php';
    $select_footer_menu = "SELECT * FROM menu_footer";
    $select_footer_menu = $conn->query($select_footer_menu);
    if ($select_footer_menu->num_rows > 0) {
        $return = array();
        while($field = $select_footer_menu->fetch_assoc()){
            if(in_array($page_id, json_decode($field["pages"])) ){
                $return[] = $field;
            }   
        }
        return $return;
    }
}

function format_text($text) {
	//$text = str_replace("||", "</br>", $text);

	preg_match_all('/(?:#{3}(.+)#{3})/', $text, $matches, PREG_UNMATCHED_AS_NULL);
	$i = 0;
	foreach($matches[0] as $match) {
		$text = str_replace($match, "<h3>" . $matches[1][$i] . "</h3>", $text);
		$i++;
	}
	
	preg_match_all('/(?:#{2}(.+)#{2})/', $text, $matches, PREG_UNMATCHED_AS_NULL);
	$i = 0;
	foreach($matches[0] as $match) {
		$text = str_replace($match, "<h2>" . $matches[1][$i] . "</h2>", $text);
		$i++;
	}
	
	preg_match_all('/(?:\|\-([^\|]+)\-\|)/s', $text, $matches, PREG_UNMATCHED_AS_NULL);
	$i = 0;
	foreach($matches[0] as $match) {
		$r = "<ul class='cb'>";
		$li = explode("--", explode("--", $matches[1][$i], 2)[1]);
		foreach($li as $lim) {
			$r .= "<li>".$lim."</li>";
		}
		$r .= "</ul>";
		$text = str_replace($match, $r, $text);
		$i++;
	}
	
	$text = nl2br($text);
	
	$text = str_replace("</h2><br />", "</h2>", $text);
	$text = str_replace("</h3><br />", "</h3>", $text);
	$text = str_replace("</ul><br />", "</ul>", $text);
	
	//return htmlspecialchars($text);
	return $text;
}

function strip_accents($str) {
    $str = htmlentities($str, ENT_COMPAT, 'UTF-8');

    $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
    $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str);
    $str = preg_replace('#\&[^;]+\;#', '', $str);

    return $str;
}

function idfy($id) {
    return strip_accents( preg_replace('/\PL/u', '', (strtolower(str_replace(" ", "", $id)))));
}

function sanitize($input) {
	return htmlspecialchars($input);
}

function dbSanitize($string) {
    return addslashes($string);
}

function getAllFieldTypes(){
    return [
        "gallery",
        "image",
        "text_area",
        "text_simple",
    ];
}
?>
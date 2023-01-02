<?php if(!isset($value)){
	$value = "";
}
echo '
<div class="field" data-type="text_simple" data-field-index="'.$index.'">
	<label for="text_simple-data-'.$block_index.'-'.$index.'">'.$title.'</label>
	<input type="text" id="text_simple-data-'.$block_index.'-'.$index.'" name="text_simple-data-'.$block_index.'-'.$index.'" value="'.$value.'" >
</div>
'; ?>

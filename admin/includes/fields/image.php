<div class="field" data-type="image" data-field-index="<?php echo $index; ?>">
	<label for="image-data-<?php echo $block_index.'-'.$index; ?>"><?php echo $title; ?></label>
	<input accept="image/*" type="file" id="image-data-<?php echo $block_index.'-'.$index; ?>" name="image-data-<?php echo $block_index.'-'.$index; ?>[]">
	<input type="hidden" name="image-data-<?php echo $block_index.'-'.$index; ?>" value="<?php if(isset($value) && $value){ echo $value; } ?>">
	<?php if(isset($value) && $value != 'NULL' && $value){ ?>
	<div class="field-image-wrapper" style="margin-top: 15px;">
		<img style="max-height: 250px; max-width: 100%; object-fit: contain;" src="uploads/<?php echo $value; ?>">
	</div>
	<?php } ?>
</div>
<div class="field" data-type="gallery" data-field-index="<?php echo $index; ?>">
	<label for="gallery-data-<?php echo $block_index.'-'.$index; ?>"><?php echo $title; ?></label>
	<input accept="image/*" type="file" multiple id="gallery-data-<?php echo $block_index.'-'.$index; ?>" name="gallery-data-<?php echo $block_index.'-'.$index; ?>[]">
	<input type="hidden" name="gallery-data-<?php echo $block_index.'-'.$index; ?>" 
	value=<?php if(isset($value) && $value){ 
		$gallery = json_decode($value);
		if(!is_array($gallery)){
			echo '"['."'".$value."'".']"'; 
		}else{
			echo '"'.str_replace('"', "'", $value).'"';
			//echo $value;
		}
	} ?>>
	<?php if(isset($value) && $value){ ?>
		<div class="field-gallery-wrapper" style="margin-top: 15px;">
			<?php $gallery = json_decode($value);
			if(!is_array($gallery)){
				$gallery = [];
				$gallery[] = $value;
			}
			$counter = 0;
			foreach ($gallery as $url) { ?>
				<div class="gallery-img-wrapper" data-gallery-index="<?php echo $counter; ?>">
					<i class="fas fa-times"></i>
					<i class="fas fa-arrow-left"></i>
			 		<img src="uploads/<?php echo $url; ?>">
			 		<i class="fas fa-arrow-right"></i>
			 	</div>
				<?php $counter++;
			} ?>
		</div>
	<?php } ?>
</div>
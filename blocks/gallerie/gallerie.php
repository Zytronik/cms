<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id); 
// Nix ändere über dere Ziele ?>

<section id="<?php if($fields["Titel"]) { echo idfy($fields["Titel"]); } ?>" class="block <?php echo $block_name; ?>" >	
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php if($fields["Titel"]){ ?>
					<h1 class="blocktitle">
						<?php echo $fields["Titel"]; ?>
					</h1>	
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php if(isset($fields["Gallerie"]) && !empty($fields["Gallerie"])){ ?>
					<div class="grid">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
						<?php foreach ($fields["Gallerie"] as $key => $gallery_img) { ?>
							<div class="grid-item">	
								<img src="<?php echo get_directory_url().'admin/uploads/'.$gallery_img; ?>">	
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('.grid').masonry({
				itemSelector: '.grid-item',
				columnWidth: '.grid-sizer',
				gutter: '.gutter-sizer',
				percentPosition: true
			})
		});
	</script>
</section>
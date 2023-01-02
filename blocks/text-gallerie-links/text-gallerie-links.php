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
			<div class="col-12 col-xl-6">
				<?php if(isset($fields["Gallerie"]) && !empty($fields["Gallerie"])){ ?>
					<div class="slick-slider">
						<?php foreach ($fields["Gallerie"] as $key => $gallery_img) { ?>
							<div>	
								<img src="<?php echo get_directory_url().'admin/uploads/'.$gallery_img; ?>">	
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 col-xl-6">
				<?php if($fields["Text Rechts"]){ ?>		
					<div class="blocktext">
						<?php echo format_text($fields["Text Rechts"]); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row margin-top">
			<div class="col-12">
				<?php if($fields["Text Unten"]){ ?>		
					<div class="blocktext">
						<?php echo format_text($fields["Text Unten"]); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			$('#<?php if($fields["Titel"]) { echo idfy($fields["Titel"]); } ?> .slick-slider').slick({
				dots: true,
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
			});
		});
	</script>
</section>
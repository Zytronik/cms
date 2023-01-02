<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id); 
// Nix ändere über dere Ziele ?>

<section id="<?php if($fields["Titel"]) { echo idfy($fields["Titel"]); } ?>" class="block <?php echo $block_name; ?>" >
	<div class="container-large">
		<div class="row">
			<div class="col-12">
				<div class="title-wrapper">
					<?php if($fields["Titel"]){ ?>
						<h1><?php echo $fields["Titel"]; ?></h1>
					<?php } ?>
					<?php if($fields["Lead"]){ ?>
						<div class="blocktext"><?php echo format_text($fields["Lead"]); ?></div>
					<?php } ?>
					<a class="button" href="#services">Our Services</a>
				</div>
			</div>
		</div>
	</div>
	<?php if(isset($fields["Hintergrundbilder"]) && !empty($fields["Hintergrundbilder"])){ ?>
		<div class="slick-slider bg">
			<?php foreach ($fields["Hintergrundbilder"] as $key => $gallery_img) { ?>
				<div>	
					<img src="<?php echo get_directory_url().'admin/uploads/'.$gallery_img; ?>">	
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<script>
		jQuery(document).ready(function(){
			$('#<?php if($fields["Titel"]) { echo idfy($fields["Titel"]); } ?> .slick-slider').slick({
				dots: false,
				infinite: true,
				speed: 1000,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				autoplay: true,
				autoplaySpeed: 10000,
			});
		});
	</script>
</section>
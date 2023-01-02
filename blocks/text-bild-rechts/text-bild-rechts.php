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
			<div class="col-12 col-lg-6">
				<?php if($fields["Text"]){ ?>		
					<div class="blocktext">
						<?php echo format_text($fields["Text"]); ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 col-lg-6 img-wrapper">
				<?php if($fields["Bild"]){ ?>		
					<img src="<?php if($fields['Bild']){ echo get_directory_url().'admin/uploads/'.$fields['Bild']; } ?>">	
				<?php } ?>
			</div>
		</div>
	</div>
</section>
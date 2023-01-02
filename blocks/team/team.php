<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id); 
// Nix ändere über dere Ziele ?>

<section class="block <?php echo $block_name; ?>" >
	<?php $names = explode('[P]', $fields["Name"]);
	$ausbildungen = explode('[P]', $fields["Ausbildung"]);
	$sprachen = explode('[P]', $fields["Sprachen"]);
	$texte = explode('[P]', $fields["Text"]);
	$imgs = $fields["Bilder"];
	foreach ($names as $i => $name) { ?>
		<div class="teammember">
			<div class="container-large">
				<div class="text-wrapper">
					<?php if($name){ ?>
						<h2><?php echo $name; ?></h2>
					<?php } ?>
					<?php if($ausbildungen[$i]){ ?>
						<p class="sp"><?php echo $ausbildungen[$i]; ?></p>
					<?php } ?>
					<?php if($sprachen[$i]){ ?>
						<p class="sp">Sprachen: <?php echo $sprachen[$i]; ?></p>
					<?php } ?>
					<?php if($texte[$i]){ ?>
						<p><?php echo $texte[$i]; ?></p>
					<?php } ?>
				</div>
				<div class="img-wrapper">
					<?php if($fields["Bilder"][$i] && $fields["Bilder"][$i] != "NULL"){ ?>
						<img src="<?php echo get_directory_url()."admin/uploads/".$fields["Bilder"][$i]; ?>">
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }	?>
</section> 
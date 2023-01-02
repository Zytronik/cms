<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id);
// Nix ändere über dere Ziele ?>
<section id="<?php if($fields["Titel"]) { echo idfy($fields["Titel"]); } ?>" class="block <?php echo $block_name; ?>" >	
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<?php if($fields["Titel"]){ ?>
					<h1 class="blocktitle">
						<?php echo $fields["Titel"]; ?>
					</h1>	
				<?php } ?>
				<div class="blocktext">
					<!-- <?php echo get_field("Seitentitel"); ?><br> -->
					<!-- <?php echo get_field("Adresse"); ?><br><br> -->
					<!-- <a href='tel:<?php echo get_field("Telefon"); ?>'><?php echo get_field("Telefon"); ?></a><br> -->
					<!-- <a href='mailto:<?php echo get_field("E-Mail"); ?>'><?php echo get_field("E-Mail"); ?></a><br><br> -->
					<!-- <?php echo get_field("Öffnungszeiten"); ?><br> -->
					<!-- <br> --><?php echo format_text($fields["Text"]); ?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<form id="" method="POST" action="contact.php">
					<div class="form-row">
						<label for="name">
							<input required id="cname" type="text" placeholder="Name" name="cname">
						</label>
					</div>
					<div class="form-row">
						<label for="email">
							<input required id="email" type="email" placeholder="E-Mail" name="email">
						</label>
					</div>
					<div class="form-row">
						<label for="message">
							<textarea rows="6" required maxlength="2048" id="message" placeholder="Ihre Nachricht" name="message"></textarea>
						</label>
					</div>
					<div class="form-row">
						<input type="submit" name="form-submit" value="Senden">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
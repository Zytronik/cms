<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id); 
// Nix ändere über dere Ziele ?>

<section <?php if(isset($fields["Bild"]) && $fields["Bild"]){ ?>style="background-image: url('<?php echo get_directory_url().'admin/uploads/'.$fields['Bild']; ?>');"<?php } ?> id="<?php if(isset($fields["Titel"]) && $fields["Titel"]) { echo idfy($fields["Titel"]); } ?>" class="block <?php echo $block_name; ?>" >	
</section>
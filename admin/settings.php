<?php include 'includes/header.php'; 
include 'includes/update-settings-handler.php'; ?>
<main class="content-wrapper">
    <article>
        <section>
        	<div class="container-large">
        		<div class="row">
        			<div class="col-12">
        				<h1>Einstellungen</h1>
                    </div>
                </div>
            </div>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <?php if(isset($errors)){ ?>
                            <?php if(empty($errors)){ ?>
                                <div class="msg success">
                                    <div class="icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p>Die Einstellungen wurden erfolgreich aktualisiert.</p>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="msg fail">
                                    <div class="icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div>
                                        <p>
                                            <?php echo "Beim aktualisieren ist ein Fehler aufgetreten.";
                                            /*foreach ($errors as $error) {
                                                echo $error."<br>";
                                            }*/ ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>              
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
        				<?php $custom_fields = "SELECT * FROM custom_fields";
                		$custom_fields = $conn->query($custom_fields);
                		if ($custom_fields->num_rows > 0) { ?>
	        				<form action="#" method="POST">
	        					<?php while($custom_field = $custom_fields->fetch_assoc()) {
                                    $block_index = $custom_field['ID'];
                                    $index = $custom_field['ID'];
                                    $value = $custom_field['data'];
                                    switch ($custom_field['fieldtype']) {
                                        case 'text_simple':
                                            $title = $custom_field['title'];
                                            break;
                                        case 'text_area':
                                            $title = $custom_field['title'];
                                            $rows = "4";
                                            break;
                                        case 'image':
                                            $title = $custom_field['title'];
                                            break;
                                        default:
                                            break;
                                    }
	        						include("includes/fields/".$custom_field['fieldtype'].".php");
	        					} ?>
                                <button class="update" name="update-settings-submit" type="submit">Felder aktualisieren</button>
	        				</form>
	        			<?php } ?>
        			</div>
        		</div>
        	</div>
        </section>
    </article>
</main>
<?php include 'includes/footer.php'; ?>
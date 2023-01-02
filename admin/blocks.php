<?php include 'includes/header.php'; 
include 'includes/new-block-handler.php';
include 'includes/delete-fields-handler.php'; ?>
<main class="content-wrapper">
    <article class="new-block-page">
        <section>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h1>Blöcke</h1>
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
                                        <p>Der Block wurde erfolgreich erstellt/ gelöscht.</p>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="msg fail">
                                    <div class="icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div>
                                        <p>
                                            <?php echo "Beim erstellen/ löschen des Blocks ist ein Fehler aufgetreten.";
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
                        <h2>Block Erstellen</h2>
                        <form class="fields-form" action="#" method="POST">
                            <div class="input-wrapper">
                                <label for="blocktitel">Blocktitel:</label>
                                <input required type="text" id="blocktitel" name="blocktitel">
                            </div>
                            <div class="input-wrapper">
                                <label for="blockname">Blockname:</label>
                                <input required type="text" id="blockname" name="blockname">
                            </div>
                            <h3>Felder</h3>
                            <div class="fields">
                                <div class="field" data-field-index="1">
                                    <div class="input-wrapper">
                                        <label for="block_type-1">Feldtyp wählen:</label>
                                        <select class="block_type" name="block_type-1" id="block_type-1">
                                            <option value="text-simple">Text</option>
                                            <option value="text-area">Paragraph</option>
                                            <!-- <option value="checkbox">Checkbox</option>
                                            <option value="radio-button">Radio Button</option> -->
                                            <option value="image">Bild</option>
                                            <option value="gallery">Gallerie</option>
                                            <!--<option value="link">Link</option>
                                            <option value="repeater">Wiederholung</option> -->
                                        </select>
                                    </div>
                                    <div class="d-none field-infos" data-type="text-simple">
                                        <label for="text-simple-name-1">Feldname:</label>
                                        <input required type="text" id="text-simple-name-1" name="text-simple-name-1">
                                    </div>
                                    <div class="d-none field-infos" data-type="text-area">
                                        <label for="text-area-name-1">Feldname:</label>
                                        <input required type="text" id="text-area-name-1" name="text-area-name-1">
                                        <label for="rows-1">Anzahl Reihen:</label>
                                        <input required type="number" id="rows-1" name="rows-1">
                                    </div>
                                    <div class="d-none field-infos" data-type="image">
                                        <label for="image-name-1">Feldname:</label>
                                        <input required type="text" id="image-name-1" name="image-name-1">
                                    </div>
                                    <div class="d-none field-infos" data-type="gallery">
                                        <label for="gallery-name-1">Feldname:</label>
                                        <input required type="text" id="gallery-name-1" name="gallery-name-1">
                                    </div>
                                    <div class="field-actions">
                                        <button class="delete-field">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button class="field-up">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </button>
                                        <button class="field-down">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="button-wrapper">		
    							<button class="add-field">Neues Feld</button>							
                                <div class="new-block-button">
    								<button name="new-block-submit" type="submit">Block erstellen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h2>Block Übersicht</h2>
                        <?php include '../dbConfig.php';
                        $select_blocks = "SELECT * FROM block";
                        $select_blocks = $conn->query($select_blocks);
                        if($select_blocks->num_rows > 0){ ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Titel</th>
                                        <th>Name</th>
                                        <th>Anzahl Felder</th>
                                        <!-- <th>Bearbeiten</th> -->
                                        <th>Löschen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($block = $select_blocks->fetch_assoc()){ ?>
                                        <tr>
                                            <td data-label="ID" ><?php echo $block["ID"]; ?></td>
                                            <td data-label="Titel" ><?php echo $block["title"]; ?></td>
                                            <td data-label="Name" ><?php echo $block["name"]; ?></td>
                                            <td data-label="Anzahl Felder" ><?php
                                            $select_block_fields = "SELECT * FROM blockhasfield WHERE block=".$block["ID"];
                                            $select_block_fields = $conn->query($select_block_fields);
                                            if($select_block_fields->num_rows > 0){
                                                echo $select_block_fields->num_rows;
                                            } ?></td>
                                            <!-- <td data-label="Edit" >
                                                <i class="fas fa-edit"></i>
                                            </td> -->
                                            <td data-label="Delete" >
                                            <button data-toggle="modal" data-target="#delete-block-modal-<?php echo $block['ID']; ?>" type="button"><i class="fas fa-times"></i></button>
                                            </td>
                                            <div class="modal fade" id="delete-block-modal-<?php echo $block['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete-block-modal-<?php echo $block['ID']; ?>Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form class="blocks-form" action="#" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Block "<?php echo $block['title']; ?>" wirklich löschen?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Block wird aus allen Seiten entfernt und vollständig gelöscht.
                                                            </div>
                                                            <input type="hidden" name="delete-id" value="<?php echo $block['ID']; ?>">
                                                            <div class="modal-footer">
                                                                <button name="delete-block-submit" type="submit">Block Löschen</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                     </div>
                </div>
            </div>
        </section>
    </article>
</main>
<?php include 'includes/footer.php'; ?>
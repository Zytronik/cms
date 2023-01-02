<?php include 'includes/header.php';
include 'includes/new-page-handler.php';
include 'includes/update-page-handler.php';
include 'includes/delete-page-handler.php'; ?>

<main class="content-wrapper">
    <article class="pages">
        <section>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h1>Seiten</h1>
                    </div>
                </div>
            </div>
            <?php $pages = "SELECT ID, name, title FROM page";
            $pages = $conn->query($pages);
            $page_names = array();
            $page_ids = array();
            if ($pages->num_rows > 0) {
                while($page = $pages->fetch_assoc()) {
                    $page_names[] = $page["name"];
                    $page_ids[] = $page["ID"];
                }
            }
            if(isset($_GET["page"]) && !empty($_GET["page"]) && in_array($_GET["page"], $page_names) && in_array($_GET["id"], $page_ids)){ ?>
                <div class="container-large">
                    <div class="row">
                        <div class="col-12">
                            <h2>Seite Bearbeiten</h2>                            
                            <?php if(isset($errors)){ ?>
                                <?php if(empty($errors)){ ?>
                                    <div class="msg success">
                                        <div class="icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div>
                                            <p>Die Seite wurde erfolgreich aktualisiert.</p>
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
                            <form class="page-form" data-page_id="<?php echo $_GET["id"]; ?>" action="#" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="page-id" value="<?php echo $_GET["id"]; ?>">
                                <div class="blocks">
                                    <?php $blocks = "SELECT * FROM block"; 
                                    $blocks = $conn->query($blocks);
                                    $blocks_onpage = "SELECT * FROM pagehasblock WHERE page=".$_GET["id"]." ORDER BY position ASC";
                                    $blocks_onpage = $conn->query($blocks_onpage);
                                    if ($blocks_onpage->num_rows > 0) { ?>
                                        <?php while($block_onpage = $blocks_onpage->fetch_assoc()) { ?>
                                            <div class="block" data-pagehasblockID="<?php echo $block_onpage['ID']; ?>" data-block-id="<?php echo $block_onpage['block']; ?>" data-block-index="<?php echo $block_onpage['position']; ?>">
                                                <?php if ($blocks->num_rows > 0) {
                                                    $block_titles = "SELECT title FROM block WHERE ID=".$block_onpage['block'];
                                                    $block_titles = $conn->query($block_titles);
                                                    if ($block_titles->num_rows > 0) { 
                                                        while($block_title = $block_titles->fetch_assoc()) { ?>
                                                            <h3><?php echo $block_title['title']; ?></h3>
                                                        <?php } 
                                                    } ?>
                                                    <input type="hidden" name="block-id-<?php echo $block_onpage['position']; ?>" value="<?php echo $block_onpage['block']; ?>">
                                                    <input type="hidden" name="block-index-<?php echo $block_onpage['position']; ?>" value="<?php echo $block_onpage['position']; ?>">
                                                    <?php $fields = "SELECT * FROM blockhasfield WHERE block=".$block_onpage['block']." ORDER BY position ASC";
                                                    $fields = $conn->query($fields);
                                                    if ($fields->num_rows > 0) { ?>
                                                        <div class="fields">
                                                            <?php while($field = $fields->fetch_assoc()) { 
                                                                includeField($field["fieldtype"], $field["field"], $conn, $field["position"], $block_onpage['position'], $block_onpage['ID']);
                                                            } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <div>
                                                    <button class="delete-block">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button class="block-up">
                                                        <i class="fas fa-arrow-circle-up"></i>
                                                    </button>
                                                    <button class="block-down">
                                                        <i class="fas fa-arrow-circle-down"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>             
                                </div>
                                <?php if ($blocks->num_rows > 0) { ?>
                                    <div class="choose-block-wrapper">
                                        <label for="choose-block">Neuen Block hinzufügen:</label>
                                        <select class="choose-block" name="choose-block" id="choose-block">
                                            <option value="choose" selected disabled>Block wählen</option>
                                            <?php while($block = $blocks->fetch_assoc()) { ?>
                                                <option data-b-id="<?php echo $block['ID']; ?>" value="<?php echo $block['name']; ?>"><?php echo $block["title"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <input id="delete-block-ids" type="hidden" name="delete-block-ids" value="">
                                <button class="update" name="update-page-submit" type="submit">Seite aktualisieren</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="container-large">
                    <div class="row">
                        <div class="col-12">
                            <h2>Neue Seite anlegen</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php if(isset($errors)){ ?>
                                <?php if(empty($errors)){ ?>
                                    <div class="msg success">
                                        <div class="icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div>
                                            <p>Die Seite wurde erfolgreich erstellt.</p>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="msg fail">
                                        <div class="icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <div>
                                            <p>
                                                <?php echo "Beim erstellen der Seite ist ein Fehler aufgetreten.";
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
                            <form class="new-page-form" action="#" method="POST">
                                <div class="input-wrapper">
                                    <label for="pagetitle">Seitentitel:</label>
                                    <input required type="text" id="pagetitle" name="pagetitle">
								</div>
                                <div class="input-wrapper">
								    <label for="pagename">Seitenname:</label>
                                    <input required type="text" id="pagename" name="pagename">
                                </div>
                                <button name="new-page-submit" type="submit">Seite anlegen</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-large page-list">
                    <div class="row">
                        <div class="col-12">
                            <h2>Seiten Übersicht</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 title-id col-sm-2">
                            ID
                        </div>
                        <div class="col-4">
                            Titel
                        </div>
                        <div class="col-4">
                            Name
                        </div>
                        <div class="col-3 col-sm-2">
                            Löschen
                        </div>
                    </div>
                    <?php $pages = "SELECT ID, name, title FROM page";
                    $pages = $conn->query($pages);
                    if ($pages->num_rows > 0) {
                        while($page = $pages->fetch_assoc()) { ?>
                            <div class="row">
                                <?php if(isset($page["name"]) && $page["ID"]) { ?>
                                    <div class="col-1 col-sm-2">
                                        <a href="<?php echo get_directory_url(); ?>admin/?page=<?php echo $page['name']."&id=".$page["ID"]; ?>">
                                            <?php if(isset($page["ID"])) { ?>
                                                <p><?php echo $page["ID"]; ?></p>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="<?php echo get_directory_url(); ?>admin/?page=<?php echo $page['name']."&id=".$page["ID"]; ?>">
                                            <?php if(isset($page["title"])) { ?>
                                                <p><?php echo $page["title"]; ?></p>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="<?php echo get_directory_url(); ?>admin/?page=<?php echo $page['name']."&id=".$page["ID"]; ?>">
                                        <?php if(isset($page["name"])) { ?>
                                            <p><?php echo $page["name"]; ?></p>
                                        <?php } ?>
                                        </a>
                                    </div>
                                    <div class="col-3 col-sm-2">
                                        <?php if($page["ID"] != 1){ ?>
                                            <button style="margin-top: unset !important;" data-toggle="modal" data-target="#delete-page-modal-<?php echo $page['ID']; ?>" type="button"><i class="fas fa-times"></i></button>
                                        <?php } ?>
                                    </div>
                                    <?php if($page["ID"] != 1){ ?>
                                        <div class="modal fade" id="delete-page-modal-<?php echo $page['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete-page-modal-<?php echo $page['ID']; ?>Title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form class="pages-form" action="#" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Seite "<?php echo $page['title']; ?>" wirklich löschen?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Die Seite und dessen Inhalte werden gelöscht. (Blöcke bleiben bestehen)
                                                        </div>
                                                        <input type="hidden" name="delete-id" value="<?php echo $page['ID']; ?>">
                                                        <input type="hidden" name="delete-name" value="<?php echo $page['name']; ?>">
                                                        <div class="modal-footer">
                                                            <button name="delete-page-submit" type="submit">Seite Löschen</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php }
                    }else{ ?>
                        <div class="row">
                            <div class="col-12">
                                <p>Es gibt noch keine Seiten.</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
        </section>
    </article>
</main>

<?php include 'includes/footer.php'; ?>
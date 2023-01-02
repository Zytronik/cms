<?php include 'includes/header.php'; 
include 'includes/update-menu-handler.php'; ?>
<main class="content-wrapper">
    <article class="menu-editor">
        <section>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h1>Menus</h1> 
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
        				<h2>Header Menu</h2>
        			</div>
        		</div>
                <div class="row">
                    <div class="col-12">
                        <form action="#" method="POST">
                            <?php $menu_header = "SELECT * FROM menu_header";
                            $menu_header = $conn->query($menu_header); ?>
                            <div class="menu-header menu-point-wrapper">
                                <?php if ($menu_header->num_rows > 0) { ?>   
                                    <?php $menu_header_counter = 1;
                                    while($menupoint_header = $menu_header->fetch_assoc()) { ?>
                                        <div class="menu-point menu-header-point" data-field-index="<?php echo $menu_header_counter; ?>">
                                            <div class="input-wrapper">
                                                <label for="menu-header-name-<?php echo $menu_header_counter; ?>">Menupunktname: </label>
                                                <input id="menu-header-name-<?php echo $menu_header_counter; ?>" type="text" value="<?php echo $menupoint_header["name"]; ?>" name="menu-header-name-<?php echo $menu_header_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="menu-header-icon-<?php echo $menu_header_counter; ?>">Menupunkticon: </label>
                                                <input id="menu-header-icon-<?php echo $menu_header_counter; ?>" type="text" value="<?php echo $menupoint_header["icon"]; ?>" name="menu-header-icon-<?php echo $menu_header_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="menu-header-link-<?php echo $menu_header_counter; ?>">Menupunkturl: </label>
                                                <input id="menu-header-link-<?php echo $menu_header_counter; ?>" type="text" value="<?php echo $menupoint_header["url"]; ?>" name="menu-header-link-<?php echo $menu_header_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                            <label for="menu-header-page-<?php echo $menu_header_counter; ?>">Menuseite: </label>
                                            <select multiple id="menu-header-page-<?php echo $menu_header_counter; ?>" name="menu-header-page-<?php echo $menu_header_counter; ?>[]">
                                                <?php $pages = "SELECT ID, title FROM page";
                                                $pages = $conn->query($pages);
                                                if ($pages->num_rows > 0) {
                                                    $page_ids = json_decode($menupoint_header['pages']);
                                                    while($page = $pages->fetch_assoc()) { ?>
                                                        <option <?php if(is_array($page_ids) && in_array($page['ID'], $page_ids)){ echo 'selected';
                                                        } ?> value="<?php echo $page['ID']; ?>"><?php echo $page["title"]; ?></option>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                </option value="0">Keine Seiten vorhanden</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                            <button class="delete-menu-point">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button class="menu-point-up">
                                                <i class="fas fa-arrow-circle-up"></i>
                                            </button>
                                            <button class="menu-point-down">
                                                <i class="fas fa-arrow-circle-down"></i>
                                            </button>
                                        </div>
                                        <?php $menu_header_counter++;
                                    } ?>
                                <?php } else { ?>
                                    <div class="menu-point menu-header-point" data-field-index="1">
                                        <div class="input-wrapper">
                                            <label for="menu-header-name-1">Menupunktname: </label>
                                            <input id="menu-header-name-1" type="text" value="" name="menu-header-name-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-header-icon-1">Menupunkticon: </label>
                                            <input id="menu-header-icon-1" type="text" value="" name="menu-header-icon-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-header-link-1">Menupunkturl: </label>
                                            <input id="menu-header-link-1" type="text" value="" name="menu-header-link-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-header-page-1">Menuseite: </label>
                                            <select multiple id="menu-header-page-1" name="menu-header-page-1[]">
                                                <?php $pages = "SELECT ID, title FROM page";
                                                $pages = $conn->query($pages);
                                                if ($pages->num_rows > 0) {
                                                    while($page = $pages->fetch_assoc()) { ?>
                                                        <option value="<?php echo $page['ID']; ?>"><?php echo $page["title"]; ?></option>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                </option value="0">Keine Seiten vorhanden</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button class="delete-menu-point">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button class="menu-point-up">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </button>
                                        <button class="menu-point-down">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="button-wrapper">        
                                <button class="add-menupoint">Neuer Menupunkt</button>
                                <button name="update-header-menu" type="submit">Menu aktualisieren</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-large">
                <div class="row">
                    <div class="col-12">
                        <h2>Footer Menu</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="#" method="POST">
                            <?php $menu_footer = "SELECT * FROM menu_footer";
                            $menu_footer = $conn->query($menu_footer); ?>
                            <div class="menu-footer menu-point-wrapper">
                                <?php if ($menu_footer->num_rows > 0) { ?>   
                                    <?php $menu_footer_counter = 1;
                                    while($menupoint_footer = $menu_footer->fetch_assoc()) { ?>
                                        <div class="menu-point menu-footer-point" data-field-index="<?php echo $menu_footer_counter; ?>">
                                            <div class="input-wrapper">
                                                <label for="menu-footer-name-<?php echo $menu_footer_counter; ?>">Menupunktname: </label>
                                                <input id="menu-footer-name-<?php echo $menu_footer_counter; ?>" type="text" value="<?php echo $menupoint_footer["name"]; ?>" name="menu-footer-name-<?php echo $menu_footer_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="menu-footer-icon-<?php echo $menu_footer_counter; ?>">Menupunkticon: </label>
                                                <input id="menu-footer-icon-<?php echo $menu_footer_counter; ?>" type="text" value="<?php echo $menupoint_footer["icon"]; ?>" name="menu-footer-icon-<?php echo $menu_footer_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="menu-footer-link-<?php echo $menu_footer_counter; ?>">Menupunkturl: </label>
                                                <input id="menu-footer-link-<?php echo $menu_footer_counter; ?>" type="text" value="<?php echo $menupoint_footer["url"]; ?>" name="menu-footer-link-<?php echo $menu_footer_counter; ?>">
                                            </div>
                                            <div class="input-wrapper">
                                                <label for="menu-footer-page-<?php echo $menu_footer_counter; ?>">Menuseite: </label>
                                                <select multiple id="menu-footer-page-<?php echo $menu_footer_counter; ?>" name="menu-footer-page-<?php echo $menu_footer_counter; ?>[]">
                                                    <?php $pages = "SELECT ID, title FROM page";
                                                    $pages = $conn->query($pages);
                                                    if ($pages->num_rows > 0) {
                                                        $page_ids = json_decode($menupoint_footer['pages']);
                                                        while($page = $pages->fetch_assoc()) { ?>
                                                            <option <?php if(is_array($page_ids) && in_array($page['ID'], $page_ids)){ echo 'selected';
                                                        } ?> value="<?php echo $page['ID']; ?>"><?php echo $page["title"]; ?></option>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        </option value="0">Keine Seiten vorhanden</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button class="delete-menu-point">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button class="menu-point-up">
                                                <i class="fas fa-arrow-circle-up"></i>
                                            </button>
                                            <button class="menu-point-down">
                                                <i class="fas fa-arrow-circle-down"></i>
                                            </button>
                                        </div>
                                        <?php $menu_footer_counter++;
                                    } ?>
                                <?php } else { ?>
                                    <div class="menu-point menu-footer-point" data-field-index="1">
                                        <div class="input-wrapper">
                                            <label for="menu-footer-name-1">Menupunktname: </label>
                                            <input id="menu-footer-name-1" type="text" value="" name="menu-footer-name-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-footer-icon-1">Menupunkticon: </label>
                                            <input id="menu-footer-icon-1" type="text" value="" name="menu-footer-icon-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-footer-link-1">Menupunkturl: </label>
                                            <input id="menu-footer-link-1" type="text" value="" name="menu-footer-link-1">
                                        </div>
                                        <div class="input-wrapper">
                                            <label for="menu-footer-page-1">Menuseite: </label>
                                            <select multiple id="menu-footer-page-1" name="menu-footer-page-1[]">
                                                <?php $pages = "SELECT ID, title FROM page";
                                                $pages = $conn->query($pages);
                                                if ($pages->num_rows > 0) {
                                                    while($page = $pages->fetch_assoc()) { ?>
                                                        <option value="<?php echo $page['ID']; ?>"><?php echo $page["title"]; ?></option>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                </option value="0">Keine Seiten vorhanden</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button class="delete-menu-point">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button class="menu-point-up">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </button>
                                        <button class="menu-point-down">
                                            <i class="fas fa-arrow-circle-down"></i>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="button-wrapper">        
                                <button class="add-menupoint">Neuer Menupunkt</button>
                                <button name="update-footer-menu" type="submit">Menu aktualisieren</button>
                            </div>
                        </form>
                    </div>
                </div>
        	</div>
        </section>
    </article>
</main>
<?php include 'includes/footer.php'; ?>
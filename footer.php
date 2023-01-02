	<footer>
		<div class="container-large">
			<div class="row">
				<div class="col-12">
					<div class="logo-wrapper">
						<div>
							<img src="<?php echo get_directory_url(); ?>img/logo.png">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php $menu_footer = getFooterMenu(getPageId(get_pagename()));
					if(!empty($menu_footer)){ ?>
						<nav>
							<ul>
								<?php foreach ($menu_footer as $key => $f_menupoint) { ?>
									<li>
										<div>
											<?php if($f_menupoint['name'] == "Book Now"){ ?>
												<button type="button" class="page-scroll" data-toggle="modal" data-target="#bookingModal">
													<?php echo $f_menupoint['name']; ?>
												</button>
											<?php }else{ ?>
												<a class="page-scroll" href="<?php
												if($isHome){
													echo $f_menupoint['url'];
												}else{
													echo get_directory_url().$f_menupoint['url'];
												} 
											?>"><?php echo $f_menupoint['name']; ?></a>
											<?php } ?>
										</div>
									</li>
								<?php } ?>
							</ul>
						</nav>
					<?php } ?>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>
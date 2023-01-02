$(function() {
	$( window ).on("resize", function() {
		pageMinHeight();
	});

	pageMinHeight();

	function pageMinHeight() {
		var windowHeight = $(window).height();
		var headerHeight = $("header").outerHeight();
		var footerHeight = $("footer").outerHeight();
		var minHeight = windowHeight - headerHeight - footerHeight - 30 /* <- footermargin*/;
		$("main.content-wrapper").css("minHeight", minHeight);
	}

	/* New Block */
	function showInfosFromSelect(select = $(".new-block-page select.block_type:first-of-type")){
		var fieldType = select.val();
		var allTypes = select.parent().parent().find(".field-infos");
		allTypes.each(function(){
			$(this).addClass("d-none");
			var inputs = $(this).find("input");
			inputs.each(function(){
				$(this).prop("required", false);
			});
		});
		select.parent().parent().find("[data-type='"+ fieldType +"'] input").val("");
		select.parent().parent().find("[data-type='"+ fieldType +"']").removeClass("d-none");
		var inputs = select.parent().parent().find("[data-type='"+ fieldType +"'] input");
		inputs.each(function(){
			$(this).prop("required", true);
		});
	}
	
	showInfosFromSelect();

	$(document).on("change", ".new-block-page select.block_type", function(e){
		showInfosFromSelect($(this));
	});

	function addField() {
		$(".new-block-page .fields .field:last-of-type").clone().appendTo(".new-block-page .fields");
		updateSelectIds();
		updateFieldIds();
		showInfosFromSelect($(".new-block-page .fields .field:last-of-type select"));
	}

	function deleteField(elem) {
		if($(".new-block-page .fields .field").length > 1) {
			elem.parent().parent().remove();
			updateSelectIds();
			updateFieldIds();
		}
	}

	function updateFieldIds() {
		$(".new-block-page .field").each(function(index){
			$(this).attr("data-field-index", index + 1);
			if($(this).find("label").length > 0){
				$(this).find("label").each(function(){
					var labelId = $(this).attr("for").replace(/\d+/g, '');
					$(this).attr("for", labelId + (index + 1));
				});
			}
			if($(this).find("input").length > 0){
				$(this).find("input").each(function(){
					var inputId = $(this).attr("id").replace(/\d+/g, '');
					$(this).attr("id", inputId + (index + 1));
					if($(this).attr("name").substr($(this).attr("name").length - 2) === "[]"){
						var inputName = $(this).attr("name").replace(/\d+/g, '');
						$(this).attr("name", inputName + (index + 1) + "[]");
					}else{
						var inputName = $(this).attr("name").replace(/\d+/g, '');
						$(this).attr("name", inputName + (index + 1));
					}
				});
			}
		});
	}

	function updateSelectIds(){
		$(".new-block-page .field select").each(function(index){
			var inputId = $(this).attr("id").replace(/\d+/g, '');
			$(this).attr("id", inputId + (index + 1));
			var inputName = $(this).attr("name").replace(/\d+/g, '');
			$(this).attr("name", inputName + (index + 1));
			var labelId = $(this).parent().find("label[for^='block_type-']").attr("for").replace(/\d+/g, '');
			$(this).parent().find("label[for^='block_type-']").attr("for", labelId + (index + 1));
		});
	}

	function moveFieldUp(field) {
		var index = field.attr("data-field-index");
		if( index > 1) {
			var markup = field.detach();
			$(".new-block-page .field[data-field-index='"+ (index - 1) +"']").before(markup);
			updateSelectIds();
			updateFieldIds();
		}
	}

	function moveFieldDown(field) {
		var index = parseInt(field.attr("data-field-index"));
		if( $(".new-block-page .field[data-field-index='"+ (index + 1) +"']").length > 0) {
			var markup = field.detach();
			$(".new-block-page .field[data-field-index='"+ (index + 1) +"']").after(markup);
			updateSelectIds();
			updateFieldIds();
		}
	}

	$(document).on("click", ".new-block-page button.field-up", function(e){
		e.preventDefault();
		moveFieldUp($(this).parent().parent());
	});

	$(document).on("click", ".new-block-page button.field-down", function(e){
		e.preventDefault();
		moveFieldDown($(this).parent().parent());
	});
	
	$(document).on("click", ".new-block-page button.delete-field", function(e){
		e.preventDefault();
		deleteField($(this));
	});

	$(document).on("click", ".new-block-page button.add-field", function(e){
		e.preventDefault();
		addField();
	});

	/*$(document).on("click", ".new-block-page table tr td > i", function(e){
		var blockID = $(this).parent().parent().find("td:first-of-type").text();
		console.log(blockID);
		editBlock(blockID);
	});*/

	/* Pages */
	function updateBlocksIndex() {
		$(".page .blocks > .block").each(function(index){
			$(this).attr("data-block-index", index + 1);
		});
	}

	function updateBlocksHiddenFieldsIndex(){
		$(".page .blocks > .block").each(function(index){
			var name = $(this).find("input[name^='block-id-']").attr("name").replace(/\d+/g, '');
			$(this).find("input[name^='block-id-']").attr("name", name+(index+1));

			var name = $(this).find("input[name^='block-index-']").attr("name").replace(/\d+/g, '');
			$(this).find("input[name^='block-index-']").attr("name", name+(index+1));
			$(this).find("input[name^='block-index-']").val(index+1);			
		});
	}

	function updateBlocksFieldsIndex(){
		$(".page .blocks > .block").each(function(index){
			$(this).find(".fields .field").each(function(){
				var regex = /^([A-Za-z_]+-data)-(\d+)-(\d+)$/;
				var match = regex.exec($(this).find("label").attr("for"));
				var newID = match[1]+"-"+(index+1)+"-"+match[3];
				$(this).find("label").attr("for", newID);
				$(this).find("input, textarea").each(function(){
					$(this).attr("id", newID);
				});
				$(this).find("input, textarea").each(function(){
					if($(this).attr("name").substr($(this).attr("name").length - 2) === "[]"){
						$(this).attr("name", newID + "[]");
					}else{
						$(this).attr("name", newID);
					}
				});
			});
		});
	}

	function moveBlockUp(block){
		var blockIndex = $(block).attr("data-block-index");
		if(blockIndex > 1){
			var markup = $(block).detach();
			$(".page .blocks .block[data-block-index='"+ (blockIndex-1) +"']").before(markup[0]);
			updateBlocksIndex();
			updateBlocksHiddenFieldsIndex();
			updateBlocksFieldsIndex();
		}
	}

	function deleteBlock(block){
		var pagehasblockID = $(block).attr("data-pagehasblockID");
		if(pagehasblockID){
			var oldVal = $("#delete-block-ids").val();
			if(oldVal){
				$("#delete-block-ids").val(oldVal + ", " + pagehasblockID);
			}else{
				$("#delete-block-ids").val(pagehasblockID);
			}
		}
		$(block).remove();
		updateBlocksIndex();
		updateBlocksHiddenFieldsIndex();
		updateBlocksFieldsIndex();
	}

	function moveBlockDown(block){
		var blockIndex = parseInt($(block).attr("data-block-index"));
		if($(".page .blocks .block[data-block-index='"+ (blockIndex+1) +"']").length > 0){
			var markup = $(block).detach();
			$(".page .blocks .block[data-block-index='"+ (blockIndex+1) +"']").after(markup[0]);
			updateBlocksIndex();
			updateBlocksHiddenFieldsIndex();
			updateBlocksFieldsIndex();
		}
	}

	$(document).on('click', '.page .block button.block-up', function(e){
		e.preventDefault();
		moveBlockUp($(this).parent().parent());
	});

	$(document).on('click', '.page .block button.block-down', function(e){
		e.preventDefault();
		moveBlockDown($(this).parent().parent());
	});

	$(document).on('click', '.page .block button.delete-block', function(e){
		e.preventDefault();
		deleteBlock($(this).parent().parent());
	});

	$(document).on('change', ".page .choose-block-wrapper select", function () {
		var block_val = $(this).val();
		var block_id = $(this).find(":selected").attr("data-b-id");
		var page_id = $(".page form.page-form").attr("data-page_id");
		var block_index = $(".page .blocks > .block").length + 1;
		if(block_val && page_id){
	        $.ajax({
	            url: "../ajax.php",
	            method: 'POST',
	            data: {
	                action: 'addBlockToPage',
	                block_val: block_val,
	                page_id: page_id,
	                index: block_index
	            },
	            success: function (fields) {
	            	if(fields){
	            		$(".page .blocks").append(
	            			'<div class="block '+ block_val +'" data-block-id="'+ block_id +'" data-block-index="">'+
	            				'<input type="hidden" name="block-id-'+ block_index +'" value="'+ block_id +'">'+
                                '<input type="hidden" name="block-index-'+ block_index +'" value="'+ block_index +'">'+
                                '<div class="fields">'+
                                	fields +             
                                '</div>'+
                                '<div>'+
                                	'<button class="delete-block">'+
                                        '<i class="fas fa-minus"></i>'+
                                	'</button> '+
                                    '<button class="block-up">'+
                                        '<i class="fas fa-arrow-circle-up"></i>'+
                                    '</button> '+
                                    '<button class="block-down">'+
                                        '<i class="fas fa-arrow-circle-down"></i>'+
                                    '</button> '+
                                '</div>'+
                            '</div>'
                        );
                        updateBlocksIndex();
                        $(".page .choose-block-wrapper select").val("choose");
	            	}else{
	            		console.log("Erroooooooooooooor");
	            	}
	            }
	        });
	    }
    });

    /* Page */
    $(document).on("click", ".gallery-img-wrapper i:nth-of-type(2)", function(e){
    	var input = $(this).parent().parent().parent().find("input:last-of-type");
    	var galleryImgIndex = $(this).parent().attr("data-gallery-index");
		if(galleryImgIndex > 0){
			var markup = $(this).parent().detach();
			$(".gallery-img-wrapper[data-gallery-index='"+ (parseInt(galleryImgIndex) - 1) +"']").before(markup[0]);
			updateGalleryInputOrder(galleryImgIndex, parseInt(galleryImgIndex) - 1, input);
			updateGalleryIndex();
		}
    });

    $(document).on("click", ".gallery-img-wrapper i:nth-of-type(3)", function(e){
    	var input = $(this).parent().parent().parent().find("input:last-of-type");
    	var galleryImgIndex = $(this).parent().attr("data-gallery-index");
    	var markup = $(this).parent().detach();
    	$(".gallery-img-wrapper[data-gallery-index='"+ (parseInt(galleryImgIndex) + 1) +"']").after(markup[0]);
    	updateGalleryInputOrder(galleryImgIndex, parseInt(galleryImgIndex) + 1, input);
    	updateGalleryIndex();
    });

    function updateGalleryInputOrder(currentI, newI, inputField){
    	var isArray = true;
    	var tempVal = "";
    	var input = $(inputField).val();
    	input = input.replaceAll("'", '"');
    	try {
    		var arrayInput = JSON.parse(input);
    	} catch (e) {
    		isArray = false;
    	}
    	if(isArray){
    		tempVal = arrayInput[currentI];
    		arrayInput[currentI] = arrayInput[newI]
    		arrayInput[newI] = tempVal;
    		$(inputField).val(JSON.stringify(arrayInput));
    	}
    }

    $(document).on("click", ".gallery-img-wrapper i:first-of-type", function(e){
    	var isArray = true;
    	var index = $(this).parent().attr("data-gallery-index");
    	var input = $(this).parent().parent().parent().find("input:last-of-type").val();
    	input = input.replaceAll("'", '"');
    	try {
    		var arrayInput = JSON.parse(input);
    	} catch (e) {
    		isArray = false;
    	}
    	if(isArray){
	    	arrayInput.splice(index,1);
	    	$(this).parent().parent().parent().find("input:last-of-type").val(JSON.stringify(arrayInput));
	    }else{
	    	$(this).parent().parent().parent().find("input:last-of-type").val("[]");
	    }
	    $(this).parent().remove();
	    updateGalleryIndex();
    });

    function updateGalleryIndex(){
    	$(".field-gallery-wrapper").each(function(i){
	    	$(this).find(".gallery-img-wrapper").each(function(i){
	    		$(this).attr("data-gallery-index", i);
	    	});
	    });	
    }

	/* Menus */
    $(document).on("click", ".menu-editor button.add-menupoint", function(e){
		e.preventDefault();
		addMenuPoint($(this));
	});

	$(document).on("click", ".menu-editor button.delete-menu-point", function(e){
		e.preventDefault();
		deleteMenuPoint($(this));
	});

	$(document).on("click", ".menu-editor button.menu-point-up", function(e){
		e.preventDefault();
		moveMenuPointUp($(this).parent());
	});

	$(document).on("click", ".menu-editor button.menu-point-down", function(e){
		e.preventDefault();
		moveMenuPointDown($(this).parent());
	});

	function moveMenuPointUp(field) {
		var index = parseInt(field.attr("data-field-index"));
		console.log("index:" + index);
		if( index > 1) {
			console.log("test22");
			parent = field.parent();
			var markup = field.detach();
			parent.find(".menu-point[data-field-index='"+ (index - 1) +"']").before(markup);
			updateMenuIds();
		}
	}

	function moveMenuPointDown(field) {
		var index = parseInt(field.attr("data-field-index"));
		parent = field.parent();
		console.log(parent.find(".menu-point[data-field-index='"+ (index + 1) +"']"));
		if( parent.find(".menu-point[data-field-index='"+ (index + 1) +"']").length > 0) {
			console.log("test11");
			var markup = field.detach();
			parent.find(".menu-point[data-field-index='"+ (index + 1) +"']").after(markup);
			updateMenuIds();
		}
	}
	
	function deleteMenuPoint(elem){
		if(elem.parent().parent().find(".menu-point").length > 1) {
			elem.parent().remove();
			updateMenuIds();
		}
	}

	function addMenuPoint(elem) {
		elem.parent().parent().find(".menu-point-wrapper .menu-point:last-of-type").clone().appendTo(elem.parent().parent().find(".menu-point-wrapper"));
		updateMenuIds();
		elem.parent().parent().find(".menu-point-wrapper .menu-point:last-of-type").find("input").each(function(){
			$(this).val("");
		});
	}

	function updateMenuIds() {
		var menus = [$(".menu-editor .menu-footer .menu-point"), $(".menu-editor .menu-header .menu-point")];
		$(menus).each(function(){
			$(this).each(function(index){
				$(this).attr("data-field-index", index + 1);
				if($(this).find("label").length > 0){
					$(this).find("label").each(function(){
						var labelId = $(this).attr("for").replace(/\d+/g, '');
						$(this).attr("for", labelId + (index + 1));
					});
				}
				if($(this).find("input").length > 0){
					$(this).find("input").each(function(){
						var inputId = $(this).attr("id").replace(/\d+/g, '');
						$(this).attr("id", inputId + (index + 1));
						if($(this).attr("name").substr($(this).attr("name").length - 2) === "[]"){
							var inputName = $(this).attr("name").replace(/\d+/g, '');
							$(this).attr("name", inputName + (index + 1) + "[]");
						}else{
							var inputName = $(this).attr("name").replace(/\d+/g, '');
							$(this).attr("name", inputName + (index + 1));
						}
					});
				}
				if($(this).find("select").length > 0){
					$(this).find("select").each(function(){
						var selectId = $(this).attr("id").replace(/\d+/g, '');
						$(this).attr("id", selectId + (index + 1));
						if($(this).attr("name").substr($(this).attr("name").length - 2) === "[]"){
							var data = $(this).attr("name");
							data = data.substring(0, data.length - 2);
							var selectName = data.replace(/\d+/g, '');
							$(this).attr("name", selectName + (index + 1) + "[]");
						}else{
							var selectName = $(this).attr("name").replace(/\d+/g, '');
							$(this).attr("name", selectName + (index + 1));
						}
					});
				}
			});
		});
	}
});
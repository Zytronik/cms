<link rel="stylesheet" type="text/css" href="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".css"; ?>">
<script defer src="<?php echo get_directory_url()."blocks/".$block_name."/".$block_name.".js"; ?>"></script>
<?php $fields = get_fields($block_id, $pagehasblock_id);
// Nix ändere über dere Ziele ?>

<section id="contact" class="block <?php echo $block_name; ?>">
	<div id="map"></div>
	<div class="container-large contact">
		<div class="row">
			<div class="offset-0 offset-md-6 col-12 col-md-6">
				<div class="contact-wrapper">
					<h2 class="blocktitle">Kontakt Informationen</h2>
					<div>
						<div>
							<p><?php echo get_field("Seitentitel"); ?></p>
							<p><?php echo get_field("Adresse"); ?></p>
							<p><?php echo get_field("Telefon"); ?></p>
							<a href="mailto:<?php echo get_field("E-Mail"); ?>"><?php echo get_field("E-Mail"); ?></a>
						</div>
						<div>
							<p><?php echo get_field("Öffnungszeiten"); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
var map;

function panMap(map) {
	var windowWidth = $(document ).width();
	if(windowWidth > 767){
		map.panBy((document.querySelector(".map .contact .row > div:first-of-type").offsetWidth + 30) / 2 , 0);
	}
}

$(window).on('resize', function(){
	panMap(map)
});

function initMap() {
	var location = {
		lat: 47.52935,
		lng: 7.6442
	};
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: location
	});
	var marker = new google.maps.Marker({
		position: location,
		map: map,
		title: '<?php echo get_field("Seitentitel"); ?>',
		icon: {
		    url: "<?php echo get_directory_url(); ?>img/marker.png",
		    scaledSize: new google.maps.Size(44, 76),
		},
	});

	panMap(map);
	
	map.setOptions({
		styles: [
		    {
		        "featureType": "administrative",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": "-100"
		            }
		        ]
		    },
		    {
		        "featureType": "administrative.province",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "landscape",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": -100
		            },
		            {
		                "lightness": 65
		            },
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": -100
		            },
		            {
		                "lightness": "50"
		            },
		            {
		                "visibility": "simplified"
		            }
		        ]
		    },
		    {
		        "featureType": "road",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": "-100"
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "simplified"
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "all",
		        "stylers": [
		            {
		                "lightness": "30"
		            }
		        ]
		    },
		    {
		        "featureType": "road.local",
		        "elementType": "all",
		        "stylers": [
		            {
		                "lightness": "40"
		            }
		        ]
		    },
		    {
		        "featureType": "transit",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": -100
		            },
		            {
		                "visibility": "simplified"
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "hue": "#ffff00"
		            },
		            {
		                "lightness": -25
		            },
		            {
		                "saturation": -97
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "lightness": -25
		            },
		            {
		                "saturation": -100
		            }
		        ]
		    }
		]
	});
}
</script>

<script src="<?php echo "https://maps.googleapis.com/maps/api/js?key=".$fields["Google Maps Key"]."&callback=initMap"; ?>" async defer></script>
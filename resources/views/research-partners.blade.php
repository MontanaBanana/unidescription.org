@extends('layouts.app')

@section('title', 'About')

@section('content')

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">
				<div class="col-lg-12">
					<h1 class="page-header">Research Partners
						<small>UniDescription</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="{{ SITEROOT }}/">Home</a></li>
						<li><a href="{{ SITEROOT }}/about">About</a></li>
						<li class="active">Research Partners</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<?php
		$research_partners = array(
'César E. Chávez National Monument' => array('image' => 'Cesar.jpg'),
'Channel Islands National Park' => array('image' => 'Channel Islands.jpg'),
'Denali National Park' => array('image' => 'Denali.jpg'),
'Everglades National Park' => array('image' => 'Everglades.jpg'),
'Fort Smith National Historic Site' => array('image' => 'Fort Smith.jpg'),
'Fort Vancouver National Historic Site' => array('image' => 'Fort Vancouver.jpg'),
'George Washington Memorial Parkway' => array('image' => 'George Washington Parkway.jpg'),
'Gettysburg National Military Park' => array('image' => 'Gettysburg.jpg'),
'Golden Gate National Recreation Area' => array('image' => 'Golden Gate.jpg'),
'Hagerman Fossil Beds National Monument' => array('image' => 'Hagerman Fossil Beds.jpg'),
'Hawai‘i Volcanoes National Park' => array('image' => 'Volcanoes.jpg'),
'Harry S Truman National Historic Site' => array('image' => 'Truman.png'),
'Herbert Hoover National Historic Site' => array('image' => 'Herbert Hoover.jpg'),
'John Day Fossil Beds National Monument' => array('image' => 'John Day Fossil Beds.jpg'),
'Joshua Tree National Park' => array('image' => 'Joshua Tree.jpg'),
'Katmai National Park and Preserve' => array('image' => 'Katmai.jpg'),
'Lowell National Historical Park' => array('image' => 'Lowell.jpg'),
'Manzanar National Historic Site' => array('image' => 'Manzanar.jpg'),
'Morristown National Historical Park' => array('image' => 'Morristown.jpg'),
'National Park Service System Map and Guide' => array('image' => 'National Park Service guide.jpg'),
'Pu‘ukohola Heiau National Historic Site' => array('image' => 'Puukohola Heiau.jpg'),
'San Francisco Maritime National Historic Park' => array('image' => 'Maritime.jpg'),
'Sitka National Historical Park' => array('image' => 'Sitka.jpg'),
'Steamtown National Historic Site' => array('image' => 'Steamtown.jpg'),
'Thomas Edison National Historic Site' => array('image' => 'Thomas Edison.jpg'),
'Washington Monument' => array('image' => 'Washington Monument.jpg'),
'Yellowstone National Park' => array('image' => 'Yellowstone Rainbow Pool.jpg')
		);
		
		?>
		<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
		<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				
				var $grid = $('.grid').masonry({
				  itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
				  columnWidth: '.grid-sizer',
				  percentPosition: true
				});
		
				$grid.imagesLoaded().progress( function() {
					  $grid.masonry('layout');
				});
			});
		</script>
		<?php
		/*
		<div class="row">
			<div class="container">
				<div class="col-lg-12">
					<h2 class="page-header">Research Partners</h2>
				</div>
			</div>
		</div>
		*/
		?>

		<div class="row">
			<div class="container container-fluid">
			  <!-- add extra container element for Masonry -->
			  <div class="grid">
				<!-- add sizing element for columnWidth -->
				<div class="grid-sizer col-xs-4"></div>
				<!-- items use Bootstrap .col- classes -->
				
				<?php
					foreach ($research_partners as $k => $r):
						?>
							<div class="grid-item col-md-4 col-sm-4 col-xs-6">
								<div class="grid-item-content">
									<img class="img-responsive customer-img" src="{{ SITEROOT }}/images/research_partners/<?php echo $r['image']; ?>" alt="{{ $k }}">
									<p>{{ $k }}</p>
								</div>
							</div>
						<?php
					endforeach;
				?>
				
			  </div>
			</div>
		</div>
		<!-- /.row -->
		
		<hr>
		
@endsection

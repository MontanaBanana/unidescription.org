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
'César E. Chávez National Monument' => array('image' => 'Cesar.jpg', 'link' => '/account/project/export/124'),
'Channel Islands National Park' => array('image' => 'Channel Islands.jpg', 'link' => '/account/project/export/125'),
'Denali National Park' => array('image' => 'Denali.jpg', 'link' => '/account/project/export/101'),
'Everglades National Park' => array('image' => 'Everglades.jpg', 'link' => '/account/project/export/103'),
'Fort Smith National Historic Site' => array('image' => 'Fort Smith.jpg', 'link' => '/account/project/export/126'),
'Fort Vancouver National Historic Site' => array('image' => 'Fort Vancouver.jpg', 'link' => '/account/project/export/89'),
'George Washington Memorial Parkway' => array('image' => 'George Washington Parkway.jpg', 'link' => '/account/project/export/128'),
'Gettysburg National Military Park' => array('image' => 'Gettysburg.jpg', 'link' => '/account/project/export/98'),
'Golden Gate National Recreation Area' => array('image' => 'Golden Gate.jpg', 'link' => '/account/project/export/76'),
'Hagerman Fossil Beds National Monument' => array('image' => 'Hagerman Fossil Beds.jpg', 'link' => '/account/project/export/136'),
'Hawai‘i Volcanoes National Park' => array('image' => 'Volcanoes.jpg', 'link' => '/account/project/export/252'),
'Harry S Truman National Historic Site' => array('image' => 'Truman.png', 'link' => '/account/project/export/123'),
'Herbert Hoover National Historic Site' => array('image' => 'Herbert Hoover.jpg', 'link' => '/account/project/export/107'),
'John Day Fossil Beds National Monument' => array('image' => 'John Day Fossil Beds.jpg', 'link' => '/account/project/export/99'),
'Joshua Tree National Park' => array('image' => 'Joshua Tree.jpg', 'link' => '/account/project/export/102'),
'Katmai National Park and Preserve' => array('image' => 'Katmai.jpg', 'link' => '/account/project/export/131'),
'Lowell National Historical Park' => array('image' => 'Lowell.jpg', 'link' => '/account/project/export/132'),
'Manzanar National Historic Site' => array('image' => 'Manzanar.jpg', 'link' => '/account/project/export/133'),
'Morristown National Historical Park' => array('image' => 'Morristown.jpg', 'link' => '/account/project/export/134'),
'National Park Service System Map and Guide' => array('image' => 'National Park Service guide.jpg', 'link' => '/account/project/export/148'),
'Pu‘ukohola Heiau National Historic Site' => array('image' => 'Puukohola Heiau.jpg', 'link' => '/account/project/export/94'),
'San Francisco Maritime National Historic Park' => array('image' => 'Maritime.jpg', 'link' => '/account/project/export/92'),
'Sitka National Historical Park' => array('image' => 'Sitka.jpg', 'link' => '/account/project/export/108'),
'Steamtown National Historic Site' => array('image' => 'Steamtown.jpg', 'link' => '/account/project/export/122'),
'Thomas Edison National Historic Site' => array('image' => 'Thomas Edison.jpg', 'link' => '/account/project/export/93'),
'Washington Monument' => array('image' => 'Washington Monument.jpg', 'link' => '/account/project/export/242'),
'Yellowstone National Park' => array('image' => 'Yellowstone Rainbow Pool.jpg', 'link' => '/account/project/export/91')
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
                                    <a target="_blank" href="<?php echo $r['link']; ?>"><img class="img-responsive customer-img" src="{{ SITEROOT }}/images/research_partners/<?php echo $r['image']; ?>" alt="{{ $k }}"></a>
                                    <p><a target="_blank" href="<?php echo $r['link']; ?>">{{ $k }}</a></p>
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

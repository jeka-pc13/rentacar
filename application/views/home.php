<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
	<div class="container">
		<h1>Vales Rent-A-Car</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, atque. Assumenda a, voluptate totam aperiam, numquam excepturi ea, error enim fugiat quos, ad eius! Ad tempora provident ducimus corrupti. Natus voluptatibus repellat blanditiis accusamus, ea, voluptates vero sint illum necessitatibus labore consectetur architecto ex, aliquam temporibus! Velit, ullam quos sapiente qui nesciunt sint? Aperiam quas facere sequi accusamus nemo, commodi eum perferendis nam id totam ea obcaecati nobis, eaque labore omnis vero maiores, iusto aliquid quisquam? Ea numquam cupiditate alias ipsa, accusantium ad recusandae provident repellendus quam adipisci, culpa harum minima iure commodi optio ex et explicabo obcaecati accusamus dolores!</p>
		<button type="submit" class="btn btn-primary">Frota</button>
		<!-- <a type="submit" href="<?php echo base_url("rentacar/"); ?>" class="btn btn-primary">+Add</a> -->

		<div class="inner cover">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="img-rounded img-responsive img-thumbnail" alt="Responsive image" src="<?php echo base_url('assets/images/toyota_yaris_01.png')?>">
					</div>					
					<div class="item">
						<img class="img-rounded img-responsive img-thumbnail" alt="Responsive image" src="<?php echo base_url('assets/images/nissan_micra_02.png')?>">
					</div>
					<div class="item">
						<img class="img-rounded img-responsive img-thumbnail" alt="Responsive image" src="<?php echo base_url('assets/images/audiA4_01.jpg')?>">
					</div>
				</div>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</div><!-- /.container -->
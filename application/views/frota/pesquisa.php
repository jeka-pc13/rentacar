  <div class="container">
  	<div class="row">

  		<nav class="navbar navbar-default">
  			<div class="nav nav-justified navbar-nav">

  				<?php 
  				$options = array(
  					"class" => "form-inline navbar-form navbar-search", 
  					"method" => "GET",
  					"role"=> "search"
  					);
  				echo form_open('pesquisa/', $options);
  				?>
  				<div class="col-md-9">
  					<div class="input-group">

  						<div class="col-md-3">
  							<select class="form-control" id="sel1" name="sel1">
  								<option value= "fabricante">Fabricante</option>
  								<option value= "matricula">Matrícula</option>
  								<option value= "modelo">Modelo</option>
  							</select>
  						</div>

  						<div class="col-md-5">
  							<input type="text" class="form-control">
  						</div>

  						<div class="col-md-1">
  							<span class="input-group-btn">
  								<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
  							</span>
  						</div>

  					</div>
  				</div> 
  				<?php echo form_close(); ?>
  			</div><!-- nav nav-justified navbar-nav -->
  		</nav>
  	</div><!-- row -->
  </div> <!-- container -->


  <h2>Book list <small><?php echo $search_results_count; ?> </small></h2>       
  <div class="panel">
  	<table class="table table-striped table-bordered  table-hover">
  		<thead>
  			<tr class="info">
  				<th>Fabricante</th>
  				<th>Modelo</th>
  				<th>Cor</th>
  				<th>Matrícula</th>
  				<th>Disponibilidade</th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php foreach($search_results as $livro) : ?>
  				<tr>
  					<td><?php echo $livro->idlivro;?></td> 
  					<td><?php echo $livro->titulo;?></td>
  					<td><span class="label label-default"><?php echo $livro->nome;?></span></td>
  					<td><?php echo $livro->data_publicacao;?></td>
  					<td class="actions">

  						<button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
  							<span class="glyphicon glyphicon-pencil"></span>
  						</button>

  						<button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button>
  					</td>

  				</tr>
  			<?php endforeach; ?> 
  		</tbody>
  	</table>
  	<div class="text-center"><?php echo $search_pagination; ?></div>
  </div>
</div>



<  <!-- Modal -->
<div class="modal fade" id="create-book" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Livro</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class=" modal-scroll">

						<?php echo $create_modal; ?>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>

	$(function(){

		$(".input-group-btn .dropdown-menu li a").click(function(){

			var selText = $(this).html();

        //working version - for single button //
       //$('.btn:first-child').html(selText+'<span class="caret"></span>');  
       
       //working version - for multiple buttons //
       $(this).parents('.input-group-btn').find('.btn-search').html(selText);

   });

	});
</script>



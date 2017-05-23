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
  				<div class="col-md-10">
  					<div class="input-group">

  						<div class="col-md-3">
  							<select class="form-control" id="pesquisa" name="pesquisas">
  								<option value= "fabricante">Fabricante</option>
  								<option value= "matricula">Matrícula</option>
  								<option value= "modelo">Modelo</option>
  							</select>
  						</div>

  						<span class="col-md-5">
  							<input type="text" class="form-control">
  						</span>

  						<div class="col-md-1">
  							<span class="input-group-btn">
  								<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
  							</span>
  						</div>


  					</div>
  				</div> 
  				<?php echo form_close(); ?>
  			</div><!-- nav nav-justified navbar-nav -->
  		</nav>
  	</div><!-- row -->
  </div> <!-- container -->


  <h2>Book list <small><?php echo $search_results_count; ?></small></h2>       
  <div class="panel">
  	<table class="table table-striped table-bordered  table-hover">
  		<thead>
  			<tr class="info">
  				<th>Fabricante</th>
  				<th>Modelo</th>
  				<th>Cor</th>
  				<th>Matrícula</th>
  				<th>Disponibilidade</th>
  				<th>Ações</th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php foreach($search_results as $auto) : ?>
  				<tr>
  					<td><?php echo $auto->fabricante;?></td> 
  					<td><?php echo $auto->modelo;?></td>
  					<td><?php echo $auto->cor;?></td>
  					<?php 
  					$primeiro = substr($auto->matricula, 0, 2);
  					$segundo  = substr($auto->matricula, 2, 2);
  					$terceiro = substr($auto->matricula, 4, 2);
  					?>
  					<td><?php echo "$primeiro-$segundo-$terceiro";?></td>
  					<td><?php echo $auto->disponibilidade;?></td>
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



 <!-- Modal -->
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





<div class="container conteudo">
	<div class="panel">
		<?php if ($this->session->has_userdata("event")):?>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Obrigado!</h3>
				</div>
				<div class="panel-body text-center">
					<legend><?php echo $this->session->event?></legend>
				</div>
			</div>
		<?php endif ?>

		<nav class="navbar navbar-default">
			<div class="nav nav-justified navbar-nav">
				<?php 
				$options = array(
					"class" => "form-inline navbar-form navbar-search", 
					"method" => "GET",
					"role"=> "search"
					);
				echo form_open('frota/pesquisa/', $options);
				?>

				<div class="form-group">
					<div class="input-group">

						<div class="input-group-btn search-panel">
							<select class="form-control" id="filtro" name="filtro">
								<option value= "fabricante">Fabricante</option>
								<option value= "matricula">Matrícula</option>
								<option value= "modelo">Modelo</option>
							</select>
						</div>

						<input type="text" class="form-control" name="search" id="search">

						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div><!-- input-group  -->
					<a type="submit" href="<?php echo base_url("frota/adicionar"); ?>" class="btn btn-primary">Adicionar automóvel</a>
				</div> <!-- form-group -->

				<?php echo form_close(); ?>
			</div><!-- nav -->
		</nav><!-- navbar -->


		<h2>Lista de automóveis <small><?php echo $search_results_count; ?></small></h2>       
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
							<td><?php echo $auto->matricula;?></td>
							<td><?php echo $auto->imprimeDisponibilidade();?></td>
							<td class="actions">

								<a href="<?php echo base_url('frota/editar/'.$auto->id) ?>" class="btn btn-primary btn-xs">
									<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<?php if ($auto->getDisponibilidade()): ?>

									<a href="<?php echo base_url('frota/remover/'.$auto->id) ?>"
										class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete">
										<span class="glyphicon glyphicon-trash"></span>
									</a>

								<?php else: ?>
									<a class="btn btn-danger btn-xs disabled  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on bottom" >
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach; ?> 
				</tbody>
			</table>
			<div class="text-center"><?php echo $search_pagination; ?></div>
		</div>
	</div>
</div> <!-- container -->


<!-- Modal -->
<div class="modal fade" id="delete" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
		</div>
	</div>
</div>





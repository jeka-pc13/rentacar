<div class="container-fluid">
	<div class="panel">
		<?php if ($success??:false) ?>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Parabéns!!</h3>
				</div>
				<div class="panel-body text-center">
					<legend>Os Dados Foram Submetidos Com Sucesso</legend>
				</div>
			</div>
		<?php endif ?>


		<form method="post" action="componente_cria_edita.php">
			<div class="form-group">
				<label for="modelo" class="col-sm-2 control-label">Modelo </label>
				<select class="form-control" name="modelo" id="modelo" required>
					<?php foreach ($modelos as $modelo): ?>
						<option  <?php echo set_select('modelo', $modelo->id); ?> value="<?php echo $modelo->id; ?>"><?php echo $modelo->nome; ?></option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('modelo'); ?>
			</div>


			<div class="form-group">
				<label for="cor" class="col-sm-2 control-label">Cor </label>
				<select class="form-control" name="cor" id="cor" required>
					<?php foreach ($cores as $cor): ?>
						<option  <?php echo set_select('cor', $cor->id); ?> value="<?php echo $cor->id; ?>"><?php echo $cor->nome; ?></option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('cor'); ?>
			</div>

			<div class="form-group">
				<label for="matricula">Matricula </label>
				<input type="text" class="form-control" id="matricula" name="matricula" placeholder="AA-00-AA" maxlength="8" required>
				<?php echo form_error('matricula'); ?>
			</div>

			<div class="container">
				<label class="radio-inline">
					<input type="radio" name="estado" id="estado" value="1">Disponível
				</label>
				<label class="radio-inline">
					<input type="radio" name="estado" id="estado" value="0">Ocupado
				</label>
				<?php echo form_error('estado'); ?>
			</div>

			<div class="container">
				<button type="reset" class="btn btn-warning form-inline">Cancelar</button>
				<button type="submit" class="btn btn-primary form-inline">Guardar</button>
			</div>
		</form>
	</div>
</div>


HENDRI MANEJA ESTE FICHERO.

MORTALES, ABSTENERSE DE TOCAR.
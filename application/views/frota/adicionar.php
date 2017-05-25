<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<?php echo validation_errors(); ?>
			<?php echo form_open('frota/adicionar');?>
			<div class="form-group">
				<label for="modelo" class="col-sm-2 control-label">Modelo </label>
				<select class="form-control" name="modelo" id="modelo" required>
					<?php foreach ($modelos as $modelo): ?>
						<option value="<?php echo $modelo->id; ?>"><?php echo $modelo->nome; ?></option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('modelo'); ?>
			</div>

			<div class="form-group">
				<label for="cor" class="col-sm-2 control-label">Cor </label>
				<select class="form-control" name="cor" id="cor" required>
					<?php foreach ($cores as $cor): ?>
						<option   value="<?php echo $cor->id; ?>"><?php echo $cor->nome; ?></option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('cor'); ?>
			</div>

			<div class="form-group">
				<label for="matricula">Matricula </label>
				<input type="text" class="form-control" id="matricula" name="matricula" placeholder="AA-00-AA" maxlength="8" required>
				<?php echo form_error('matricula'); ?>
			</div>

			<div class="col-md-6 col-md-offset-3">

			<div class="form-group">
				<label class="radio-inline">
					<input type="radio" name="estado" id="estado" value="1">Disponível
				</label>
				<label class="radio-inline">
					<input type="radio" name="estado" id="estado" value="0">Ocupado
				</label>
				<?php echo form_error('estado'); ?>
			</div>

			<div class="form-group">
				<a href="<?php echo base_url("frota/pesquisa") ?>" class="btn btn-warning">Cancelar</a>
				<button type="submit" class="btn btn-primary form-inline">Guardar</button>
			</div>

			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>


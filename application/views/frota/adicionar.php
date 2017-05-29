<div class="container">
	<div class="row">
		<?php var_dump($auto?? false) ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo validation_errors(); ?>
			<?php echo form_open('frota/escrita');?>
			
			<div class="form-group">
				<label for="modelo" class="col-sm-2 control-label">Modelo </label>
				<select class="form-control" name="modelo" id="modelo" required>
					<option value="" disabled selected> -- Escolha uma opção -- </option>
					<?php foreach ($modelos as $modelo): ?>
						<option <?php echo set_select('modelo', $auto->modelo_id, ($modelo->id == $auto->modelo_id)); ?> value="<?php echo $modelo->id; ?>">
							<?php echo $modelo->nome; ?>
						</option>
					<?php endforeach ?>
				</select>
				<?php echo form_error('modelo'); ?>
			</div>

			<div class="form-group">
				<label for="cor" class="col-sm-2 control-label">Cor </label>
				<select class="form-control" name="cor" id="cor" required>
					<option value="" disabled selected> -- Escolha uma opção -- </option>
					<?php foreach ($cores as $cor): ?>
						<option <?php echo set_select('cor',$auto->cor_id, ($cor->id == $auto->cor_id)); ?> value="<?php echo $cor->id; ?>"> 
							<?php echo $cor->nome; ?>
						</option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('cor'); ?>
			</div>

			<div class="form-group">
				<label for="matricula">Matricula </label>
				<input value="<?php echo $auto->matricula ?>" type="text" class="form-control" id="matricula" name="matricula" placeholder="AA-00-99" maxlength="8" required>
				<?php echo form_error('matricula'); ?>
			</div>

			<div class="col-md-6 col-md-offset-3">

				<div class="form-group">
					<label class="radio-inline">
						<input type="radio" name="estado" id="d" value="1">Disponível
					</label>
					<label class="radio-inline">
						<input type="radio" name="estado" id="o" value="0">Ocupado
					</label>
					<?php echo form_error('estado'); ?>
				</div>

				<div class="form-group">
					<a href="<?php echo base_url("frota/pesquisa") ?>" class="btn btn-warning">Cancelar</a>
					<button type="submit" class="btn btn-primary form-inline">Guardar</button>
				</div>
				<?php if (!is_null($auto->id)): ?>
					<input type="hidden" name="id" value="<?php echo $auto->id ?>">
				<?php endif ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- Fonte:https://github.com/firstopinion/formatter.js/ -->
<script src="<?php echo base_url('/assets/js/formatter.min.js')?>"></script>
<script>
	new Formatter(document.getElementById('matricula'), {
		'pattern': '{{**}}-{{99}}-{{**}}'
	});
</script>
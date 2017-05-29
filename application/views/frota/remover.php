<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="container">
			<h1>Apagar</h1><br>
			<?php echo validation_errors(); ?>
			<?php echo form_open('frota/remover');?>

			<div class="form-group">
				<label for="modelo" class="col-sm-2 control-label">Modelo:</label><?php echo $auto->modelo_id; ?>
				<?php echo $auto->matricula; ?>
				<?php echo $auto->modelo_id; ?> 
				<?php echo $auto->cor_id; ?> 

			</div>

			<div class="form-group">
				<a href="<?php echo base_url("frota/pesquisa") ?>" class="btn btn-warning">Não</a>
				<button type="submit" class="btn btn-primary form-inline">Sim</button>
			</div>
			<?php if (!is_null($auto->id)): ?>
				<input type="hidden" name="id" value="<?php echo $auto->id ?>">
			<?php endif ?>
		</div>

		<?php echo form_close(); ?>

	</div>
</div>
</div>

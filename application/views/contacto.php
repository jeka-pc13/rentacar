<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<img src="http://placehold.it/1700x700" alt="imagem X" width="1700" height="700" class="img-responsive thumbnail">
		</div>
	</div>

	<div class="row">
		<div class="col-md-4 col-md-offset-2">
			Super Mapa:

			<img src="http://placehold.it/850x450" alt="imagem X" width="850" height="450" class="img-responsive">
		</div>

		<div class="col-md-4">
			<div class="msg">
				<?php if (isset($message_display)): ?>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Envio da Mensagem</h3>
						</div>
						<div class="panel-body">
							<?php echo $message_display ?>
						</div>
					</div>
				<?php endif ?>

			</div>

			<!-- <form class="form-horizontal"> -->
			<?php
			$atributos = array(
				'class'=>"form-horizontal",
				'method' => 'POST'
				);
			echo form_open('publico/send_mail', $atributos);
			?>
			<fieldset>
				<legend>Formulario de contacto</legend>

				<div class="form-group">
					<label for="nome" class="col-lg-2 control-label">Nome</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="nome" placeholder="nome" name="nome">
					</div>
					<?php echo form_error('nome'); ?>
				</div>

				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="email" class="form-control" id="email" placeholder="Email" name="email">
					</div>
					<?php echo form_error('email'); ?>
				</div>	


				<div class="form-group">
					<label for="mensagem" class="col-lg-2 control-label">Mensagem</label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="mensagem" name="mensagem" placeholder="Escreva a sua mensagem"></textarea><?php echo form_error('mensagem'); ?>	
					</div>
					
				</div>

				<div class="form-group">
					<div class="g-recaptcha col-lg-10 col-lg-offset-2" data-sitekey="6LehOiMUAAAAAIvumKqyJUO2MNOPmDuCnmT-3GhL"></div>
				</div>

				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</fieldset>
			<?php echo form_close(); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 well">
			Super Painel com redes sociais
		</div>
		
	</div>
</div>
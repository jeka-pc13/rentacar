<div class="container-fluid conteudo">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 img-responsive">
			
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3358.281345157826!2d-17.059589572933547!3d32.678563316649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-PT!2spt!4v1496131131897" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="msg">
				<?php if ($this->session->has_userdata("event")):?>
					<div class="alert alert-dismissible alert-info">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $this->session->event?>
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
						<?php echo form_error('nome'); ?>
					</div>
					
				</div>

				<div class="form-group">
					<label for="email" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="email" class="form-control" id="email" placeholder="Email" name="email">
						<?php echo form_error('email'); ?>
					</div>
				</div>	


				<div class="form-group">
					<label for="mensagem" class="col-lg-2 control-label">Mensagem</label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="mensagem" name="mensagem" placeholder="Escreva a sua mensagem"></textarea>
						<?php echo form_error('mensagem'); ?>	
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
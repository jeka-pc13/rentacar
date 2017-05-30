
<body>
	<div class="main">
		<div id="content conteudo">
			<h2 id="form_head">Codelgniter Email</h2>
			<div id="form_input">
				<div class="msg">
					<?php
					if (isset($message_display)) {
						echo $message_display;
					}
					?>
				</div>
				<?php
				echo '<div class="error_msg">';
				echo validation_errors();
				echo "</div>";
				echo form_open('publico/send_mail');
				echo form_label('Email-ID');
				echo "<div class='all_input'>";
				$data_email = array(
					'type' => 'email',
					'name' => 'user_email',
					'id' => 'e_email_id',
					'class' => 'input_box',
					'placeholder' => 'Please Enter Email'
					);
				echo form_input($data_email);
				echo "</div>";
				echo form_label('Password');
				echo "<div class='all_input'>";
				$data_password = array(
					'name' => 'user_password',
					'id' => 'password_id',
					'class' => 'input_box',
					'placeholder' => 'Please Enter Password'
					);
				echo form_password($data_password);
				echo "</div>";
				echo form_label('Name');
				echo "<div class='all_input'>";
				$data_email = array(
					'name' => 'name',
					'class' => 'input_box',
					'placeholder' => 'Please Enter Name'
					);
				echo form_input($data_email);
				echo "</div>";
				echo form_label('To');
				echo "<div class='all_input'>";
				$data_email = array(
					'type' => 'email',
					'name' => 'to_email',
					'class' => 'input_box',
					'placeholder' => 'Please Enter Email'
					);
				echo form_input($data_email);
				echo "</div>";
				echo form_label('Subject');
				echo "<div class='all_input'>";
				$data_subject = array(
					'name' => 'subject',
					'class' => 'input_box',
					);
				echo form_input($data_subject);
				echo "</div>";
				echo form_label('Message');
				echo "<div class='all_input'>";
				$data_message = array(
					'name' => 'message',
					'rows' => 5,
					'cols' => 32
					);
				echo form_textarea($data_message);
				echo "</div>";
				?>
			</div>
			<div id="form_button">
				<?php echo form_submit('submit', 'Send', "class='submit'"); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</body>

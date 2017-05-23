	
<div class="container-fluid">
	<div class="panel">

		<?php 
		$attributes = array(
			'id' => 'form-new-book',
			'method' => 'POST'
			);
		echo form_open('books/create', $attributes);
    //echo validation_errors();
		?>
		

		<div class="form-group">
			<label for="title">Titulo</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Titulo do livro">
			<?php echo form_error('title'); ?>
		</div>

		<div class="form-group">
			<label for="isbn">ISBN</label>
			<input type="text" class="form-control" id="isbn" name="isbn" placeholder="XXXXXXXXXXXX-X">
			<?php echo form_error('isbn'); ?>
		</div>


		<div class="form-group">
			<label for="data_publicacao">Data da visita</label>
			<input type="text" class="form-control" id="data_publicacao" name="data_publicacao" >
			<?php echo form_error('data_publicacao'); ?>
		</div>

		<div class="form-group">
			<label for="authors" class="col-sm-2 control-label">Autor</label>
			<select multiple class="form-control" name="authors[]" id="author" required>
				<?php foreach ($authors as $author): ?>
					<option  <?php echo set_select('authors[]', $author->idautor); ?> value="<?php echo $author->idautor; ?>"><?php echo $author->nome; ?></option>
				<?php endforeach ?>
			</select>
			<?php echo form_error('authors'); ?>		
		</div>

		<div class="form-group">
			<label for="editoras" class="col-sm-2 control-label">Editora</label>
			<select class="form-control" name="editoras" id="editora" required>
				<?php foreach ($editoras as $editora): ?>
					<option value="<?php echo $editora->ideditora ?>"><?php echo $editora->nome; ?></option>
				<?php endforeach ?>
			</select>
			<?php echo form_error('editoras'); ?>			
		</div>

		<button type="submit" class="btn btn-success">Save</button>
	</form>
</div>
</div>

<script >
	$( function(){
		$('#form-new-book').submit(function(e) {
			e.preventDefault(); 
			var formDataa = new FormData($('#form-new-book'));
			$.ajax({
				type : "POST",
				dataType:'json',
				data : $( "#form-new-book" ).serialize(),
				url: '<?php echo base_url("books/createAjax/")?>', 
				cache : false,
				success : function(response){
					if(!response.success){
						$("#create-book .modal-body").html(response.html);
					}else{
						$('#create-book').modal('toggle');
						$('#form-new-book').trigger('reset');
					}
				}
			});        
			return false; 
		});
	});
</script>
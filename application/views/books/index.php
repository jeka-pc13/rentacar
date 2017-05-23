<div class="container">
  <div class="panel">
    <?php 
    $options = array(
      "class" => "form-inline", 
      "method" => "GET");
    echo form_open('books/', $options);

    $data = array(
      "id" => "title",
      "name" => "title",
      "value" => $title,
      "placeholder" => 'Titulo do livro',
      "class" => "form-control form-search-title"
      );
      ?>
      <div class="form-group col-md-4">
        <?php  echo form_label("Titulo","title", array ("class"=>"col-md-3"));?>
        <?php  echo form_input($data);?>
      </div>
      <?php 
      $data = array(
        "id" => "author",
        "name" => "author",
        "value" => $author,
        "placeholder" => 'Autor do livro',
        "class" => "form-control form-search-author"
        ); 
        ?>
        <div class="form-group col-md-4">
         <?php  echo form_label("Autor","author", array ("class"=>"col-md-3"));?>
         <?php  echo form_input($data);?>
       </div>

       <button type="submit" class="btn btn-primary">Search</button>
       <a type="submit" href="<?php echo base_url("books/create"); ?>" class="btn btn-primary">+Add</a>
       <!-- Trigger the modal with a button -->
       <button type="button" class="btn btn-info " data-toggle="modal" data-target="#create-book">+Add Modal</button>
     </div>
     <?php echo form_close(); ?>


     <h2>Book list <small><?php echo $search_results_count; ?> </small></h2>       
     <div class="panel">
      <table class="table table-striped table-bordered  table-hover">
        <thead>
          <tr class="info">
            <th>id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Published</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($search_results as $livro) : ?>
            <tr>
              <td><?php echo $livro->idlivro;?></td> 
              <td><?php echo $livro->titulo;?></td>
              <td><span class="label label-default"><?php echo $livro->nome;?></span></td>
              <td><?php echo $livro->data_publicacao;?></td>
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



  <  <!-- Modal -->
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

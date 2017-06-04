<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Librería Básica</title>
  <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 </head>
 <body>


  <div class="container">
   <h1><center>Librería Básica</center></h1>
  </center>
  <h3><center>Almacenar Libros</center></h3>
  <br />
  <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i>Añadir Libro</button>
  <br />
  <br />
  <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
    <tr>

     <th>IDENTIFICADOR </th>
     <th>ISBN LIBRO</th>
     <th>TITULO DEL LIBRO </th>
     <th>AUTOR DEL LIBRO</th>
     <th>CATEGORÍA DEL LIBRO</th>

     <th style="width:125px;">Action
      </p></th>
    </tr>
   </thead>
   <tbody>
       <?php foreach ($books as $book) { ?>
        <tr>
         <td><?php echo $book->book_id; ?></td>
         <td><?php echo $book->book_isbn; ?></td>
         <td><?php echo $book->book_title; ?></td>
         <td><?php echo $book->book_author; ?></td>
         <td><?php echo $book->book_category; ?></td>
         <td>
          <button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id; ?>)">
           <i class="glyphicon glyphicon-pencil"></i>
          </button>
          <button class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id; ?>)">
           <i class="glyphicon glyphicon-remove"></i>
          </button>
         </td>
        </tr>
    <?php } ?>
   </tbody>

   <tfoot>
    <tr>
     <th>IDENTIFICADOR </th>
     <th>ISBN LIBRO</th>
     <th>TITULO DEL LIBRO </th>
     <th>AUTOR DEL LIBRO</th>
     <th>CATEGORÍA DEL LIBRO</th>
     <th>ACCION</th>

    </tr>
   </tfoot>
  </table>

 </div>

 <script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js') ?>"></script>
 <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js') ?>"></script>
 <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js') ?>"></script>
 <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js') ?>"></script>


 <script type="text/javascript">
     
//     Funcion para ordenar la tabla
          $(document).ready(function () {
              $('#table_id').DataTable();
          });

// Variable global
          var save_method; //for save method string
          var table;


          function add_book()
          {
              save_method = 'add';
              $('#form')[0].reset(); // Borra todos los datos del formulario
              $('#modal_form').modal('show'); // show bootstrap modal
              //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
          }

          function edit_book(id)
          {
              save_method = 'update';
              $('#form')[0].reset(); // Borra todos los datos del formulario

              //Ajax Load data from ajax
              $.ajax({
                  url: "<?php echo site_url('index.php/book/ajax_edit/') ?>/" + id,
                  type: "GET",
                  dataType: "JSON",
                  success: function (data) // data -> datos que vienen de la bd del controlador
                  {
//                      Coge el valor del identificador
                      $('[name="book_id"]').val(data.book_id);
                      $('[name="book_isbn"]').val(data.book_isbn);
                      $('[name="book_title"]').val(data.book_title);
                      $('[name="book_author"]').val(data.book_author);
                      $('[name="book_category"]').val(data.book_category);

                      $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                      $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error get data from ajax');
                  }
              });
          }

          function save()
          {
              var url;
              if (save_method == 'add')
              {
                  url = "<?php echo site_url('index.php/book/book_add') ?>";
              } else
              {
                  url = "<?php echo site_url('index.php/book/book_update') ?>";
              }

              // ajax adding data to database
              $.ajax({
                  url: url,
                  type: "POST",
                  data: $('#form').serialize(), // preformatea los datos del formulario
                  dataType: "JSON",
                  success: function (data)
                  {
                      //if success close modal and reload ajax table
                      $('#modal_form').modal('hide');
                      location.reload();// for reload a page
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error al añadir los datos / actualizar los datos de la libreria');
                  }
              });
          }

          function delete_book(id)
          {
              if (confirm('Estas seguro de borrar los datos?'))
              {
                  // ajax delete data from database
                  $.ajax({
                      url: "<?php echo site_url('index.php/book/book_delete') ?>/" + id,
                      type: "POST",
                      dataType: "JSON",
                      success: function (data)
                      {
                          location.reload();
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error al borrar los datos');
                      }
                  });

              }
          }
 </script>

 <!-- Bootstrap modal -->
 <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
     <h3 class="modal-title">Book Form</h3>
    </div>
    <div class="modal-body form">
     <form action="#" id="form" class="form-horizontal">
      <input type="hidden" value="" name="book_id"/>
      <div class="form-body">
       <div class="form-group">
        <label class="control-label col-md-3">Book ISBN</label>
        <div class="col-md-9">
         <input name="book_isbn" placeholder="Book ISBN" class="form-control" type="text">
        </div>
       </div>
       <div class="form-group">
        <label class="control-label col-md-3">Book Title</label>
        <div class="col-md-9">
         <input name="book_title" placeholder="Book_title" class="form-control" type="text">
        </div>
       </div>
       <div class="form-group">
        <label class="control-label col-md-3">Book Author</label>
        <div class="col-md-9">
         <input name="book_author" placeholder="Book Author" class="form-control" type="text">

        </div>
       </div>
       <div class="form-group">
        <label class="control-label col-md-3">Book Category</label>
        <div class="col-md-9">
         <input name="book_category" placeholder="Book Category" class="form-control" type="text">

        </div>
       </div>

      </div>
     </form>
    </div>
    <div class="modal-footer">
     <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
   </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 <!-- End Bootstrap modal -->

</body>
</html>

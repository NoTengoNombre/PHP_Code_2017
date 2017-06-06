<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Bienvenido a la biblioteca</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">


 </head>
 <body>

  <span style="background-color:red;">
   <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
     <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
      <div class="login-panel panel panel-success">
       <div class="panel-heading">
        <h3 class="panel-title"><center>Formulario de Registro</center></h3>
       </div>
       <div class="panel-body">

        <?php
        $error_msg = $this->session->flashdata('error_msg');
        if ($error_msg) {
            echo $error_msg;
        }
        ?>

        <form role="form" method="post" action="<?php echo base_url('user/register_user'); ?>">
         <fieldset>
          <div class="form-group">
           <input class="form-control" name="user_name" type="text" placeholder="Nombre de Usuario" autofocus >
          </div>

          <div class="form-group">
           <input class="form-control" name="user_email" type="email" placeholder="E-mail" autofocus>
          </div>
          <div class="form-group">
           <input class="form-control" name="user_password" type="password" value="" placeholder="Contraseña">
          </div>

          <div class="form-group">
           <input class="form-control" name="user_mobile" type="number" value="" placeholder="Telefono">
          </div>

          <input class="btn btn-lg btn-success btn-block" type="submit" value="Registrate" name="register" >

         </fieldset>
        </form>
        <center><b>¿ Esta Registrado ?</b> <br></b><a href="<?php echo base_url('user/login_view'); ?>">Logueate Aquí</a></center>
       </div>
      </div>
     </div>
    </div>
   </div>





  </span>




 </body>
</html>

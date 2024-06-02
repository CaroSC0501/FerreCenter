<?php 
include ("../../bd.php");
if($_POST){

    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
 
    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` (`ID`,`usuario`, `correo`, `password`) 
      VALUES (NULL, :usuario, :correo, :password);");

      $sentencia->bindParam(":usuario",$usuario);
      $sentencia->bindParam(":correo",$correo);
      $sentencia->bindParam(":password",$password);
      $sentencia->execute();

      $sentencia->execute();
      $mensaje="Registro agregado con exito.";
      header("location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php"); 


?>


<div class="card">
    <div class="card-header">Usuario</div>
    <div class="card-body">
    <form action="" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre del Usuario</label>
            <input
                type="text"
                class="form-control"
                name="usuario"
                id="usuario"
                aria-describedby="helpId"
                placeholder="usuario"
            />
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                aria-describedby="helpId"
                placeholder="password"
            />
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Correo</label>
            <input
                type="email"
                class="form-control"
                name="correo"
                id="correo"
                aria-describedby="helpId"
                placeholder="correo"
            />
        <br>  
        <button
            type="submit"
            class="btn btn-success"> 
            Agregar
        </button>
      
        <a
            class="btn btn-primary"
            href="index.php"
            role="button"
            >Cancelar</a
        >

        </div>
        
    </form>
    </div>  
</div>

<?php include("../../templates/footer.php"); ?>

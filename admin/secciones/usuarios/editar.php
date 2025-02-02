<?php 

include ("../../bd.php");

if (isset($_GET['txtID'])){
    
    //recuperar los datos de ID seleccionado
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();


    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $usuario=$registro['usuario'];
    $correo=$registro['correo'];
    $password=$registro['password'];
}

if ($_POST){
    print_r($_POST);
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $contraseña=(isset($_POST['password']))?$_POST['password']:"";

     $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, correo=:correo, password=:password
     WHERE id=:id");
    
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":id",$txtID);
  
    $sentencia->execute();
    $mensaje="Registro modificado con exito.";
    header("location:index.php?mensaje=".$mensaje);

        $sentencia=$conexion->prepare("UPDATE tbl_usuarios  
        SET usuario=:usuario, correo=:correo, password=:password WHERE id=:id");

        $sentencia->bindParam(":usuario,$usuario");
        $sentencia->bindParam(":correo,$correo");
        $sentencia->bindParam(":password,$password");
        $sentencia->bindParam(":id,$txtID");
        $sentencia->execute();

        $mensaje="Registro modificado con exito.";
        header("location:index.php?mensaje=".$mensaje);

      }
    


include("../../templates/header.php"); 


?>


<form action="" method="post">

<div class="mb-3">
    <label for="txtID" class="form-label">ID</label>
    <input
        readonly
        type="text"
        class="form-control"
        value="<?php echo $txtID;?>"
        name="txtID"
        id="txtID"
        aria-describedby="helpId"
        placeholder=""
    />
    
</div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre del Usuario</label>
            <input
                value="<?php echo $usuario;?>"
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
                value="<?php echo $password;?>"
                type="password"
                class="form-control"
                name="password"
                id="password"
                aria-describedby="helpId"
                placeholder="password"
            />
        </div>
        
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input
                value="<?php echo $correo;?>"
                type="correo"
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
            Actualizar
        </button>
      
        <a
            class="btn btn-primary"
            href="index.php"
            role="button"
            >Cancelar</a
        >

        </div>
        
    </form>


<?php include("../../templates/footer.php"); ?>

<?php 

include ("../../bd.php");

if($_POST){

    $nombreConfiguracion=(isset($_POST['nombreConfiguracion']))?$_POST['nombreConfiguracion']:"";
    $valor=(isset($_POST["valor"]))?$_POST["valor"]:"";
   
    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_configuraciones` (`ID`, `nombreConfiguracion`, `valor`) 
      VALUES (NULL, :nombreConfiguracion, :valor );");

      $sentencia->bindParam(":nombreConfiguracion",$nombreConfiguracion);
      $sentencia->bindParam(":valor",$valor);
      $sentencia->execute();

      $mensaje="Registro agregado con exito.";
      header("location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">Configuración</div>
    <div class="card-body">
       <form action="" method="post">
        
        <div class="mb-3">
            <label for="nombreConfiguracion" class="form-label">Nombre:</label>
            <input
                type="text"
                class="form-control"
                name="nombreConfiguracion"
                id="nombreConfiguracion"
                aria-describedby="helpId"
                placeholder="Nombre de la configuración"
            />
        </div>
        
        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <input
                type="text"
                class="form-control"
                name="valor"
                id="valor"
                aria-describedby="helpId"
                placeholder="valor"
            />
           
        </div>
        
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

       </form>
    </div>
    
</div>



<?php include("../../templates/footer.php"); ?>

<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){
    
    //recuperar los datos de ID seleccionado
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();


    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombreConfiguracion=$registro['nombreConfiguracion'];
    $valor=$registro['valor'];

}

if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombreConfiguracion=(isset($_POST['nombreConfiguracion']))?$_POST['nombreConfiguracion']:"";
    $valor=(isset($_POST["valor"]))?$_POST["valor"]:"";
   
    
    $sentencia=$conexion->prepare("UPDATE `tbl_configuraciones` 
      SET nombreConfiguracion=:nombreConfiguracion, valor=:valor 
      WHERE ID=:ID;);");

      $sentencia->bindParam(":nombreConfiguracion",$nombreConfiguracion);
      $sentencia->bindParam(":valor",$valor);
      $sentencia->bindParam(":ID",$txtID);
      $sentencia->execute();

    $mensaje="Registro modificado con exito,";
    header("location:index.php?mensaje=".$mensaje);

}
    

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">Configuración</div>
    <div class="card-body">
       <form action="" method="post">
        
       <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <input
                readonly
                value="<?php echo $txtID;?>"
                type="text"
                class="form-control"
                name="txtID"
                id="txtID"
                aria-describedby="helpId"
                placeholder="ID"
            />
        </div>

        <div class="mb-3">
            <label for="nombreConfiguracion" class="form-label">Nombre:</label>
            <input
                value="<?php echo $nombreConfiguracion;?>"
                type="text"
                class="form-control"
                name="nombreConfiguracion"
                id="nombreConfiguracion"
                aria-describedby="helpId"
                placeholder="Nombre de la Configuración"
            />
        </div>
        
        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <input 
                value="<?php echo $valor;?>"
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
            Actualizar
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

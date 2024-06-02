<?php 
include ("../../bd.php");
if($_POST){

    $Icono=(isset($_FILES["Icono"]["name"]))?$_FILES["Icono"]["name"]:"";
    $Titulo=(isset($_POST['Titulo']))?$_POST['Titulo']:"";
    $Precio=(isset($_POST['Precio']))?$_POST['Precio']:"";
 
    $fechaIcono=new DateTime();
    $nombreArchivo=($Icono!="")? $fechaIcono->getTimestamp()."_".$Icono:"";
    $tempIcono=$_FILES["Icono"]["tmp_name"];
    if($tempIcono!=""){
      move_uploaded_file($tempIcono,"../../../assets/img/servicios/".$nombreArchivo);
    }
    $sentencia=$conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `Icono`, `Titulo`, `Precio`) 
      VALUES (NULL, :Icono, :Titulo, :Precio);");

      $sentencia->bindParam(":Icono",$nombreArchivo);
      $sentencia->bindParam(":Titulo",$Titulo);
      $sentencia->bindParam(":Precio",$Precio);

      $sentencia->execute();
      $mensaje="Registro agregado con exito.";
      header("location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php"); 
?>

<div class="card">

    <div class="card-header">Productos</div>
    
    <div class="card-body">
      <form action="" enctype="multipart/form-data" method="post">
    
      <div class="mb-3">
        <label for="Icono" class="form-label">Icono:</label>
        <input
          type="file"
          class="form-control"
          name="Icono"
          ID="Icono"
          placeholder="Icono"
          aria-describedby="fileHelpId"
        />
       
      </div>
      
      </div>
      
      <div class="mb-3">
        <label for="Titulo" class="form-label">Titulo:</label>
        <input
            type="text"
            class="form-control"
            name="Titulo"
            ID="Titulo"
            aria-describedby="helpId"
            placeholder="Titulo"
        />
      </div>
      
      <div class="mb-3">
        <label for="Precio" class="form-label">Precio:</label>
        <input
            type="number"
            class="form-control"
            name="Precio"
            ID="Precio"
            aria-describeddby="helpId"
            placeholder="Precio"
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

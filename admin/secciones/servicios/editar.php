<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){
    
    //recuperar los datos de ID seleccionado
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_servicios WHERE ID=:ID");
    $sentencia->bindParam(":ID",$txtID);
    $sentencia->execute();


    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $Icono=$registro['Icono'];
    $Titulo=$registro['Titulo'];
    $Precio=$registro['Precio'];
}

if ($_POST){
    print_r($_POST);
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $Titulo=(isset($_POST['Titulo']))?$_POST['Titulo']:"";
    $Precio=(isset($_POST['Precio']))?$_POST['Precio']:"";
    

     $sentencia=$conexion->prepare("UPDATE tbl_servicios SET Titulo=:Titulo, precio=:Precio
     WHERE ID=:ID");
    
    $sentencia->bindParam(":Titulo",$Titulo);
    $sentencia->bindParam(":Precio",$Precio);
    $sentencia->bindParam(":ID",$txtID);
  
    $sentencia->execute();
    $mensaje="Registro modificado con exito";
    header("location:index.php?mensaje=".$mensaje);

    if($_FILES["Icono"]["name"]!=""){
        $Icono=(isset($_FILES["Icono"]["name"]))?$_FILES['Icono']["name"]:"";
        $fechaIcono=new DateTime();
        $nombreArchivo=($Icono!="")? $fechaIcono->getTimestamp()."_".$Icono:"";
       
        $tempIcono=$_FILES["Icono"]["tmp_name"];
        if($tempIcono!=""){
          move_uploaded_file($tempIcono,"../../../assets/img/servicios/".$nombreArchivo);
        }

        //borrado del archivo anterior
        $sentencia=$conexion->prepare("SELECT Icono FROM tbl_servicios WHERE ID=:ID");
        $sentencia->bindParam(":ID",$txtID);
        $sentencia->execute();
        $registroIcono=$sentencia->fetch(PDO::FETCH_LAZY);
        if(isset($registroIcono["Icono"])){
          if(file_exists("../../../assets/img/servicios/".$registroIcono["Icono"])){
             unlink("../../../assets/img/servicios/".$registroIcono["Icono"]);
        }
      }

        $sentencia=$conexion->prepare("UPDATE tbl_servicios  
        SET Icono=:Icono WHERE ID=:ID");

        $sentencia->bindParam(":Icono",$nombreArchivo);
        $sentencia->bindParam(":ID",$txtID);
        $sentencia->execute(); 
      }
    
  }

include("../../templates/header.php"); ?>


<div class="card">

    <div class="card-header">Editando la infomación de servicios</div>
    
    <div class="card-body">
      <form action="" enctype="multipart/form-data" method="post">
    

        <div class="mb-3">
            <label  for="txtID" class="form-label">ID:</label>
            <input
                readonly
                value="<?php echo $txtID;?>"
                type="text"
                class="form-control"
                name="txtID"
                ID="txtID"
                aria-describedby="helpId"
                placeholder="ID"
            />
           
        </div>
        

      <div class="mb-3">
        <label  for="Icono" class="form-label">Icono: </label>
        <img wIDth="50" src="../../../assets/img/servicios/<?php echo $Icono;?>"/> 
        <input
            type="file"
            class="form-control"
            name="Icono"
            ID="Icono"
            aria-describedby="helpId"
            placeholder="Icono"
        />
          
      </div>
      
      <div class="mb-3">
        <label  for="Titulo" class="form-label">Titulo:</label>
        <input
            value="<?php echo $Titulo;?>"
            type="text"
            class="form-control"
            name="Titulo"
            ID="Titulo"
            aria-describedby="helpId"
            placeholder="Titulo"
        />
      </div>
      
      <div class="mb-3">
        <label  for="Precio" class="form-label">Precio:</label>
        <input
            value="<?php echo $Precio;?>"
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
        href="index.php"
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

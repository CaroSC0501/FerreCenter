<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT Icono FROM tbl_servicios WHERE ID=:ID");
    $sentencia->bindParam(":ID",$txtID);
    $sentencia->execute();
    $registroIcono=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registroIcono["Icono"])){
        if(file_exists("../../../assets/img/servicios/". $registroIcono["Icono"])){
            unlink("../../../assets/img/servicios/".$registroIcono["Icono"]);
        }

    }

    $sentencia=$conexion->prepare("DELETE FROM tbl_servicios WHERE ID=:ID");
    $sentencia->bindParam(":ID",$txtID);
    $sentencia->execute();

}
//seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();

$listaServicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
        <a
            name=""
            ID=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Registros</a
        >
        
    </div>

    <div class="card-body">
        
    <div
        class="table-responsive-sm"
    >
        <table
            class="table"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Icono</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaServicios as $registros){ ?>

               
                <tr class="">
                    <td scope="col"><?php echo $registros ['ID'];?></td>
                    <td scope="col"><img wIDth="50" src="../../../assets/img/servicios/<?php echo $registros ['Icono'];?>"/></td>
                    <td scope="col"><?php echo $registros ['Titulo'];?></td>
                    <td scope="col"><?php echo $registros ['Precio'];?></td>
                    <td>
                        <a
                            name=""
                            ID=""
                            class="btn btn-info"
                            href="editar.php?txtID=<?php echo $registros['ID']; ?>"
                            role="button"
                            >Editar</a
                        >

                        <a
                            name=""
                            ID=""
                            class="btn btn-danger"
                            href="index.php?txtID=<?php echo $registros['ID']; ?>"
                            role="button"
                            >Eliminar</a
                        >
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    </div>
    
</div>
<?php include("../../templates/footer.php"); ?>
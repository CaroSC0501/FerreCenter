<?php 
include ("../../bd.php");

if (isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}


//seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();

$listaconfiguraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header"><div class="card-header">
        <!-- <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Registros</a
        > -->
        Configuración
        
        <div
            class="table-responsive-sm"
        >
            <table
                class="table"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de la configuración</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listaconfiguraciones as $registros){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $registros ['ID'];?></td>
                        <td><?php echo $registros ['nombreConfiguracion'];?></td>
                        <td><?php echo $registros ['valor'];?></td>
                        <td>
                        <a
                            name=""
                            id=""
                            class="btn btn-info"
                            href="editar.php?txtID=<?php echo $registros['ID']; ?>"
                            role="button"
                            >Editar</a
                        >

                        <!-- <a
                            name=""
                            id=""
                            class="btn btn-danger"
                            href="index.php?txtID=<?php echo $registros['ID']; ?>"
                            role="button"
                            >Eliminar</a
                        >  -->
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
    <div class="card-body">
        
    </div>
</div>


<?php include("../../templates/footer.php"); ?>
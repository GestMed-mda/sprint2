<?php
include_once "lib.php";

$id=$_GET['id'];

$query = DB::execute_sql("SELECT id,idmedico,idpaciente,texto FROM antpersonal WHERE idpaciente=?", array($id));
$query->setFetchMode(PDO::FETCH_NAMED);
$tabla = $query->fetchAll(); // No sé por qué se pone, pero funciona sin esto también


if(count($tabla)){
    echo "<table id='tabla'>";
    echo "<a href='AddHistorial.php?value=4&id=$id'><button type='button' class='btn btn-success'><i class='glyphicon glyphicon-plus'></icon>Añadir antecedente personal</button></a>";
    foreach ($tabla as $row) {
        echo "<tr>";
        foreach ($row as $field => $value) {
            if($field == 'id'){
                $idoperacion=$value;
            }
            if($field == 'idmedico'){
                $medico=$value;
            }
            if($field == 'texto'){
                echo "<td>$value</td>";
                if($medico==User::getLoggedUser()['DNI']){
                    echo "<td><a style='margin-left: 5px' href='editHistorial.php?metodo=4&id=$id&idoperacion=$idoperacion'><button style=' border-radius: 50px' type='button' class='btn btn-info'><i class='glyphicon glyphicon-pencil'></icon></button></a></td> ";
                    echo "<td><a style='margin-left: 7px;' href='#' class='delete' data-id='$id' data-metodo='4' data-idoperacion='$idoperacion'><button type='button' class='btn btn-danger'><i class='glyphicon glyphicon-trash'></icon></button></a></td> ";
                }
            }
        }
        echo "</tr>";
    }

    echo "</table>";
}else {
    echo "<a href='AddHistorial.php?value=4&id=$id'><button type='button' class='btn btn-success'><i class='glyphicon glyphicon-plus'></icon>Añadir antecedente personal</button></a>";
}




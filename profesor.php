<?php

session_start();
$actuar = false;
if($_SESSION['eleccion']==="profesor"){
    if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $actuar = true;
    }
}else{
    header("Location: index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" name="accion" action="#">
            <input type="submit" name="submit" value="alumnos">
            <input type="submit" name="submit" value="empresas">
            <input type="submit" name="submit" value="asignar">
        </form>
        <?php
            if($actuar){
               $link = mysqli_connect("localhost", "root", "", "scrum");
               mysqli_set_charset($link, "utf8");
                switch ($_POST['submit']) {
                    case "alumnos":
                        $query = mysqli_query($link, "SELECT nombre, localidad, contratacion, empresa FROM alumnos");
                        foreach ($query as $key => $value) {
                            echo "Nombre: ".$value['nombre']."</br>";
                            echo "Localidad: ".$value['localidad']."</br>";
                            if($value['contratacion']!=NULL){
                                if($value['contratacion']){
                                    echo "El alumno prefiere ser contratado</br>";
                                }else{
                                    echo "El alumno no quiere ser contratado</br>";
                                }
                            }else{
                                echo "Al alumno le es indiferente ser contratado</br>";
                            }
                            if($value['empresa']!=NULL){
                        $query2 = mysqli_query($link, "SELECT nombre FROM empresas WHERE id = ".$value['empresa']);
                        foreach ($query2 as $key2 => $value2) {
                             echo "Este alumno tiene asignada la empresa ".$value2['nombre'];
                            }
                            
                        }else{
                             echo "Este alumno no tiene empresa asignada";
                            }
                            echo "</br>";
                            echo "</br>";
                         }
                        break;
                    case "empresas":
                        $query = mysqli_query($link, "SELECT nombre, localidad, contratan FROM empresas");
                        foreach ($query as $key => $value) {
                            echo "Nombre: ".$value['nombre']."</br>";
                            echo "Localidad: ".$value['localidad']."</br>";
                            if($value['contratan']){
                                echo "Esta empresa tiende a contratar";
                            }else{
                                echo "Esta empresa no tiende a contratar";
                            }
                            echo "</br>";
                        }
                        break;
                    case "asignar":
                      $query = mysqli_query($link, "SELECT nombre, localidad, contratacion, empresa FROM alumnos");
                      foreach($query as $key => $value){
                      if(!$value['empresa']){
                          echo "Alumno: ".$value['nombre'];
                          echo"<form method = 'post' action = 'asignar.php'> Solo misma localidad:<input type = 'checkbox' name='coincidencia'> <input type='submit' name='submit' value='".$value['nombre']."'></form>";
                          echo"</br>";
                      }
                      }
                        break;
                    default:
                        echo "Vaya, este es un error muy raro, porfavor intentalo de nuevo o contacta con el administrador del sistema.";
                        break;
                }
            }
        ?>
    </body>
</html>
<?php

session_start();
$actuar = false;
if($_SESSION['eleccion']==="alumno"){
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
            <input type="submit" name="submit" value="Informacion personal">
            <input type="submit" name="submit" value="Ver encuesta">
            <input type="submit" name="submit" value="Ver empresas">

        </form>
        <?php
                if($actuar){
                switch ($_POST['submit']) {
                    case "Informacion personal":

                        break;
                    case "Ver encuesta":
                        $link = mysqli_connect("localhost", "root", "", "scrum");
                        $query = mysqli_query($link, "SELECT empresas.nombre AS nombreE, alumnos.nombre, reviews.texto FROM reviews JOIN empresas ON id_empresa = empresas.id JOIN alumnos ON id_alumno = alumnos.id WHERE esempresa = 0 AND id_alumno = 1");
                        if ($query){
                        foreach ($query as $key => $value) {
                                echo "Alumno: ".$value['nombre']."</br>";
                                echo "Empresa: ".$value['nombreE']."</br>";
                                echo "Comentario: ".$value['texto']."</br></br>";                                
                            }
                        }
                        echo "<form method=get action=InsertarReview.php>Empresa:<input type=text name=empresa></br>Review<input type=text name=texto><input type=submit>";
                        break;
                    case "Ver empresas":

                        break;
                    default:
                        echo "Vaya, este es un error muy raro, porfavor intentalo de nuevo o contacta con el administrador del sistema.";
                        break;
                }
            }
            ?>
    </body>
</html>
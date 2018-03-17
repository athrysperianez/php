<html>
    <head>
        <meta charset="utf8">
    </head> 
<?php

session_start();

if($_SESSION['eleccion']==="profesor" && isset($_POST['submit'])){
    $_SESSION['alumno']=$_POST['submit'];
    $link = mysqli_connect("localhost", "root", "", "scrum");
    mysqli_set_charset($link, "utf8");
    $query = mysqli_query($link, "SELECT * FROM empresas");
    echo "Seleccionar la empresa a asignar al alumno ".$_POST['submit'].":</br>";
    if(isset($_POST['coincidencia'])){
            foreach ($query as $key => $value) {
                if($value['contratan'] == $_POST['coincidencia']){
                echo "<form method='post' action='#'><input type='empresa' name='submit' value='".$value['nombre']."'></form>";
                }
            }
    }else{
        foreach ($query as $key => $value) {
            echo "<form method='get' action='#'><input type='submit' name='submit' value='".$value['nombre']."'></form>";
        }   
    }
}else{
     if(isset($_GET['submit'])){
         $link = mysqli_connect("localhost", "root", "", "scrum");
         echo $_GET['submit'];
         $query2 = mysqli_query($link, "SELECT id FROM empresas WHERE nombre='".$_GET['submit']."'");
         foreach ($query2 as $key => $value2) {
            $insert = mysqli_query($link, "UPDATE `alumnos` SET `empresa`=".$value2['id']." WHERE nombre = '".$_SESSION['alumno']."'");
         }
     }
    $_SESSION['alumno']=NULL;
    header("Location: index.php");
}
?>
</html>

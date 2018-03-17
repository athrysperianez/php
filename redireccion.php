<?php
    
    session_start();
    if(isset($_POST['submit'])){
        $_SESSION['eleccion'] = $_POST['submit'];
       // echo "Sesion iniciada redireccionando";
        header("Location: ".$_POST['submit'].".php");
    }else{
    if(isset($_SESSION['eleccion'])){
        if($_SESSION['eleccion']==="profesor"){
         header("Location: profesor.php"); 
        }else if($_SESSION['eleccion']==="alumno"){
         header("Location: alumno.php"); 
        }else{
        header("Location: index.php");  
        }
     }else{
         header("Location: index.php"); 
     }
     
    }

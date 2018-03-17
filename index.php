<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_SESSION)){
            session_destroy();
        }
        ?>
        <form method="post" name="eleccion" action="redireccion.php">
            <input type="submit" id="profe" name="submit" value="profesor">
            <input type="submit" id="alu" name="submit" value="alumno">
        </form>
    </body>
</html>

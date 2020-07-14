<?php

function conexion() {
    try {
        $con = new PDO('mysql:host=localhost:3306;dbname=crm_app;charset=utf8', 'root', '', array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM queues where exec = 0 limit 5";
        $stm = $con->prepare($query);
        $stm->execute();
        $rs = $stm->fetchAll(PDO::FETCH_ASSOC);
        
       
        foreach ($rs as $key => $value) {
            exec($value["job"], $output);
            $SQL_UPDATE = "update queues set exec = 1 where id = " . $value["id"];
            try {
                $con->beginTransaction();
                $stm = $con->prepare($SQL_UPDATE);
                $stm->execute();
                $con->commit();
            } catch (Exception $ex) {
                $con->rollBack();
            }
        }
        $con = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

conexion();
?>

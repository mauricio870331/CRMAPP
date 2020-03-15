<?php

require 'define.php';

class BD {

    private $con;
    private $stm;
    private $rs;

    public function __construct() {
        try {
            $this->con = new PDO('mysql:host=' . HOST . ':3306;dbname=' . BD . ';charset=utf8', USER, PASS, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "�Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function desconectar() {
        $this->stm = null;
        $this->rs = null;
        $this->con = null;
    }

    public function query($query, $opc = "") {
        $this->stm = $this->con->prepare($query);
        $this->stm->execute();
        if ($opc) {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->rs;
    }

    public function executeSentence($sql) {
        $this->stm = $this->con->prepare($sql);
        $this->stm->execute();
        $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ); //FETCH_ASSOC
        return $this->rs;
    }

    public function findAll($tabla, $cond = "") {
        $query = "select * from " . $tabla . " " . $cond;
        $this->stm = $this->con->prepare($query);
        $this->stm->execute();
        $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        return $this->rs;
    }

    public function findAll2($query, $opc = false) {
        $this->stm = $this->con->prepare($query);
        $this->stm->execute();
        if ($opc) {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->rs;
    }

    public function findById($tabla, $fieldId, $id, $mode = "All") {
//        echo "select * from " . $tabla . " where " . $fieldId . " = " . $id;
        $this->stm = $this->con->prepare("select * from " . $tabla . " where " . $fieldId . " = ?");
        $this->stm->execute(array($id));
        if ($mode == "All") {
            $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ);
        } else {
            $this->rs = $this->stm->fetch(PDO::FETCH_OBJ);
        }
        return $this->rs;
    }

    public function exec($query) {
        try {
            $this->con->beginTransaction();
            $this->stm = $this->con->prepare($query);
            $this->stm->execute();
            $this->con->commit();
            return $this->stm->rowCount();
        } catch (Exception $ex) {
            $this->con->rollBack();
            //echo $ex->getCode();
            return $ex->getCode();
        }
    }

    public function checkID($tabla, $fieldId, $id) {
        $this->stm = $this->con->prepare("select * from " . $tabla . " where " . $fieldId . " = ?");
        $this->stm->execute(array($id));
        if ($this->stm->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function executLogin($sql, $user, $pass) {
        $this->stm = $this->con->prepare($sql);
        $this->stm->execute(array($user, $pass));
        $this->rs = $this->stm->fetchAll(PDO::FETCH_OBJ); //FETCH_ASSOC
        return $this->rs;
    }

}

?>

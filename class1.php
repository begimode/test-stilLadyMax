<?php

class CRUD
{
    public  $id, $name, $surname, $birth, $sex, $town;

    static function connect()
    {
        try {
            $hostdb = "localhost";
            $userdb = "root";
            $passworddb = "";
            $db = "album";

            $data = mysqli_connect($hostdb, $userdb, $passworddb, $db) or die("Error de conexion");
            // check the conexion
            if (!$data) {
                die("Error: " . mysqli_connect_error());
            }
            return $data;
        } catch (PDOException $e) {
            echo 'Error connecting ' . $e;
            return false;
        }
    }

    function __construct($id, $name, $surname, $birth, $sex, $town)
    {
        $connect = $this->connect();
        if ($connect != false && $connect != null) {
            $sql = "INSERT INTO `persons` (`id`, `name`, `surname`, `birth`, `sex`, `town`) VALUES ($id, '$name', '$surname', $birth, $sex, '$town');";
            $sentencia = $connect->prepare($sql);
            $sentencia->execute();
            if (!$sentencia) {
                $sqlCheck = "SELECT * FROM `persons` WHERE id=$id;";
                $sentencia = $connect->prepare($sqlCheck);
                $sentencia->execute();
            }
        } else {
            echo "Error creating new user";
        }
    }

    function deletePerson()
    {
        if ($this->connect() != false) {
            $connect = $this->connect();
            $sql = "DELETE FROM `persons` WHERE id = $this->id;";
            $sentencia = $connect->prepare($sql);
            $sentencia->execute();
        } else {
            echo "Error when deleting the person";
        }
    }

    private function getBirth()
    {
        return $this->birth;
    }

    static function calculate_age()
    {
        return date('Y') - CRUD::getBirth();
    }

    private function getSex()
    {
        return $this->sex;
    }

    static function sex()
    {
        $sex = CRUD::getSex();
        if ($sex == 0) {
            return 'man';
        } else {
            return 'woman';
        }
    }

    function edit($year, $sex)
    {
        $this->birth == $year;
        $this->sex == $sex;

        $connect = $this->connect();
        if ($connect != false && $connect != null) {
            $sql = "UPDATE `persons`
            SET birth = $this->birth, sex = $this->sex
            WHERE id = $this->id;";
            $sentencia = $connect->prepare($sql);
            $sentencia->execute();
            print($sentencia);
        } else {
            echo 'Error editing the user';
        }
    }
}

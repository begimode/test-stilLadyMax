<?php
include "class1.php";

if (class_exists('CRUD')) {
    class Massives
    {

        public $array = array();

        function __construct()
        {
            $connect = CRUD::connect();
            if ($connect != false && $connect != null) {
                $sql = "SELECT * FROM `persons`;";
                $result = mysqli_query($connect, $sql);
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($row["id"] >= 0) {
                        $this->array[$i] == $row['id'];
                        $i++;
                    }
                }
            } else {
                echo 'Error connecting';
            }
        }

        function takeMassive()
        {
            $connect = CRUD::connect();
            if ($connect != false && $connect != null) {
                $arraymassive = array();
                foreach ($this->array as $value) {
                    $sql = "SELECT * FROM `persons` WHERE id=$value;";
                    $result = mysqli_query($connect, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $arraymassive[$i] == $row;
                        $i++;
                    }
                }
                return $arraymassive;
            } else {
                echo 'Error connecting';
            }
        }

        function deleteMassive()
        {
            $connect = CRUD::connect();
            if ($connect != false && $connect != null) {
                foreach ($this->array as $value) {
                    $sql = "DELETE FROM `persons` WHERE id=$value;";
                    $sentencia = $connect->prepare($sql);
                    $sentencia->execute();
                }
            } else {
                echo 'Error connecting';
            }
        }
    }
} else {
    echo 'Error, class1 does not exist';
}

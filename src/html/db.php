<?php

require 'connection.php';

if (!function_exists('tt')){
    function tt($value){
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}
/*function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
} */
//Проверка выполнения запроса к бд
if (!function_exists('dbCheckError')) {
    function dbCheckError($query){
        $errInfo = $query->errorInfo();
        if ($errInfo[0] !== [PDO::ERR_NONE]){
            echo $errInfo[2];
            exit();
        }
    }
}
/*function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== [PDO::ERR_NONE]){
        echo $errInfo[2];
        exit();
    }
} */

//Запрос на получение данных с одной таблицы
if (!function_exists('selectAll')){
    function selectAll($table, $params = []){
        global $pdo;
        $sql = "SELECT * FROM $table";
    
        if(!empty($params)){
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key=$value";
                }else{
                    $sql = $sql . " AND $key=$value";
                }
                $i++;
            }
        }
    
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        
    }
}
/*function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    
}
*/

if (!function_exists('selectOne')){
    function selectOne($table, $params = []){
        global $pdo;
        $sql = "SELECT * FROM $table";
    
        if(!empty($params)){
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key=$value";
                }else{
                    $sql = $sql . " AND $key=$value";
                }
                $i++;
            }
        }
        $sql = $sql . " LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        dbCheckError($query);
    
        
    }
}
//Запрос на получение одной строки с выбранной таблицы 
/*function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    
}*/

if (!function_exists('insert')){

    function insert($table, $params){
        global $pdo;
        //INSERT INTO users (admin, username, email, password) VALUES ( '1', 'fuf', 'fufi@test.com', '6666',);
        $i = 0;
        $coll = '';
        $mask = '';
        foreach ($params as $key => $value) {
            if ($i === 0){
                $coll = $coll .  "$key";
                $mask = $mask ."'". "$value"."'";
            }else{
                $coll = $coll . ", $key";
                $mask = $mask . ",'". "$value"."'";
            }
        }
    }
}
?>
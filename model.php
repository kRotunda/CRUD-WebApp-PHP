<?php
    global $db;
    $db = null;

    function dbConnect() {
        global $db;
        $dsn = 'mysql:host=localhost;dbname=userCars';
        $username = 'root';
        $password = '';

        try {
            $db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function createUser($name, $hash) {
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $insert = "INSERT INTO users (username, passwordHash) VALUES (:username, :passwordHash)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':passwordHash', $hash);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getAllCars(){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT * FROM cars";
            $stmt = $db->prepare($select);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function checkLogin($name, $password) {
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT passwordHash FROM users WHERE username = :username";
            $stmt = $db->prepare($select);
            $stmt->bindParam(':username', $name);
            $stmt->execute();
            $userHash = $stmt->fetchColumn();
            if (password_verify($password, $userHash) == true) {
                return true;
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function getUserId ($name){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT id FROM users WHERE username = :username";
            $stmt = $db->prepare($select);
            $stmt->bindParam(':username', $name);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function makeCar($make, $model, $year, $userId){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $insert = "INSERT INTO cars (make, model, year, userId) VALUES (:make, :model, :year, :userId)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':make', $make);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function deleteCar($carId){
        global $db;
        if (!$db) {
            dbConnect();
        }

        $delete = "DELETE FROM cars WHERE id = :id";
        $stmt = $db->prepare($delete);
        $stmt->bindParam(':id', $carId);
        $stmt->execute();
    }

    function modelGetMake($carId){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT make FROM cars WHERE id = :id";
            $stmt = $db->prepare($select);
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function modelGetModel($carId){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT model FROM cars WHERE id = :id";
            $stmt = $db->prepare($select);
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function modelGetYear($carId){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $select = "SELECT year FROM cars WHERE id = :id";
            $stmt = $db->prepare($select);
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function updateCar ($id, $make, $model, $year){
        global $db;
        if (!$db) {
            dbConnect();
        }

        try {
            $update = "UPDATE cars SET make = :make, model = :model, year = :year WHERE id = :id";
            $stmt = $db->prepare($update);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':make', $make);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':year', $year);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
?>
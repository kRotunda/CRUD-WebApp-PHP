<?php 
    global $userData;
    $userData = null;
    include 'model.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_GET['action'])) {
            $action = $_GET['action']; 

            if ($action == 0){
                $name = $_POST["username"];
                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

                createUser($name, $hash);

                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $name;
                $_SESSION['id'] = getUserId($name);
                header("Location: view.php");
            } elseif ($action == 1){
                $name = $_POST["username"];
                $password = $_POST["password"];

                if (checkLogin($name, $password) == true) {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = getUserId($name);
                    header("Location: view.php");
                } else {
                    header("Location: view.php?page=2&loginError=1");
                }
            } elseif ($action == 2){ 
                $make = $_POST["make"];
                $model = $_POST["model"];
                $year = $_POST["year"];

                makeCar($make, $model, $year, $_SESSION['id']);
                header("Location: view.php");
            } elseif ($action == 3){ 
                $id = $_POST["id"];
                $make = $_POST["make"];
                $model = $_POST["model"];
                $year = $_POST["year"];

                updateCar($id, $make, $model, $year);

                header("Location: view.php");
            }
        }
    }  
    
    if (isset($_GET['delete'])) {
        deleteCar($_GET['delete']);
        header("Location: view.php");
    }

    function logout(){
        $_SESSION['loggedIn'] = false;
        $_SESSION['username'] = "";
        $_SESSION['id'] = -1;
        header("Location: view.php");
    }

    function userLogedIn(){
        if (isset($_SESSION['loggedIn'])) {
            if ($_SESSION['loggedIn'] == true){
                return true;
            } else {
                return false;
            }
        }
    }

    function displayCarTable (){
        echo '<br>';
        echo '<table>';
        echo '<tr>';
        echo '<th>Make</th><th>Model</th><th>Year</th><th>Owner Id</th>';
        echo '</tr>';
        $cars = getAllCars();
        foreach ($cars as $car) {
            echo '<tr>';
            echo '<td>' . $car['make'] . '</td>';
            echo '<td>' . $car['model'] . '</td>';
            echo '<td>' . $car['year'] . '</td>';
            echo '<td>' . $car['userId'] . '</td>';
            if ($car['userId'] == $_SESSION['id']) {
                echo '<td><a href="view.php?update='.$car['id'].'"> Update </a></td>';
                echo '<td><a href="controler.php?delete='.$car['id'].'"> Delete </a></td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    function getUsername(){
        return $_SESSION['username'];
    }

    function getMake($carId){
        return modelGetMake($carId);
    }

    function getModel($carId){
        return modelGetModel($carId);
    }

    function getYear($carId){
        return modelGetYear($carId);
    }
?>
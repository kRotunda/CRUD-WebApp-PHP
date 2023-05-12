<?php
    include 'controler.php';

    if (userLogedIn() == true){
        include 'templates/baseLogin.php';
        if (isset($_GET['page'])) {
            $page = $_GET['page']; 
    
            if ($page == 1){
                $username = getUsername();
                include 'templates/createCar.php';
            } elseif ($page == 2){
                logout();
            }
    
        } elseif (isset($_GET['update'])) {
            include 'templates/createCar.php';
        } else {
            include 'templates/home.php'; 
            displayCarTable();
        }  
    } else {
        include 'templates/base.php';
        if (isset($_GET['page'])) {
            $page = $_GET['page']; 
    
            if ($page == 1){
                include 'templates/create.php';
            } elseif ($page == 2){
                include 'templates/login.php';
                if (isset($_GET['loginError'])) {
                    echo 'ERROR: incorect uername/password';
                }
            }
    
        } else {
            include 'templates/home.php';
            displayCarTable();
        }
    }
?>
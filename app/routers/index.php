<?php
//Si un projet est mentionné
if(isset($_GET['projects'])){
    require_once '../app/routers/partials/_projects.php';

//Route par défaut
}else{
    if(isset($_GET['page'])){
        \App\Controllers\ProjectsController::indexAction($_GET['page']);   
    }else{
        \App\Controllers\ProjectsController::indexAction();
    }
}
?>
<?php

if(isset($_GET['page'])){
    \App\Controllers\ProjectsController::indexAction($_GET['page']);
}elseif(isset($_GET['project'])){
    require_once '../app/routers/partials/_projects.php';
    
}else{
    \App\Controllers\ProjectsController::indexAction();
}
?>
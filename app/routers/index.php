<?php
//Si un projet est mentionné
if(isset($_GET['project'])){
    require_once '../app/routers/partials/_projects.php';

//Si un n° de page est mentioné
}elseif(isset($_GET['page'])){
    \App\Controllers\ProjectsController::indexAction($_GET['page']); 

//Route par défaut
}else{
    \App\Controllers\ProjectsController::indexAction();
}
?>
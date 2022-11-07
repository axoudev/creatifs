<?php
use \App\Controllers\ProjectsController;

switch($_GET['project']){
    case 'delete':
        ProjectsController::deleteAction((int)$_GET['id']);
        break;
    case 'add':
        ProjectsController::addAction();
        break;
    case 'insert':
        ProjectsController::insertAction($_POST, $_FILES['image']);
    default:
        ProjectsController::showAction((int)$_GET['project']);
}
?>
<?php
use \App\Controllers\ProjectsController;

switch($_GET['project']){
    //Supprimer projet
    case 'delete':
        ProjectsController::deleteAction((int)$_GET['id']);
        break;
        
    //Formulaire d'ajout
    case 'add':
        ProjectsController::addAction();
        break;

    //Ajouter un projet
    case 'insert':
        ProjectsController::insertAction($_POST, $_FILES['image']);
        break;

    //Formulaire de modification
    case 'edit':
        ProjectsController::editAction();
        break;

    //Afficher les projets
    default:
        ProjectsController::showAction((int)$_GET['project']);
}
?>
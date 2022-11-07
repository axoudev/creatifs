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
        ProjectsController::editAction((int)$_GET['id']);
        break;

    //Modifier un post
    case 'update':
        ProjectsController::updateAction((int)$_GET['id'], $_POST, $_FILES['image']);
        break;

    //Afficher les projets
    default:
        ProjectsController::showAction((int)$_GET['project']);
}
?>
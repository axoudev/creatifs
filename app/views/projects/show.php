<?php 
    use App\Models\Repositories\CreatifsRepository; 
    use Core\Classes\Helpers;
?>
<!-- Titre du projet -->
<h1 class="mt-4"><?=$project->getTitle()?></h1>
<p class="lead">
    par
    <!-- Créatif du projet et date de création -->
    <a href="#"><?=CreatifsRepository::findOneById($project->getCreatif())->getPseudo();?></a> le <?=Helpers::getFormatedDate($project->getCreatedAt())?>
</p>

<div>
    <a href="project/<?=$project->getId()?>/<?=Helpers::slugify($project->getTitle())?>/edit/form" class="btn btn-primary">Éditer le projet</a>
    <a href="project/delete/<?=$project->getId()?>/<?=\Core\Classes\Helpers::slugify($project->getTitle())?>" class="btn">Supprimer le projet</a>
</div>
<hr />

<!-- Project One -->
<div class="row">
    <div class="col-md-6">
        <a href="#">
        <!-- Image du projet -->
        <img
            class="img-fluid rounded mb-3 mb-md-0"
            src="assets/images/<?=$project->getImage()?>"
            alt=""
        />
        </a>
    </div>
    <div class="col-md-6">
        <p class="lead">
            <!-- Description du projet -->
            <?=$project->getText()?>
        </p>
        <hr />
        <ul class="list-inline tags">
            <!-- Tags du projet -->
            <?php foreach($tags as $tag): ?>
                <li><a href="#" class="btn btn-default btn-xs"><?=$tag->getName()?></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<hr />
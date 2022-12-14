

<!-- Title -->
<h1 class="mt-4">Les projets <small>Design capill'Hair</small></h1>
<div>
    <a href="projects/add/form" class="btn btn-primary">Add a project</a>
</div>

<hr />

<?php
use App\Models\Repositories\CreatifsRepository;
use Core\Classes\Helpers;

//Liste des projets
foreach ($projects as $project): ?>
    <div class="row py-4">
        <div class="col-md-4">
            <!-- lien vers les détails du projet -->
            <a href="projects/<?=$project->getId()?>/<?=Helpers::slugify($project->getTitle())?>"> 
                <!-- image du projet -->
                <img
                    class="img-fluid rounded mb-3 mb-md-0"
                    src="assets/images/<?=$project->getImage()?>"
                    alt=""
                />
            </a>
        </div>
        <div class="col-md-8">
            <!-- titre du projet -->
            <h3><?=$project->getTitle()?></h3>
            <p class="lead">
                <!-- Créatif du projet et date de création -->
                par <a href="#"><?=CreatifsRepository::findOneById($project->getCreatif())->getPseudo();?></a> le <?=Helpers::getFormatedDate($project->getCreatedAt())?>
            </p>
            <p>
                <!-- Description du projet tronquée à 100 charactères -->
                <?=Helpers::truncate($project->getText(), 100).'...'?>
            </p>
            <a class="btn btn-primary" href="projects/<?=$project->getId()?>/<?=Helpers::slugify($project->getTitle())?>">View Details</a>
        </div>
    </div>


    <hr />
<?php endforeach; ?>

<nav aria-label="Page navigation example">
    <ul class="pagination" style="justify-content: center">

        <!-- BOUTTON PAGE PRECEDENTE -->
        <li class="page-item">
            <a class="page-link<?php 

                //si la variable page existe et qu'on est sur la première page -> désactive le bouton PREVIOUS
                if(isset($_GET['page'])){
                    if($_GET['page']==1){
                        echo' disabled';
                    }

                //si la variable page n'existe pas, on est forcément sur la première page -> désactive le bouton PREVIOUS
                }else{
                    echo' disabled';
                }
            ?>" href="page/<?php if(isset($_GET['page'])) echo $_GET['page']-1?>">Previous</a>
        </li>

        <!-- NUMEROS DE PAGES -->
        <?php for($i = 0, $page_number = 1; $i < $total_nb_projects; $i+=10, $page_number++):?>
            <li class="page-item">
                <a class="page-link<?php 

                //si la varibale page existe et que le numero de page est la page sur laquelle on est -> ajoutte la classe current
                if(isset($_GET['page'])){
                    if($_GET['page']==$page_number){
                        echo' current';
                    }
            
                //si la variable page n'existe pas, on est forcément sur la page 1 -> ajoute la classe current au lien page 1
                }else{
                    if($page_number==1){
                        echo' current';
                    }
                }
            ?>" href="page/<?=$page_number?>"><?=$page_number?></a>
            </li>

            <?php $lastPage = $page_number ?>
        <?php endfor; ?>

        <!-- BOUTTON PAGE SUIVANTE -->
        <li class="page-item">
            <a class="page-link<?php 
                //si la page sur laquelle on se trouve est la dernière page -> désactive le bouton NEXT
                if(isset($_GET['page'])){
                    if($_GET['page']==$lastPage){
                        echo' disabled';
                    }
                }
            ?>" role="link" aria-disabled="" href="page/<?php if(isset($_GET['page'])){echo $_GET['page']+1;}else{echo '2';}?>">Next</a>
        </li>
    </ul>
</nav>

<!-- Sidebar Widgets Column -->
<div class="col-md-4">
    <!-- Search Widget -->
    <div class="card my-4 d-none">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <div class="input-group">
        <input
            type="text"
            class="form-control"
            placeholder="Your search"
        />
        <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
        </span>
        </div>
    </div>
    </div>

    <!-- Creatifs Widget -->
    <div class="card my-4">
    <h5 class="card-header">Crea'tifs</h5>
    <div class="card-body">
        <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled mb-0">
                <!-- Liste des céatifs et le nombre de projets liés -->
                <?php 
                $cats = \App\Models\Repositories\CreatifsRepository::findAll();
                foreach($cats as $cat): ?>
                    <li><a href="#"><?=$cat->getPseudo()?> [<?=$cat->getNbProjects()?>]</a></li>
                <?php endforeach ?>
            </ul>
        </div>
        </div>
    </div>
    </div>

    <!-- Tags Widget -->
</div>
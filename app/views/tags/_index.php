<div class="col-md-4">
<!-- Search Widget -->
<div class="card my-4 d-none">
<h5 class="card-header">Newsletter</h5>
<div class="card-body">
    <div class="input-group">
    <input
        type="text"
        class="form-control"
        placeholder="Votre mail"
    />
    <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">Go!</button>
    </span>
    </div>
</div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
<h5 class="card-header">Tags</h5>
<div class="card-body">
    <div class="row">
    <div class="col-lg-12">
        <ul class="list-unstyled mb-0">
        <?php $tags = \App\Models\Repositories\TagsRepository::findAllByPost($project->getId()); ?>
        <?php if(!empty($tags)): ?>
            <?php foreach($tags as $tag): ?> 
                <li><a href="#"><?=$tag->getName()?></a> | <a href="">Modifier</a></li>
            <?php endforeach; ?>
        <?php else: ?>
                Aucun Tag...
        <?php endif; ?>
        </ul>
    </div>
    </div>
</div>
</div>
</div>



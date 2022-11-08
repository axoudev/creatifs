
<!-- Title -->
<h1>Edit a project</h1>

<!-- Form Start -->
<form action="project/<?=$project->getId()?>/<?=\Core\Classes\Helpers::slugify($project->getTitle())?>/edit/update" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input
      type="text"
      name="title"
      id="title"
      class="form-control"
      placeholder="Enter your title here"
      value="<?=$project->getTitle()?>"
    />
  </div>
  <div class="form-group">
    <label for="text">Text</label>
    <textarea
      id="text"
      name="text"
      class="form-control"
      rows="5"
      placeholder="Enter your text here"
    ><?=$project->getText()?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1"> Image</label>
    <input
      type="file"
      class="form-control-file btn btn-primary"
      id="exampleFormControlFile1"
      name="image"
    />
  </div>
  <div class="form-group">
    <label for="text">Creatif</label>
    <select id="creatif" name="creatif_id" class="form-control">
      <!-- Affiche les creatifs existans dans la liste déroulante et selectione celui qui correspond aux projet -->
      <?php foreach($creatifs as $creatif): ?>
        <option value=<?=$creatif->getId()?> <?php if($creatif->getId() == $projectCreatif->getId()) echo'selected' ?>>
          <?=$creatif->getPseudo()?> 
        </option>
      <?php endforeach ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="tags[]">Tags</label><br/>
      <?php foreach($tags as $tag): ?>
        
        <input type="checkbox" name="tags[]" value="<?=$tag->getId()?>" 
        <?php 
          foreach($projectTags as $projectTag){
            if($tag->getId() == $projectTag->getId()){
              echo 'checked';
            }
          }  
        ?>
          > <label><?=$tag->getName()?></label><br/>
      <?php endforeach ?>
  </div>

  <div>
    <input class="btn btn-primary" type="submit" value="submit" />
    <input class="btn btn-secondary" type="reset" value="reset" />
  </div>
</form>
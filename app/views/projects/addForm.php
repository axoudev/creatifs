<!-- Title -->
<h1>Add a project</h1>

<!-- Form Start -->
<form action="project/add/insert" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input
      type="text"
      name="title"
      id="title"
      class="form-control"
      placeholder="Enter your title here"
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
    ></textarea>
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
      <option disabled selected>Select your creatif</option>
      <!-- Affiche les créatifs existants dans la liste déroulante -->
      <?php foreach($creatifs as $creatif): ?>
        <option value=<?=$creatif->getId()?>><?=$creatif->getPseudo()?></option>
      <?php endforeach ?>
    </select>
  </div>
  <div>
    <input class="btn btn-primary" type="submit" value="submit" />
    <input class="btn btn-secondary" type="reset" value="reset" />
  </div>
</form>
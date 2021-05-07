<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row d-flex justify-content-center">
    <!-- POSTS foreach loop here -->
    <!-- image --> 
    <div class="col-12 text-left">
        <h1>Erstelle etwas wunderbares</h1>
    </div>
    
    <div class="col-md-12 col-sm-12">
        <div class="card p-2 py-3 shadow">
            <div class="card-content">
                <form 
                    action="<?php echo URLROOT;?>/posts/add" 
                    method="post"
                    enctype="multipart/form-data"
                >
                    <div class="row">
                        <div class="col-3">
                            <img src="#" alt="Bild erscheint hier" id="image-preview" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <!-- <label for="title"><h4>Text</h4></label> -->
                                <textarea class="form-control <?php echo (!empty($data["title_error"]) ? 'is-invalid' : ''); ?>" name="title" id="title" rows="4"><?php echo $data["title"]; ?></textarea>
                                <span class="invalid-feedback"><?php echo $data["title_error"]; ?></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="form-group">
                                <input type="file" class="form-control-file <?php echo (!empty($data["image_error"]) ? 'is-invalid' : ''); ?>" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">Ein Bild einfügen (6MB ist die max. Größe)</small>
                                <span class="invalid-feedback"><?php echo $data["image_error"]; ?></span>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12 d-inline">
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo URLROOT; ?>/posts" class="btn btn-outline-primary">Zurück</a>
                                <input class="btn btn-outline-success" type="submit" value="Beitragen">
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
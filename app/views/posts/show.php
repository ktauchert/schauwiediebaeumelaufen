<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row d-flex justify-content-center mt-3">
    <?php $post = $data["post"]; ?>
    <div class="col-12 post-container justify-content-center align-items-center p-3">
        <div class="row">
            <div class="col-12">
                <?php if($post->image_path !== 'no_image.jpg') : ?>
                    <div>
                        <img src="<?php echo URLROOT . '/images/storage/' . $post->image_path ; ?>" alt="" class="img-fluid">
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 pt-3 d-flex justify-content-center align-items-center">
                <div>
                    <h4><?php echo $post->title ?></h4>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between  py-2">
                <div class="d-flex align-items-center">
                    <small class="">Erstellt am <?php echo date("d.m.Y", strtotime($post->created_at));?></small>
                    <small class="">von <?php echo $post->name; ?></small>
                </div>
                <div >
                    <a href="<?php echo URLROOT ;?>/posts" class="btn btn-outline-info">Zurück</a>
                    <div class="d-inline">
                    <?php if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $post->userId) : ?>
                            <a href="<?php echo URLROOT . '/posts/edit/' . $post->postId ?>" class="btn btn-outline-info">Bearbeite</a>
                            <span class="d-inline">
                                <form 
                                class="d-inline"
                                    action="<?php echo URLROOT . '/posts/delete/' . $post->postId ?>"
                                    method="POST">
                                <button type="submit" class="btn btn-outline-danger">Löschen</button>
                                </form>
                            </span>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 ">
        
    </div>
    
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
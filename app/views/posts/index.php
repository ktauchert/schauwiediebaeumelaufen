<?php require APPROOT . '/views/inc/header.php'; ?>

<?php $posts = isset($data["posts"]) ? $data["posts"] : []; ?>

<div class="row d-flex justify-content-center mt-3 mb-5">
    <div class="col-12">
        <?php flash('post_message'); ?>
    </div>
    <?php if (isset($_SESSION["user_id"])) : ?>
        <div class="col-12 d-flex justify-content-between">
            <div class="text-left">
                <h1><?php echo $data["title"]; ?></h1>
            </div>
            <div class="">
                <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-success">+ Neuer Beitrag</a>
            </div>
        </div>
</div>
<?php else : ?>
    <div class="col-12 text-left">
        <h1><?php echo $data["title"]; ?></h1>
    </div>
<?php endif; ?>

<?php if (!empty($posts)) : ?>
    <?php foreach ($posts as $post) : ?>
        <?php if ($post->image_path === "no_image.jpg") : ?>
            <div class="col-12 mb-5 post-container" id="<?php echo "post_" . $post->postId; ?>">
                <div class="row">
                    <div class="col-12 p-4 d-flex justify-content-center align-items-center">
                        <!-- Title here -->
                        <div>
                            <h4 class="text-left"><?php echo $post->title; ?></h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between py-2">
                        <div class="d-flex align-items-center">
                            <small class="">Erstellt am <?php echo date("d.m.Y", strtotime($post->postCreatedAt)) ?></small>
                            <small class="">&nbsp;von <?php echo $post->name; ?></small>
                        </div>
                        <div>
                            <a href="<?php echo URLROOT . '/posts/show/' . $post->postId ?>" class="btn btn-outline-success">Zeige Mehr</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="col-12 post-container mb-5">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <img loading="lazy" class="img-fluid pt-3" src="<?php echo URLROOT . '/images/storage/' . $post->image_path ?>" alt="Blog-image">
                    </div>
                    <div class="col-md-7 col-sm-12 d-flex justify-content-center align-items-center">
                        <h4><?php echo $post->title; ?></h4>
                    </div>
                    <div class="col-12 d-flex justify-content-between py-2">
                        <div class="d-flex align-items-center">
                            <small class="">Erstellt am <?php echo date("d.m.Y", strtotime($post->postCreatedAt)) ?></small>
                            <small class="">&nbsp;von <?php echo $post->name; ?></small>
                        </div>
                        <div class="d-block">
                            <a href="<?php echo URLROOT . '/posts/show/' . $post->postId ?>" class="btn btn-outline-success">Zeige Mehr</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>

<?php endif; ?>


</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
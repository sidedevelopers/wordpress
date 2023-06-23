<?php include 'header.php'; ?>

<section class="page my-5">
    <div class="container-fluid">
        <div class="container">

            <h2 class="text-center page-title mb-5 text-uppercase"><?php the_title(); ?></h2>
        
            <?php 
                while(have_posts()){
                the_post(); ?>
            <?php the_content(); ?>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
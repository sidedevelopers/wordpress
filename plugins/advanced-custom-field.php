<?php 
    if(get_field('short_description', get_the_ID())){
        echo get_field('short_description', get_the_ID());
    }
?>

<?php the_field('subtitle', 124); ?>
    


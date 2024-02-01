<?php get_header(); ?>

<section class="my-3">
    <div class="container-fluid">
        <div class="container padding-fluid">
            <div class="row">
                <div class="col-md-8">

                    <h3 class="sourceserifpro-semibold mt-3 mb-3">
						<?php
							if(is_category()){
								single_cat_title();
							}
							else if(is_tag()){
								the_archive_title();
							}
							else{
								echo 'News';
							}
						?>
					</h3>
					
					<?php
						if(have_posts()){
					    while(have_posts()){
        				the_post(); ?>

                    <div class="border-bottom bbd-setup2">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="sourceserifpro-semibold">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p class="paragraph2 mb-1">
									<?php echo wp_trim_words(get_the_content(), 18); ?>
								</p>
                                <div class="paragraph2">By Admin - <?php echo get_the_date('F d, Y'); ?></div>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url(); ?>"
                                        class="w-100" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                </a>
                            </div>
                        </div>
                    </div>

						<?php } wp_reset_postdata(); ?>
					
					<?php } else{ ?>
					
					<h6 class="sourceserifpro-semibold">
                        Sorry, There are No News Found!
                    </h6>
					
					<?php } ?>
                   
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
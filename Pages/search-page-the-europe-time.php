<?php get_header(); ?>
<?php $search_query = trim(get_search_query()); ?>

    <section class="my-5">
        <div class="container-fluid">
            <div class="container">

                <div class="border-bottom border-primary pb-2 mb-4">
                    <h1 class="fw-bold">
						<?php
							if(empty($search_query)){
								echo 'Search: Discover Breaking News';
							}
							else{
								printf( esc_html__( 'Search Results for: %s', 'theeuropetime' ), esc_html( $search_query ) );
							}
						?>
					</h1>
                </div>

                	<form role="search" method="GET" action="<?php echo home_url(); ?>">
                        <div class="input-group mt-3 mb-3">
                            <input type="search" name="s" class="form-control py-2"
                                placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2" value="<?php echo esc_attr( $search_query ); ?>" required />
                            <input type="hidden" name="post_type" value="post">
                            <button class="btn btn-dark px-4 px-md-5" type="submit"
                                id="button-addon2">Search</button>
                        </div>
                    </form>
				
				<?php if(!empty($search_query)){ ?>
				<?php if(have_posts()) { ?>
				
				<div class="row mt-5">
                    <div class="col-md-9">
						
						<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						$searchPosts = new WP_Query(array(
							'post_type' => 'post',
							's' => $search_query,
							'paged' => $paged,
						));
						while($searchPosts->have_posts()){
						$searchPosts->the_post(); ?>

                        <div class="border-bottom border-bottom-last mb-4 pb-4">
                            <div class="row gy-3 gy-md-0">
                                <div class="col-md-4">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php the_post_thumbnail_url(); ?>"
                                            class="w-100" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="fw-bold mb-2" title="<?php the_title(); ?>">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <p class="mb-0">
										<?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 20, '... <a href="' . esc_url( get_permalink() ) . '" class="fw-medium">Read more</a>')); ?>
									</p>
                                </div>
                            </div>
                        </div>
						
						<?php } wp_reset_postdata(); ?>
						
						<?php
							$pagination_args = array(
								'total' => $searchPosts->max_num_pages,
								'current' => $paged,
							);
						?>
						
						<div class="text-center my-3">
    						<?php echo paginate_links($pagination_args); ?>
						</div>

                    </div>

                </div>
				
				<?php } else { ?>
				
				<?php esc_html_e( 'No results found. Please try again with different keywords.', 'theeuropetime' ); ?>
				
				<?php } } ?>

            </div>
        </div>
    </section>

<?php get_footer(); ?>
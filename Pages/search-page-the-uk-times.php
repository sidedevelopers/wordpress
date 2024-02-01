<section class="my-3">
    <div class="container-fluid">
        <div class="container padding-fluid">
            <div class="row">
                <div class="col-md-8">
					
					<?php $search_query = trim(get_search_query()); ?>
                    <!-- trim prevent the space search -->

                    <form role="search" method="GET" action="<?php echo home_url(); ?>">
                        <div class="input-group mt-3 mb-3">
                            <input type="search" name="s" class="form-control py-2 sourceserifpro-semibold"
                                placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2" value="<?php echo $search_query; ?>" required />
                            <input type="hidden" name="post_type" value="post">
                            <button class="btn btn-dark px-4 px-md-5 sourceserifpro-semibold" type="submit"
                                id="button-addon2">Search</button>
                        </div>
                    </form>

					<?php if (!empty($search_query)) { ?>
					
                    <?php if (have_posts()) { ?>

                    <h3 class="sourceserifpro-semibold mt-3 mb-3">
                        <?php printf( esc_html__( 'Search Results for: %s', 'theuktimes' ), $search_query ); ?>
                    </h3>

                    <?php
						$searchPosts = new WP_Query(array(
							'post_type' => 'post',
						));
						while($searchPosts->have_posts()){
						$searchPosts->the_post(); ?>

                        <!-- Search Content Here -->

                    <?php } wp_reset_postdata(); ?>

                    <?php } else { ?>
					
					<h3 class="sourceserifpro-semibold mt-3 mb-3">
                        <?php printf( esc_html__( 'Search Results for: %s', 'theuktimes' ), $search_query ); ?>
                    </h3>

                    <h6 class="sourceserifpro-semibold">
                        Sorry, but nothing matched your search terms. Please try again with some different keywords.
                    </h6>

                    <?php } ?>
					
					<?php } else { ?>
					
					<h5 class="sourceserifpro-semibold mt-3 mb-3">
                        Discover Breaking News!
                    </h5>
					
					<?php } ?>

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</section>


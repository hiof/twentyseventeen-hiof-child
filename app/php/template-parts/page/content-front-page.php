<?php
/**
* Displays content for front page
*
* @package WordPress
* @subpackage Twenty_Seventeen
* @since 1.0
* @version 1.0
*/

?>


<?php if (get_page_template_slug() === 'page_frontpage.php') {?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >
		<div class="panel-content">
			<div class="wrap">

				<?php
				// Get the current blog id
				$original_blog_id = get_current_blog_id();

				// All the blog_id's to loop through
				$bids = array( 2, 3, 4 );


				//$featured = array();







				$featured = new WP_Query();

				foreach( $bids as $bid ){
					$thisQuery = '';
					switch_to_blog( $bid );


					$args = array(
						'posts_per_page'   => 4,
						'offset'           => 0,
						'category'         => '',
						'category_name'    => '',
						'orderby'          => 'date',
						'order'            => 'DESC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'post',
						'post_mime_type'   => '',
						'post_parent'      => '',
						'author'	   => '',
						'author_name'	   => '',
						'post_status'      => 'publish',
						'suppress_filters' => true
					);



					$thisQuery = new WP_Query($args);
					$blogName = get_blog_details($bid)->blogname;
					echo $blogName;
					echo "<code><pre>";
					print_r('$thisQuery->posts');
					echo "</pre></code>";

					if ( (array) $featured->posts === $featured->posts ) {
						$featured = array_merge( $featured, $thisQuery );
					}
					wp_reset_postdata();
				}










				// we also need to set post count correctly so as to enable the looping
				$featured->post_count = count( $featured->posts );



				if ( $featured->have_posts() ) {

				}


					//foreach( $bids as $bid )
					//{
					//	// Switch to the blog with the blog_id $bid
					//	switch_to_blog( $bid );
					//
					//	$args = array(
					//		'posts_per_page'   => 4,
					//		'offset'           => 0,
					//		'category'         => '',
					//		'category_name'    => '',
					//		'orderby'          => 'date',
					//		'order'            => 'DESC',
					//		'include'          => '',
					//		'exclude'          => '',
					//		'meta_key'         => '',
					//		'meta_value'       => '',
					//		'post_type'        => 'post',
					//		'post_mime_type'   => '',
					//		'post_parent'      => '',
					//		'author'	   => '',
					//		'author_name'	   => '',
					//		'post_status'      => 'publish',
					//		'suppress_filters' => true
					//	);
					//
					//	//$blogName = get_blog_details($bid)->blogname;
					//
					//	$myposts = get_posts($args);
					//
					//	//foreach($myposts as $mypost){
					//	//	$mypost['blog_name'] = get_blog_details($bid)->blogname;
					//	//}
					//
					//
					//	$featured[] = $myposts;
					//
					//
					//
					//	//print_r($posts_array) ;
					//
					//	//restore_current_blog();
					//	// ... your code for each blog ...
					//}


					//usort($featured, function ($item1, $item2) {
					//    if ($item1['price'] == $item2['price']) return 0;
					//    return $item1['price'] < $item2['price'] ? -1 : 1;
					//});

					echo "<code><pre>";
					print_r($featured->posts);
					echo "</pre></code>";

					// Switch back to the current blog
					switch_to_blog( $original_blog_id );


					?>


				</div>
			</div>
		</article>
		<?php }else{ ?>


			<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> data-test="test">

				<?php if ( has_post_thumbnail() ) :
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

					$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

					$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

					// Calculate aspect ratio: h / w * 100%.
					$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
					?>

					<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
						<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
					</div><!-- .panel-image -->

				<?php endif; ?>

				<div class="panel-content">
					<div class="wrap">
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

							<?php twentyseventeen_edit_link( get_the_ID() ); ?>

						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
								get_the_title()
								) );
								?>
							</div><!-- .entry-content -->

						</div><!-- .wrap -->
					</div><!-- .panel-content -->

				</article><!-- #post-## -->


				<?php } ?>

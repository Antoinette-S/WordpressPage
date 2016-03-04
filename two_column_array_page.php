<?php
/*
 * Template Name: JS Ambassador Page
 * 
 * A custom page template with left sidebar list-type menu, 3 buttons,
 * and a combination of static images and columns of text depending
 * on which button is pressed.
 * 
 * @package WordPress
 * @subpackage justsalad
 * 
 */

get_header(); ?>

		<div id="container">
            <section id="content" role="main">


	             <?php echo get_the_post_thumbnail( $post->ID, 'featured', array('class'=>'featured') ); ?> 

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1 class="ambhead"><?php the_title(); ?></h1>

					<?php //the_content(); ?>
					<?php $content = apply_filters( 'the_content', get_the_content() );

							//display after the first paragraph of each column
							$paragraph[1] =  '<div id="pictureblock">' ; //setting 1st paragraph div for css
							$paragraph2[1] =  '<div id="pictureblock">' ; //setting 2nd paragraph div for css
							$twitter1 = get_post_meta($post->ID, 'twitter1', true); //getting 1st twitter link from post
							$facebook1 = get_post_meta($post->ID, 'facebook1', true); //getting 1st facebook link from post
							$instagram1 = get_post_meta($post->ID, 'instagram1', true); //getting 1st instagram link from post 
							$twitter2 = get_post_meta($post->ID, 'twitter2', true); //getting 2nd twitter link from post
							$facebook2 = get_post_meta($post->ID, 'facebook2', true); //getting 2nd facebook link from post
							$instagram2 = get_post_meta($post->ID, 'instagram2', true); //getting 2nd instagram link from post?>
								
									<?php	 if( '<div class="coulmn1">') {
									        //start first twitter image add
									      if( get_post_meta($post->ID, 'twitter1', true) ): ?>
										<?php $paragraph[1] .= '<a href="'. $twitter1 .'" target="_blank">' .
										'<img src="/wp-content/uploads/2012/04/twitter-r.png"></a> &nbsp;' ;?>
										<?php	endif;   // end 1st get_post_meta
										//start first facebook image add
									 if( get_post_meta($post->ID, 'facebook1', true) ): ?>
										<?php $paragraph[1].= '<a href="'. $facebook1 .'" target="_blank">' . 
									'<img src="/wp-content/uploads/2012/04/facebook-r.png"></a> &nbsp;';  ?> 
										    <?php endif;   //end 2nd get_post_meta 
										//start first instagram image add
									 if( get_post_meta($post->ID, 'instagram1', true) ): ?>
										<?php $paragraph[1].= '<a href="'. $instagram1 .'" target="_blank">' . 
									'<img src="/wp-content/uploads/2014/04/Icons_Instagram-e1396452625902.png"></a> &nbsp;';  ?> 
										    <?php endif;   //end 3rd get_post_meta 
											}?>
									
									<?php	 if( '<div class="coulmn2">') {
									        //start second twitter image add
									      if( get_post_meta($post->ID, 'twitter2', true) ): ?>
										<?php $paragraph2[1] .= '<a href="'. $twitter2 .'" target="_blank">' .
										'<img src="/wp-content/uploads/2012/04/twitter-r.png"></a> &nbsp;' ;?>
										<?php	endif;   // end 1st get_post_meta
										//start second facebook image add
									 if( get_post_meta($post->ID, 'facebook2', true) ): ?>
										<?php $paragraph2[1] .= '<a href="'. $facebook2 .'" target="_blank">' . 
									'<img src="/wp-content/uploads/2012/04/facebook-r.png"></a> &nbsp;';  ?> 
										    <?php endif;   //end 2nd get_post_meta 
										//start second instagram image add
									 if( get_post_meta($post->ID, 'instagram2', true) ): ?>
										<?php $paragraph2[1] .= '<a href="'. $instagram2 .'" target="_blank">' . 
									'<img src="/wp-content/uploads/2014/04/Icons_Instagram-e1396452625902.png"></a> &nbsp;';  ?> 
										    <?php endif;   //end 3rd get_post_meta 
											}


						// Include the page content template.
			 			$content = apply_filters( 'the_content', get_the_content() );

							?><p><?php
          							$beforeFirstImage = "<div class='coulmn1'>";
           							$afterFirstImage = "</div>";
           							$content1 = explode("</p>", $content);
										$count = count($content1);
							 		    for ($i = 0; $i < $count; $i++ ) { 
									      if ( array_key_exists($i, $paragraph) ) { 
										$pic = $paragraph[$i]. "</p>"."</div>";
											}     //end array_key_exists 
										} //end for loop for first column
						if (preg_match_all("/(<img [^>]*>)/",$content ,$matches,PREG_SET_ORDER)){
							$content1 = explode("</p>", $content);
                 					echo $beforeFirstImage . $matches[0][0] . $pic . $content1[1] . $afterFirstImage;

           									} //end if statement
									$count2 = count($content1);
							 		    for ($i = 0; $i < $count2; $i++ ) { 
									      if ( array_key_exists($i, $paragraph2) ) { 
										$pic2 =  $paragraph2[$i]. "</p>" ."</div>";
											}     //end array_key_exists 
										$secondColumn = array_slice($content1, 3);
										} //end for loop for second column ?>
  									</p>

							<p><?php	   
						           $beforeSecondImage = "<div class='coulmn2'>";
						           $afterSecondImage = "</div>";
 						                     if(preg_match_all("/(<img [^>]*>)/",$content,$matches,PREG_SET_ORDER)){
 						                           echo $beforeSecondImage . $matches[1][1]. $pic2. $secondColumn[1] . $secondColumn[2]. 											$afterSecondImage;
						                      }
						             ?></p>

					   <?php //end clear:both div to prevent column wrapping?>
						<div class="viewamb"><a href="/culture/nutrition-fitness/">View all of our Ambassadors here!</a></div>

                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>

                    <?php comments_template( '', true ); ?>

					<?php 
						if($post->post_parent) {
							$permalink = get_permalink($post->post_parent); ?>
							<a class="arrow-back" href="<?php echo $permalink; ?>">Back to <?=get_the_title($post->post_parent)?></a>
					<?php }?>

				<?php endwhile; ?>
           
			</section><!-- #content -->
			<?php get_sidebar('right'); ?>
		</div><!-- #container -->

<?php get_footer(); ?>

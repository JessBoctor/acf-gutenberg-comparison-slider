<?php
/**
 * Block Name: Comparison Slider
 *
 * This is the template that displays the testimonial block.
 */
 
 //Get the post_id
 global $post;
 
 //Get the image size preference
 $image_size = get_field( 'comp_image_size' );

//Get the image ids
 //>>Left Image
 $left_img_id = get_field( 'comp_left_image' );
 $left_img_src = wp_get_attachment_url( $left_img_id ); 
 $left_img_label = get_field('comp_left_image_label');

//>>Right Image
 $right_img_id = get_field( 'comp_right_image' );
 $right_img_src = wp_get_attachment_url( $right_img_id );
 $right_img_label = get_field('comp_right_image_label');
 
 //Get the handle color
 $handle_color = get_field('comp_drag_icon_color');
 
 ?>
<figure class="cd-image-container">
   <img src="<?php echo $left_img_src; ?>" alt="Before Image">
   <span class="cd-image-label" data-type="original"><?php echo $left_img_label; ?></span>
  
   <div class="cd-resize-img"> <!-- the resizable image on top -->
      <img src="<?php echo $right_img_src; ?>" alt="After Image">
      <span class="cd-image-label" data-type="modified"><?php echo $right_img_label; ?></span>
   </div>
  
   <span class="cd-handle" style="background-color: <?php echo $handle_color; ?>;"></span> <!-- slider handle -->
</figure> <!-- cd-image-container -->

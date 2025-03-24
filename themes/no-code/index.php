<?php
// Query Loop for Customer Reviews
$args = array(
    'post_type' => 'customer_review', // Custom post type slug
    'posts_per_page' => 5,           // Number of reviews to display
    'orderby' => 'date',             // Order by date
    'order' => 'DESC'                // Latest first
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="customer-reviews">';
    while ($query->have_posts()) : $query->the_post();
        ?>
        <div class="review">
            <h3><?php the_title(); ?></h3>
            <p><strong>Reviewer:</strong> <?php echo get_field('reviewer_name'); ?></p>
            <p><strong>Rating:</strong> <?php echo get_field('rating'); ?>/5</p>
            <div><?php the_content(); ?></div>
        </div>
        <?php
    endwhile;
    echo '</div>';
    wp_reset_postdata(); // Reset the global post object
else :
    echo '<p>No reviews available.</p>';
endif;
?>
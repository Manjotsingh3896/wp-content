<?php
get_header(); // Include the header template

echo '<div class="blog-container">'; // Add a wrapper for width control

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_excerpt(); ?></div>
        </article>
        <?php
    endwhile;
else :
    echo '<p>No posts found.</p>';
endif;

echo '</div>'; // Close the wrapper

get_footer(); // Include the footer template

?>
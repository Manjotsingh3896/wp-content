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
<!-- wp:template-part {"slug":"header","theme":"no-code","area":"header"} /-->

<div class="site-container">
    <!-- wp:post-content {"style":{"spacing":{"blockGap":"0"}},"fontSize":"small"} /-->

    <!-- wp:latest-posts {"style":{"spacing":{"margin":{"right":"var:preset|spacing|80","left":"var:preset|spacing|80"}}}} /-->

    <!-- wp:block {"ref":13} /-->
</div>

<!-- wp:template-part {"slug":"footer","theme":"no-code","area":"footer"} /-->
?>
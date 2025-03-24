<?php
get_header(); // Include the header template

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;
else :
    echo '<p>No content found.</p>';
endif;

get_footer(); // Include the footer template
?>
<?php
/**
 * Adds Pubnews_Posts_Grid_Widget widget.
 * 
 * @package Pubnews
 * @since 1.0.0
 */
class Pubnews_Posts_Grid_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'pubnews_posts_grid_widget',
            esc_html__( 'Pubnews : Posts Grid', 'pubnews' ),
            array( 'description' => __( 'A collection of posts from specific category displayed in grid layout.', 'pubnews' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_category = isset( $instance['posts_category'] ) ? $instance['posts_category'] : '';
        $posts_count = isset( $instance['posts_count'] ) ? $instance['posts_count'] : 4;
        $widget_layout = isset( $instance['widget_layout'] ) ? $instance['widget_layout'] : 'layout-one';
        echo wp_kses_post($before_widget);
            if ( ! empty( $widget_title ) ) echo $before_title . $widget_title . $after_title;
            ?>
                <div class="posts-wrap posts-grid-wrap feature-post-block <?php echo esc_attr( $widget_layout ); ?>">
                    <?php
                        $post_query = array( 
                            'cat'    => absint( $posts_category ),
                            'posts_per_page' => absint( $posts_count ),
                            'ignore_sticky_posts'    => true
                        );
                        $post = new WP_Query( apply_filters( 'pubnews_query_args_filter', $post_query ) );
                        if( $post->have_posts() ) :
                            $delay = 0;
                            while( $post->have_posts() ) : $post->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'pubnews-list' );
                                $categories = get_the_category();
                        ?>
                                <div class="post-item format-standard pubnews-card <?php if( $widget_layout == 'layout-two'){ echo esc_attr('pubnews-category-no-bk'); } ?>" <?php echo esc_attr(pubnews_get_block_animation_attr($delay)); ?>>
                                    <div class="post_thumb_image post-thumb <?php if( !$thumbnail_url ) echo esc_attr('no-feat-img'); ?>">
                                        <figure class="post-thumb">
                                            <?php if( $thumbnail_url ) : ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" loading="<?php pubnews_lazy_load_value(); ?>">
                                                </a>
                                            <?php endif; ?>
                                        </figure>
                                    </div>
                                    <div class="post-content-wrap card__content">
                                        <div class="pubnews-post-title card__content-title post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            $delay += 100;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    ?>
                </div>
            <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $categories = get_categories();
        $categories_options[''] = esc_html__( 'Select category', 'pubnews' );
        foreach( $categories as $category ) :
            $categories_options[$category->term_id] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'pubnews' ),
                    'description'=> esc_html__( 'Add the widget title here', 'pubnews' ),
                    'default'   => esc_html__( 'Trending News', 'pubnews' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'pubnews' ),
                    'description'=> esc_html__( 'Choose the category to display list of posts', 'pubnews' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'widget_layout',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Layouts', 'pubnews' ),
                    'options'   => array(
                        'layout-one'    => esc_html__( 'Layout One', 'pubnews' ),
                        'layout-two'    => esc_html__( 'Layout Two', 'pubnews' )
                    )
                )
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            pubnews_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = pubnews_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class Pubnews_Posts_Grid_Widget
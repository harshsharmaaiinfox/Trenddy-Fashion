<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

$thumb_size = 'rdtheme-size3';
$has_entry_meta  = ( !has_post_thumbnail() && RDTheme::$options['blog_date'] ) ||( !has_post_thumbnail() && RDTheme::$options['blog_cats'] && has_category() ) || RDTheme::$options['blog_author_name'] || RDTheme::$options['blog_comment_num'] ? true : false;

$comments_number = get_comments_number();
$comments_text   = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'metro' ), number_format_i18n( $comments_number ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-each post-each-3' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink();?>">
				<?php the_post_thumbnail( $thumb_size );?>
				<?php if ( RDTheme::$options['blog_date'] ): ?>
					<div class="post-date-box updated published"><?php the_time( get_option( 'date_format' ) );?></div>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="post-content-area">
		<?php if ( has_post_thumbnail() && RDTheme::$options['blog_cats'] && has_category() ): ?>
			<div class="post-top-cats"><?php the_category( ', ' );?></div>
		<?php endif; ?>
		<h2 class="post-title"><a href="<?php the_permalink();?>" class="entry-title" rel="bookmark"><?php the_title();?></a></h2>
		<?php if ( $has_entry_meta ): ?>
			<ul class="post-meta">
				<?php if ( !has_post_thumbnail() && RDTheme::$options['blog_date'] ): ?>
					<li><span class="fa fa-calendar" aria-hidden="true"></span><span class="updated published"><?php the_time( get_option( 'date_format' ) );?></span></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['blog_author_name'] ): ?>
					<li><span class="fa fa-user" aria-hidden="true"></span><span class="vcard author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="fn"><?php the_author(); ?></a></span></li>
				<?php endif; ?>
				<?php if ( RDTheme::$options['blog_comment_num'] ): ?>
					<li><span class="fa fa-comments" aria-hidden="true"></span><span><?php echo esc_html( $comments_text );?></span></li>
				<?php endif; ?>
				<?php if ( !has_post_thumbnail() && RDTheme::$options['blog_cats'] && has_category() ): ?>
					<li><span class="fa fa-tags" aria-hidden="true"></span><?php the_category( ', ' );?></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>
		<div class="post-content entry-summary"><?php the_excerpt();?></div>
		<a href="<?php the_permalink();?>" class="read-more-btn"><?php esc_html_e( 'Continue Reading', 'metro' );?><span class="fa fa-arrow-right" aria-hidden="true"></span></a>
	</div>
</article>
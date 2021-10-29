<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xMag
 * @since xMag 1.0
 */


if ( ! function_exists( 'xmag_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function xmag_posted_on() {
	
	xmag_time_link();
	
	if ( in_the_loop() ) {
		xmag_author_link();
	} else {
		global $post;
		$author_id = $post->post_author;
		printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
			_x( 'Author', 'Used before post author name.', 'xmag' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ),
			get_the_author_meta( 'display_name', $author_id )
		);
	}// if in_the_loop

}
endif;


if ( ! function_exists( 'xmag_time_link' ) ) :
/**
 * Prints HTML with the published date.
 */
function xmag_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);
	
	if ( is_single() ) {
		$time_icon = '<span class="icon-clock"></span>';
	} else {
		$time_icon = '';
	}
	
	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s</span> %2$s <a href="%3$s" rel="bookmark">%4$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'xmag' ),
		$time_icon,
		esc_url( get_permalink() ),
		$time_string
	);
	
}
endif;


if ( ! function_exists( 'xmag_author_link' ) ) :
/**
 * Prints HTML with the Author.
 */
function xmag_author_link() {
	printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x( 'Author', 'Used before post author name.', 'xmag' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;


if ( ! function_exists( 'xmag_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function xmag_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'xmag' ) );
		if ( $categories_list && xmag_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="icon-folder"></span> ' . __( 'Category: %1$s', 'xmag' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'xmag' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="icon-tag"></span> ' . __( 'Tag: %1$s', 'xmag' ) . '</span>', $tags_list );
		}
	}

	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><span class="icon-bubble"></span> ';
		comments_popup_link(
			__( 'Leave a comment', 'xmag' ),
			__( '1 Comment', 'xmag' ),
			__( '% Comments', 'xmag' )
		);
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'xmag' ), '<span class="edit-link">', '</span>' );
}
endif;


if ( ! function_exists( 'xmag_entry_comments' ) ) :
/**
 * Prints HTML with meta information for comments.
 */
function xmag_entry_comments() {

	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( ( '<span class="icon-bubbles"></span> 0' ), ( '<span class="icon-bubbles"></span> 1' ), ( '<span class="icon-bubbles"></span> %' ) );
		echo '</span>';
	}

}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function xmag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'xmag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'xmag_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so xmag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so xmag_categorized_blog should return false.
		return false;
	}
}

<?php
/**
 * Lightweight on-page SEO so the build needs no SEO plugin:
 * SEO title, meta description, primary keyword note and noindex per page,
 * sitemap at /sitemap.xml (noindex pages excluded), canonical via core.
 * Steps aside automatically if Yoast or Rank Math is installed later.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

add_action( 'init', function () {
	// 1.4.13: posts get the same SEO fields as pages.
	foreach ( array( 'page', 'post' ) as $type ) {
		foreach ( array( '_solevo_seo_title', '_solevo_meta_description', '_solevo_keyword' ) as $key ) {
			register_post_meta( $type, $key, array(
				'type'          => 'string',
				'single'        => true,
				'show_in_rest'  => 'post' === $type, // posts are created through the REST API
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			) );
		}
		register_post_meta( $type, '_solevo_noindex', array( 'type' => 'boolean', 'single' => true, 'show_in_rest' => 'post' === $type, 'auth_callback' => function () {
			return current_user_can( 'edit_posts' );
		} ) );
	}
} );

/* ---------- Edit screen box ---------- */

add_action( 'add_meta_boxes', function () {
	if ( solevo_seo_plugin_active() ) {
		return;
	}
	add_meta_box( 'solevo-seo', 'Search appearance (SEO)', 'solevo_seo_box', array( 'page', 'post' ), 'normal', 'high' );
} );

function solevo_seo_box( $post ) {
	wp_nonce_field( 'solevo_seo', 'solevo_seo_nonce' );
	$title   = get_post_meta( $post->ID, '_solevo_seo_title', true );
	$desc    = get_post_meta( $post->ID, '_solevo_meta_description', true );
	$keyword = get_post_meta( $post->ID, '_solevo_keyword', true );
	$noindex = (bool) get_post_meta( $post->ID, '_solevo_noindex', true );
	?>
	<p><label for="solevo_seo_title"><strong>SEO title</strong> (about 60 characters or less)</label><br>
	<input type="text" id="solevo_seo_title" name="solevo_seo_title" value="<?php echo esc_attr( $title ); ?>" style="width:100%" maxlength="70">
	<span class="description"><span data-count-for="solevo_seo_title"><?php echo esc_html( mb_strlen( $title ) ); ?></span> characters</span></p>
	<p><label for="solevo_meta_description"><strong>Meta description</strong> (140 to 155 characters)</label><br>
	<textarea id="solevo_meta_description" name="solevo_meta_description" rows="2" style="width:100%" maxlength="170"><?php echo esc_textarea( $desc ); ?></textarea>
	<span class="description"><span data-count-for="solevo_meta_description"><?php echo esc_html( mb_strlen( $desc ) ); ?></span> characters</span></p>
	<p><label for="solevo_keyword"><strong>Primary keyword</strong> (internal note, not shown on the site)</label><br>
	<input type="text" id="solevo_keyword" name="solevo_keyword" value="<?php echo esc_attr( $keyword ); ?>" style="width:100%"></p>
	<p><label><input type="checkbox" name="solevo_noindex" value="1" <?php checked( $noindex ); ?>> Hide from Google (noindex, left out of the sitemap)</label></p>
	<script>
	document.querySelectorAll('[data-count-for]').forEach(function (c) {
		var f = document.getElementById(c.dataset.countFor);
		f && f.addEventListener('input', function () { c.textContent = f.value.length; });
	});
	</script>
	<?php
}

function solevo_seo_save( $post_id ) {
	if ( ! isset( $_POST['solevo_seo_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['solevo_seo_nonce'] ), 'solevo_seo' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) || wp_is_post_revision( $post_id ) ) {
		return;
	}
	update_post_meta( $post_id, '_solevo_seo_title', sanitize_text_field( wp_unslash( $_POST['solevo_seo_title'] ?? '' ) ) );
	update_post_meta( $post_id, '_solevo_meta_description', sanitize_textarea_field( wp_unslash( $_POST['solevo_meta_description'] ?? '' ) ) );
	update_post_meta( $post_id, '_solevo_keyword', sanitize_text_field( wp_unslash( $_POST['solevo_keyword'] ?? '' ) ) );
	update_post_meta( $post_id, '_solevo_noindex', ! empty( $_POST['solevo_noindex'] ) );
}
add_action( 'save_post_page', 'solevo_seo_save' );
add_action( 'save_post_post', 'solevo_seo_save' );

/** Post ID whose SEO fields apply to this view: the page or post, or the Posts page on the blog index. */
function solevo_seo_object_id() {
	if ( is_singular( array( 'page', 'post' ) ) ) {
		return get_queried_object_id();
	}
	if ( is_home() && ! is_front_page() ) {
		return (int) get_option( 'page_for_posts' );
	}
	return 0;
}

/* ---------- Front end output ---------- */

add_filter( 'pre_get_document_title', function ( $title ) {
	$id = solevo_seo_object_id();
	if ( solevo_seo_plugin_active() || ! $id ) {
		return $title;
	}
	$custom = get_post_meta( $id, '_solevo_seo_title', true );
	if ( $custom && is_home() && is_paged() ) {
		$custom .= sprintf( ' | Page %d', (int) get_query_var( 'paged' ) );
	}
	if ( ! $custom && is_singular( 'page' ) ) {
		// Fall back to the SEO title in the page definitions (pages added after setup, e.g. surgery rehab).
		$def    = function_exists( 'solevo_page_def' ) ? solevo_page_def() : null;
		$custom = $def['seo_title'] ?? '';
	}
	return $custom ? $custom : $title;
} );

add_action( 'wp_head', function () {
	if ( solevo_seo_plugin_active() ) {
		return;
	}
	$desc = '';
	$seo_id = solevo_seo_object_id();
	if ( $seo_id && ! is_paged() ) {
		$desc = get_post_meta( $seo_id, '_solevo_meta_description', true );
		if ( ! $desc && is_singular( 'post' ) ) {
			$desc = get_the_excerpt( $seo_id );
		}
		if ( ! $desc && is_singular( 'page' ) && function_exists( 'solevo_page_def' ) ) {
			$def  = solevo_page_def();
			$desc = $def['meta'] ?? '';
		}
	}
	if ( ! $desc && is_front_page() ) {
		$desc = get_bloginfo( 'description' );
	}
	if ( $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	}
	// Open Graph basics for link previews.
	if ( is_singular() ) {
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( wp_get_document_title() ) );
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( get_permalink() ) );
		echo is_singular( 'post' ) ? '<meta property="og:type" content="article">' . "\n" : '<meta property="og:type" content="website">' . "\n";
		if ( $desc ) {
			printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		echo '<meta property="og:site_name" content="Solevo Physio &amp; Studio">' . "\n";
		echo '<meta property="og:locale" content="en_AU">' . "\n";
		$img = solevo_og_image( get_queried_object_id() );
		if ( $img ) {
			printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img[0] ) );
			if ( ! empty( $img[1] ) && ! empty( $img[2] ) ) {
				printf( '<meta property="og:image:width" content="%d">' . "\n" . '<meta property="og:image:height" content="%d">' . "\n", (int) $img[1], (int) $img[2] );
			}
			echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		}
	}
}, 2 );

/**
 * Link-preview image: featured image, else the page's hero photo, else its first photo, else the studio photo.
 * Returns array( url, width, height ).
 */
function solevo_og_image( $post_id ) {
	$id = get_post_thumbnail_id( $post_id );
	if ( ! $id ) {
		$content = (string) get_post_field( 'post_content', $post_id );
		if ( preg_match( '/wp:image \{"id":(\d+)[^}]*solevo-hero2__media/', $content, $m ) || preg_match( '/wp-image-(\d+)/', $content, $m ) ) {
			$id = (int) $m[1];
		}
	}
	if ( $id ) {
		$src = wp_get_attachment_image_src( $id, 'large' );
		if ( $src ) {
			return array( $src[0], $src[1], $src[2] );
		}
	}
	return array( get_theme_file_uri( 'assets/images/clinic-reformer-room.jpg' ), 0, 0 );
}

add_filter( 'wp_robots', function ( $robots ) {
	if ( ! solevo_seo_plugin_active() && is_singular( array( 'page', 'post' ) ) && get_post_meta( get_queried_object_id(), '_solevo_noindex', true ) ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
} );

/* ---------- Sitemap ---------- */

add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

add_filter( 'wp_sitemaps_taxonomies', function () {
	return array();
} );

add_filter( 'wp_sitemaps_posts_query_args', function ( $args, $post_type ) {
	if ( in_array( $post_type, array( 'page', 'post' ), true ) ) {
		$args['meta_query'] = array(
			'relation' => 'OR',
			array( 'key' => '_solevo_noindex', 'compare' => 'NOT EXISTS' ),
			array( 'key' => '_solevo_noindex', 'value' => '1', 'compare' => '!=' ),
		);
	}
	return $args;
}, 10, 2 );

// The SEO doc specifies /sitemap.xml.
add_action( 'template_redirect', function () {
	$path = wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ); // phpcs:ignore
	if ( '/sitemap.xml' === $path && ! solevo_seo_plugin_active() ) {
		wp_safe_redirect( home_url( '/wp-sitemap.xml' ), 301 );
		exit;
	}
}, 0 );

// robots.txt points at the sitemap; core handles "discourage search engines" on staging.
add_filter( 'robots_txt', function ( $output, $public ) {
	if ( $public ) {
		$output .= "\nSitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";
	}
	return $output;
}, 10, 2 );

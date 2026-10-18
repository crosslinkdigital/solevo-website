<?php
/**
 * Small helpers that write valid core block markup, used to scaffold the 30 pages.
 *
 * @package Solevo
 */

defined( 'ABSPATH' ) || exit;

function solevo_b_attrs( $attrs ) {
	return $attrs ? ' ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) : '';
}

function solevo_b_p( $html, $class = '' ) {
	$a = $class ? array( 'className' => $class ) : array();
	$c = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return "<!-- wp:paragraph" . solevo_b_attrs( $a ) . " -->\n<p{$c}>{$html}</p>\n<!-- /wp:paragraph -->\n\n";
}

function solevo_b_h( $html, $level = 2, $class = '' ) {
	$a = array();
	if ( 2 !== $level ) {
		$a['level'] = $level;
	}
	if ( $class ) {
		$a['className'] = $class;
	}
	$cls = trim( 'wp-block-heading ' . $class );
	return "<!-- wp:heading" . solevo_b_attrs( $a ) . " -->\n<h{$level} class=\"{$cls}\">{$html}</h{$level}>\n<!-- /wp:heading -->\n\n";
}

function solevo_b_list( $items, $class = '', $ordered = false ) {
	$a = array();
	if ( $ordered ) {
		$a['ordered'] = true;
	}
	if ( $class ) {
		$a['className'] = $class;
	}
	$tag = $ordered ? 'ol' : 'ul';
	$cls = trim( 'wp-block-list ' . $class );
	$li  = '';
	foreach ( $items as $item ) {
		$li .= "<!-- wp:list-item -->\n<li>{$item}</li>\n<!-- /wp:list-item -->";
	}
	return "<!-- wp:list" . solevo_b_attrs( $a ) . " -->\n<{$tag} class=\"{$cls}\">{$li}</{$tag}>\n<!-- /wp:list -->\n\n";
}

/** $buttons: array of [label, href, outline(bool)] */
function solevo_b_buttons( $buttons ) {
	$inner = array();
	foreach ( $buttons as $b ) {
		list( $label, $href ) = $b;
		$outline = ! empty( $b[2] );
		$a       = $outline ? ' {"className":"is-style-outline"}' : '';
		$cls     = $outline ? 'wp-block-button is-style-outline' : 'wp-block-button';
		$inner[] = "<!-- wp:button{$a} -->\n<div class=\"{$cls}\"><a class=\"wp-block-button__link wp-element-button\" href=\"" . esc_attr( $href ) . "\">{$label}</a></div>\n<!-- /wp:button -->";
	}
	return "<!-- wp:buttons -->\n<div class=\"wp-block-buttons\">" . implode( "\n\n", $inner ) . "</div>\n<!-- /wp:buttons -->\n\n";
}

function solevo_b_shortcode( $sc ) {
	return "<!-- wp:shortcode -->\n{$sc}\n<!-- /wp:shortcode -->\n\n";
}

function solevo_b_details( $summary, $answer_html ) {
	return "<!-- wp:details -->\n<details class=\"wp-block-details\"><summary>{$summary}</summary>" . trim( solevo_b_p( $answer_html ) ) . "</details>\n<!-- /wp:details -->\n\n";
}

/** Generic group. $opts: tag, align, class, bg, text, anchor, layout */
function solevo_b_group( $inner, $opts = array() ) {
	$tag    = $opts['tag'] ?? 'div';
	$a      = array();
	$cls    = array( 'wp-block-group' );
	$idattr = '';
	if ( 'div' !== $tag ) {
		$a['tagName'] = $tag;
	}
	if ( ! empty( $opts['anchor'] ) ) {
		$a['anchor'] = $opts['anchor'];
		$idattr      = ' id="' . esc_attr( $opts['anchor'] ) . '"';
	}
	if ( ! empty( $opts['align'] ) ) {
		$a['align'] = $opts['align'];
		$cls[]      = 'align' . $opts['align'];
	}
	if ( ! empty( $opts['bg'] ) ) {
		$a['backgroundColor'] = $opts['bg'];
	}
	if ( ! empty( $opts['text'] ) ) {
		$a['textColor'] = $opts['text'];
	}
	if ( ! empty( $opts['class'] ) ) {
		$a['className'] = $opts['class'];
		$cls[]          = $opts['class'];
	}
	if ( ! empty( $opts['text'] ) ) {
		$cls[] = 'has-' . $opts['text'] . '-color';
	}
	if ( ! empty( $opts['bg'] ) ) {
		$cls[] = 'has-' . $opts['bg'] . '-background-color';
	}
	if ( ! empty( $opts['text'] ) ) {
		$cls[] = 'has-text-color';
	}
	if ( ! empty( $opts['bg'] ) ) {
		$cls[] = 'has-background';
	}
	$a['layout'] = $opts['layout'] ?? array( 'type' => 'constrained' );
	return "<!-- wp:group" . solevo_b_attrs( $a ) . " -->\n<{$tag}{$idattr} class=\"" . implode( ' ', $cls ) . "\">" . trim( $inner ) . "</{$tag}>\n<!-- /wp:group -->\n\n";
}

/** Full-width page section with a wide inner wrapper. */
function solevo_b_section( $inner, $opts = array() ) {
	$wide = solevo_b_group( $inner, array( 'align' => 'wide', 'layout' => array( 'type' => 'default' ), 'class' => $opts['inner_class'] ?? '' ) );
	return solevo_b_group( $wide, array(
		'tag'    => 'section',
		'align'  => 'full',
		'class'  => trim( 'solevo-section ' . ( $opts['class'] ?? '' ) ),
		'bg'     => $opts['bg'] ?? '',
		'text'   => $opts['text'] ?? '',
		'anchor' => $opts['anchor'] ?? '',
	) );
}

function solevo_b_columns( $cols, $class = '' ) {
	$a   = array( 'align' => 'wide' );
	$cls = 'wp-block-columns alignwide';
	if ( $class ) {
		$a['className'] = $class;
		$cls           .= ' ' . $class;
	}
	$inner = '';
	foreach ( $cols as $c ) {
		$inner .= "<!-- wp:column -->\n<div class=\"wp-block-column\">" . trim( $c ) . "</div>\n<!-- /wp:column -->\n\n";
	}
	return "<!-- wp:columns" . solevo_b_attrs( $a ) . " -->\n<div class=\"{$cls}\">" . trim( $inner ) . "</div>\n<!-- /wp:columns -->\n\n";
}

/** Rendered markup of a theme pattern file (re-evaluated so imported image IDs are used). */
function solevo_pattern_markup( $slug ) {
	$file = SOLEVO_DIR . '/patterns/' . $slug . '.php';
	if ( ! file_exists( $file ) ) {
		return '';
	}
	ob_start();
	include $file;
	return trim( ob_get_clean() ) . "\n\n";
}

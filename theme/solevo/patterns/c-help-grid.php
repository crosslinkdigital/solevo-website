<?php
/**
 * Title: Question boxes
 * Slug: solevo/c-help-grid
 * Categories: solevo-components
 * Description: Tap-to-open boxes for conditions or questions, each with links and a booking link.
 * Viewport width: 1400
 */
echo solevo_c_help_grid( solevo_c_head( 'Where it hurts', 'What can we help you with?', '[Short intro.]' ), array( array( 'icon' => 'back', 'title' => '[Area or question]', 'hint' => '[Three common examples]', 'body' => '[Two sentences in plain language.]', 'links' => array( solevo_c_link( 'conditions/lower-back-pain' ) ) ), array( 'icon' => 'sport', 'title' => '[Area or question]', 'hint' => '[Three common examples]', 'body' => '[Two sentences in plain language.]' ), array( 'icon' => 'strength', 'title' => '[Area or question]', 'hint' => '[Three common examples]', 'body' => '[Two sentences in plain language.]' ) ) ); // phpcs:ignore

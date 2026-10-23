<?php
/**
 * Title: Service cards
 * Slug: solevo/c-service-cards
 * Categories: solevo-components
 * Description: Grid of service cards with a link to each child page or a booking link.
 * Viewport width: 1400
 */
echo solevo_c_service_cards( solevo_c_head( 'Our services', '[Section title]', '[Short intro.]' ), array( array( 'title' => '[Service]', 'text' => '[One or two lines.]', 'more' => array( 'Learn more', '#' ) ), array( 'title' => '[Service]', 'text' => '[One or two lines.]', 'more' => array( 'Learn more', '#' ) ), array( 'title' => '[Service]', 'text' => '[One or two lines.]', 'more' => array( 'Book Physio', '#cliniko' ) ) ) ); // phpcs:ignore

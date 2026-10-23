<?php
/**
 * Title: Fees, funding and FAQs
 * Slug: solevo/c-fees-faq
 * Categories: solevo-components
 * Description: Fee card with funding notes beside an FAQ accordion.
 * Viewport width: 1400
 */
echo solevo_c_fees_faq( solevo_c_head( 'Fees and FAQs', '[Fees and common questions]' ), array( array( '[Appointment]', '[Short note]', '$0' ) ), array( '[Funding note]' ), array( array( '[Question]', '[Answer in two to four sentences.]' ), array( '[Question]', '[Answer in two to four sentences.]' ) ) ); // phpcs:ignore

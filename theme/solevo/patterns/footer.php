<?php
/**
 * Title: Footer
 * Slug: solevo/footer
 * Categories: solevo
 * Inserter: no
 * Viewport width: 1400
 *
 * 1.3.7: same structure as The Foot Company footer (logo and contact, links, both clinics with maps and hours).
 * Addresses, hours and phone come from Settings > Solevo.
 */
?>
<!-- wp:group {"className":"solevo-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group solevo-footer"><!-- wp:group {"align":"wide","className":"solevo-footer__top","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group alignwide solevo-footer__top"><!-- wp:image {"width":"200px","sizeSlug":"full","linkDestination":"custom","className":"solevo-footer__logo"} -->
<figure class="wp-block-image size-full is-resized solevo-footer__logo"><a href="/"><img src="<?php echo esc_url( SOLEVO_URI . '/assets/images/solevo-logo-white.png' ); ?>" alt="Solevo Physio &amp; Studio home" style="width:200px"/></a></figure>
<!-- /wp:image -->

<!-- wp:shortcode -->
[solevo_footer_contact]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:separator {"align":"wide","className":"solevo-footer__line"} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity solevo-footer__line"/>
<!-- /wp:separator -->

<!-- wp:columns {"align":"wide","className":"solevo-footer__grid"} -->
<div class="wp-block-columns alignwide solevo-footer__grid"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"solevo-floc__label"} -->
<p class="solevo-floc__label">Physio</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"solevo-footer__links"} -->
<ul class="wp-block-list solevo-footer__links"><!-- wp:list-item -->
<li><a href="/physio/sports-physiotherapy">Sports injury physio</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/physio">General physio</a></li>
<!-- /wp:list-item -->
<?php $solevo_surg = get_page_by_path( 'physio/pre-and-post-surgery-rehab' ); if ( $solevo_surg && 'publish' === $solevo_surg->post_status ) : ?>
<!-- wp:list-item -->
<li><a href="/physio/pre-and-post-surgery-rehab">Pre and post surgery rehab</a></li>
<!-- /wp:list-item -->
<?php endif; ?>
<!-- wp:list-item -->
<li><a href="/physio/pregnancy-physiotherapy">Pregnancy and postnatal</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/physio/seniors-physiotherapy">Physio for seniors</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/conditions">Conditions we treat</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"solevo-floc__label"} -->
<p class="solevo-floc__label">Studio</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"solevo-footer__links"} -->
<ul class="wp-block-list solevo-footer__links"><!-- wp:list-item -->
<li><a href="/pilates">Pilates classes</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/pilates/seniors">Seniors Pilates</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/pilates/clinical-pilates">Clinical Pilates</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"solevo-floc__label"} -->
<p class="solevo-floc__label">Solevo</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"solevo-footer__links"} -->
<ul class="wp-block-list solevo-footer__links"><!-- wp:list-item -->
<li><a href="/about">About us</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/contact">Contact</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="/book">Book online</a></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><a href="#tfc">The Foot Company podiatry</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide","className":"solevo-footer__line"} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity solevo-footer__line"/>
<!-- /wp:separator -->

<!-- wp:group {"align":"wide","className":"solevo-footer__find","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide solevo-footer__find"><!-- wp:shortcode -->
[solevo_footer_locations]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"solevo-footer__base","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide solevo-footer__base"><!-- wp:shortcode -->
[solevo_copyright]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[solevo_social label="Brookvale and Terrey Hills"]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

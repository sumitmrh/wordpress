<?php
/*
 * Template Name: Front Page Template
 */
get_header();
?>
<?php hillstar_theme()->get( 'front-page-content' )->render(); ?>

<?php get_footer();

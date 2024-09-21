<?php
/**
 * Defaults for Theme Customizer repeater.
 *
 * @package webenvo
 */


/** SLIDER CUSTOMIZER REPEATER DEFAULT VALUES */
define(
	'SLIDER_DEFAULTS',
	wp_json_encode(
		array(
			/*Repeater's first item*/
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/slider/slide1.jpg',
				'title'     => 'We Want You To Succeed',
				'subtitle'  => 'Grow Your Business',
				'text'      => 'Making Your Business Successful isn’t easy. That’s why Webenvo is here to help you with, to make it grow and attract Clients and make it bold.',
				'btntitle'  => 'Make it Successful Now',
				'link'      => '#',
				'id'        => 'cr_slider_slide_2',
			), // every item in default string should have an unique id, it helps for translation.
			/*Repeater's second item*/
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/slider/slide2.jpg',
				'title'     => 'Building Business Effective',
				'subtitle'  => 'Delivering Promises',
				'text'      => 'Webenvo Group is all about strategy, we’re here to inform which tactics need funding and improvement and which are drains on resources.',
				'btntitle'  => 'View Our Portfolio',
				'link'      => '#',
				'id'        => 'cr_slider_slide_1',
			),
		)
	)
);
/** SERVICES CUSTOMIZER REPEATER DEFAULT VALUES */
define(
	'SERVICES_DEFAULTS',
	wp_json_encode(
		array(
			/*Repeater's first Service*/
			array(
				'choice' 	 => 'customizer_repeater_image',
				'image_url'  => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/service/service1.png',
				'title'      => 'Strategic Consulting Services',
				'subtitle'   => 'Our strategic consulting services provide businesses with expert guidance and insights to develop robust strategies.',
				'btntitle'   => 'Read More',
				'link'       => '#',
				'id'         => 'cr_serv_1',
			), // every Service in default string should have an unique id, it helps for translation.
				/*Repeater's second Service*/
			array(
				'choice' 	 => 'customizer_repeater_image',
				'image_url'  => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/service/service2.png',
				'title'      => 'Employee Training and Development',
				'subtitle'   => 'Investing in your employees` professional growth is crucial for building a skilled and motivated workforce.',
				'btntitle'   => 'Read More',
				'link'       => '#',
				'id'         => 'cr_serv_2',
			),
			/*Repeater's Third Service*/
			array(
				'choice' 	 => 'customizer_repeater_image',
				'image_url'  => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/service/service3.png',
				'title'      => 'Market Research and Analysis',
				'subtitle'   => 'In-depth market research and analysis are essential for businesses to understand their target market, and identify opportunities.',
				'btntitle'   => 'Read More',
				'link'       => '#',
				'id'         => 'cr_serv_3',
			),
		)
	)
);
/** PORTFOLIO_DEFAULTS CUSTOMIZER REPEATER DEFAULT VALUES */
define(
	'PORTFOLIO_DEFAULTS',
	wp_json_encode(
		array(
			/* Repeater's first portfolio */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/portfolio/project-1.jpg',
				'title'     => 'Website Building',
				'subtitle'  => 'Digital Transformation',
				'link'      => '#',
				'link2'     => '#',
				'id'        => 'cr_portfolio_1',
			), // every portfolio in default string should have an unique id, it helps for translation.
			/* Repeater's second portfolio */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/portfolio/project-2.jpg',
				'title'     => 'Integration',
				'subtitle'  => 'Merger or Acquisition',
				'link'      => '#',
				'link2'     => '#',
				'id'        => 'cr_portfolio_2',
			),
			/* Repeater's Third portfolio */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/portfolio/project-3.jpg',
				'title'     => 'Production',
				'subtitle'  => 'Supply Chain Optimization',
				'link'      => '#',
				'link2'     => '#',
				'id'        => 'cr_portfolio_3',
			),
		)
	)
);
/** TEAM_DEFAULTS CUSTOMIZER REPEATER DEFAULT VALUES */

define(
	'TEAM_SR_DEFAULTS',
	'[{&quot;icon&quot;:&quot;fa-brands fa-facebook&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;customizer-repeater-social-repeater-6317390b67c40&quot;},{&quot;icon&quot;:&quot;fa-brands fa-twitter&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;customizer-repeater-social-repeater-63173a9132e14&quot;},{&quot;icon&quot;:&quot;fa-brands fa-linkedin-in&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;customizer-repeater-social-repeater-6317422a80a22&quot;},{&quot;icon&quot;:&quot;fa-brands fa-instagram&quot;,&quot;link&quot;:&quot;#&quot;,&quot;id&quot;:&quot;customizer-repeater-social-repeater-6317422a80a22&quot;}]'
);

define(
	'TEAM_DEFAULTS',
	wp_json_encode(
		array(
			/* Repeater's first team */
			array(
				'image_url'       => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/team/team1.jpg',
				'title'           => 'Chief Executive Officer (CEO)',
				'subtitle'        => 'Sterling Blackwood',
				'social_repeater' => TEAM_SR_DEFAULTS,
				'id'              => 'cr_team_1',
			), // every team in default string should have an unique id, it helps for translation.
		/* Repeater's second team */
			array(
				'image_url'       => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/team/team2.jpg',
				'title'           => 'Vice President (VP)',
				'subtitle'        => 'Seraphina Winters',
				'social_repeater' => TEAM_SR_DEFAULTS,
				'id'              => 'cr_team_2',
			),
			/* Repeater's Third team */
			array(
				'image_url'       => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/team/team3.jpg',
				'title'           => 'Manager',
				'subtitle'        => 'Maximillian Sterling',
				'social_repeater' => TEAM_SR_DEFAULTS,
				'id'              => 'cr_team_3',
			),
			/* Repeater's fourth team */
			array(
				'image_url'       => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/team/team4.jpg',
				'title'           => 'Accountant',
				'subtitle'        => 'Willow Sinclair',
				'social_repeater' => TEAM_SR_DEFAULTS,
				'id'              => 'cr_team_4',
			),
		)
	)
);
/** TESTIMONIAL DEFAULTS FOR CUSTOMIZER REPEATER */
define(
	'TESTIMONIAL_DEFAULTS',
	wp_json_encode(
		array(
			/* Repeater's first Testimonial */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/testimonial/author-1.jpg',
				'title'     => 'Exceptional and Commendable',
				'subtitle'  => 'This company sets the bar for excellence in every aspect. Their dedication to quality and customer satisfaction is unmatched.',
				'btntitle'  => 'Mr.Robinson',
				'shortcode' => 'CEO Ink.crop',
				'id'        => 'cr_Testimonial_1',
			), // every Testimonial in default string should have an unique id, it helps for translation.
		/* Repeater's second Testimonial */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/testimonial/author-2.jpg',
				'title'     => 'Very Professional & Trust-Worthy',
				'subtitle'  => 'I am continually impressed by the exceptional service and top-notch products provided by this company. They truly go above and beyond to expectations.',
				'btntitle'  => 'Miss Jane Watson',
				'shortcode' => 'Founder abc firm ',
				'id'        => 'cr_Testimonial_2',
			),
			/* Repeater's third Testimonial */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/testimonial/author-3.jpg',
				'title'     => 'They have best team at work',
				'subtitle'  => 'I have been a loyal customer of this company for years, and they have never let me down. Their professionalism, integrity, and commitment to customer satisfaction.',
				'btntitle'  => 'Sonya Smith',
				'shortcode' => 'Business Owner',
				'id'        => 'cr_Testimonial_3',
			),
		)
	)
);
/** FUNFACT_DEFAULTS DEFAULTS FOR CUSTOMIZER REPEATER */
define(
	'FUNFACT_DEFAULTS',
	wp_json_encode(
		array(
			/* Repeater's first Funfact */
			array(
				'icon_value' => 'fas fa-square-poll-vertical',
				'title'      => 'Satisfied Customers',
				'subtitle'   => '965',
				'id'         => 'cr_Funfact_1',
			), // every Funfact in default string should have an unique id, it helps for translation.
		/* Repeater's second Funfact */
			array(
				'icon_value' => 'fa fa-passport',
				'title'      => 'Finish Projects',
				'subtitle'   => '365',
				'id'         => 'cr_Funfact_2',
			),
			/* Repeater's third Funfact */
			array(
				'icon_value' => 'fa fa-file-code',
				'title'      => 'Working Days',
				'subtitle'   => '450',
				'id'         => 'cr_Funfact_3',
			),
			/** Repeater's fourth funfact */
			array(
				'icon_value' => 'fa fa-beer-mug-empty',
				'title'      => 'Cups of Coffee',
				'subtitle'   => '585',
				'id'         => 'cr_Funfact_3',
			),
		)
	)
);
/** SPONSORS_DEFAULT DEFAULTS FOR CUSTOMIZER REPEATER */
define(
	'SPONSORS_DEFAULT',
	wp_json_encode(
		array(
			/* Repeater's first sponsors */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/clients/client-1.png',
				'title'     => 'Qatar',
				'link'      => '#',
				'id'        => 'cr_sponsors_1',
			), // every sponsors in default string should have an unique id, it helps for translation.
		/* Repeater's second sponsors */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/clients/client-2.png',
				'title'     => 'Car Sport',
				'link'      => '#',
				'id'        => 'cr_sponsors_2',
			),
			/* Repeater's Third sponsors */
			array(
				'image_url' => ENVO_COMPANION_PLUGIN_URL. '/inc/webenvo/img/clients/client-3.png',
				'title'     => 'Genshin',
				'link'      => '#',
				'id'        => 'cr_sponsors_3',
			),
		)
	)
);

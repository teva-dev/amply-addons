<?php
/**
 * Section Templates
 *
 * @package amply-addons
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Amply_Section_Templates class
 */
class Amply_Addons_Section_Templates {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	private static $instance;

	/**
	 * Getter
	 *
	 * @return Init
	 */
	public static function get_instance() {

		if ( null === static::$instance ) {
				static::$instance = new static();
		}
		return static::$instance;

	}

	/**
	 * Constructor
	 */
	private function __construct() {

		add_action( 'init', array( $this, 'header_post_type' ) );

		// // phpcs:disable
		// add_action( 'init', array( $this, 'register_header_template' ) );
		// // phpcs:enable

		add_action( 'init', array( $this, 'banner_post_type' ) );

		add_action( 'init', array( $this, 'sidebar_post_type' ) );

		add_action( 'init', array( $this, 'footer_post_type' ) );

		add_action( 'init', array( $this, 'mobile_post_type' ) );

		add_action( 'init', array( $this, 'slideout_post_type' ) );

		// Filter the allowed blocks for section CPT.
		add_filter( 'allowed_block_types', array( $this, 'section_allowed_block_types' ), 10, 2 );

		if ( is_admin() ) {

			add_action( 'admin_menu', array( $this, 'add_menu_page' ), 0 );
			add_action( 'admin_menu', array( $this, 'add_header_submenu_page' ), 1 );
			add_action( 'admin_menu', array( $this, 'add_banner_submenu_page' ), 1 );
			add_action( 'admin_menu', array( $this, 'add_sidebar_submenu_page' ), 1 );
			add_action( 'admin_menu', array( $this, 'add_footer_submenu_page' ), 1 );
			add_action( 'admin_menu', array( $this, 'add_mobile_submenu_page' ), 1 );
			add_action( 'admin_menu', array( $this, 'add_slideout_submenu_page' ), 1 );

			// Custom block editor style for each section cpt.
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_styles' ) );

		}

	}

	/**
	 * Register header post type
	 */
	public function header_post_type() {

		// Register the post type.
		register_post_type(
			'amply_header_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'headers' ),
					'singular_name'      => __( 'header' ),
					'add_new'            => __( 'New Header' ),
					'add_new_item'       => __( 'Add New Header' ),
					'edit_item'          => __( 'Edit Header' ),
					'new_item'           => __( 'New Header' ),
					'view_item'          => __( 'View Header' ),
					'search_items'       => __( 'Search Headers' ),
					'not_found'          => __( 'No Headers Found' ),
					'not_found_in_trash' => __( 'No Headers found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Register header cpt template
	 */
	public function register_header_template() {

		$post_type_object = get_post_type_object( 'amply_header_cpt' );

		$post_type_object->template = array(
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Paragraphe text…',
				),
			),
		);

	}

	/**
	 * Register banner post type
	 */
	public function banner_post_type() {

		// Register the post type.
		register_post_type(
			'amply_banner_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'banners' ),
					'singular_name'      => __( 'banner' ),
					'add_new'            => __( 'New Banner' ),
					'add_new_item'       => __( 'Add New Banner' ),
					'edit_item'          => __( 'Edit Banner' ),
					'new_item'           => __( 'New Banner' ),
					'view_item'          => __( 'View Banner' ),
					'search_items'       => __( 'Search Banners' ),
					'not_found'          => __( 'No Banners Found' ),
					'not_found_in_trash' => __( 'No Banners found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Register sidebar post type
	 */
	public function sidebar_post_type() {

		// Register the post type.
		register_post_type(
			'amply_sidebar_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'sidebars' ),
					'singular_name'      => __( 'sidebar' ),
					'add_new'            => __( 'New Sidebar' ),
					'add_new_item'       => __( 'Add New Sidebar' ),
					'edit_item'          => __( 'Edit Sidebar' ),
					'new_item'           => __( 'New Sidebar' ),
					'view_item'          => __( 'View Sidebar' ),
					'search_items'       => __( 'Search Sidebars' ),
					'not_found'          => __( 'No Sidebars Found' ),
					'not_found_in_trash' => __( 'No Sidebars found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Register footer post type
	 */
	public function footer_post_type() {

		// Register the post type.
		register_post_type(
			'amply_footer_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'footers' ),
					'singular_name'      => __( 'footer' ),
					'add_new'            => __( 'New Footer' ),
					'add_new_item'       => __( 'Add New Footer' ),
					'edit_item'          => __( 'Edit Footer' ),
					'new_item'           => __( 'New Footer' ),
					'view_item'          => __( 'View Footer' ),
					'search_items'       => __( 'Search Footers' ),
					'not_found'          => __( 'No Footers Found' ),
					'not_found_in_trash' => __( 'No Footers found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Register mobile post type
	 */
	public function mobile_post_type() {

		// Register the post type.
		register_post_type(
			'amply_mobile_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'mobile menus' ),
					'singular_name'      => __( 'mobile menu' ),
					'add_new'            => __( 'New Mobile Menu' ),
					'add_new_item'       => __( 'Add New Mobile Menu' ),
					'edit_item'          => __( 'Edit Mobile Menu' ),
					'new_item'           => __( 'New Mobile Menu' ),
					'view_item'          => __( 'View Mobile Menu' ),
					'search_items'       => __( 'Search Mobile Menus' ),
					'not_found'          => __( 'No Mobile Menus Found' ),
					'not_found_in_trash' => __( 'No Mobile Menus found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Register slideout panel post type
	 */
	public function slideout_post_type() {

		// Register the post type.
		register_post_type(
			'amply_slideout_cpt',
			array(
				'labels'              => array(
					'name'               => __( 'slide-out panels' ),
					'singular_name'      => __( 'slide-out panel' ),
					'add_new'            => __( 'New Slide-out Panel' ),
					'add_new_item'       => __( 'Add New Slide-out Panel' ),
					'edit_item'          => __( 'Edit Slide-out Panel' ),
					'new_item'           => __( 'New Slide-out Panel' ),
					'view_item'          => __( 'View Slide-out Panel' ),
					'search_items'       => __( 'Search Slide-out Panels' ),
					'not_found'          => __( 'No Slide-out Panels Found' ),
					'not_found_in_trash' => __( 'No Slide-out Panels found in Trash' ),
				),
				'menu_position'       => 30,
				'public'              => true,
				'has_archive'         => true,
				'hierarchical'        => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'rewrite'             => false,
				'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Filter allowed blocks for the section cpt
	 *
	 * @param array  $allowed_block_types Array of allowed blocks.
	 * @param string $post Post.
	 */
	public function section_allowed_block_types( $allowed_block_types, $post ) {

		if ( 'amply_header_cpt' === $post->post_type
		|| 'amply_banner_cpt' === $post->post_type
		|| 'amply_sidebar_cpt' === $post->post_type
		|| 'amply_footer_cpt' === $post->post_type
		|| 'amply_mobile_cpt' === $post->post_type
		|| 'amply_slideout_cpt' === $post->post_type ) {
			return [
				'core/audio',
				'core/button',
				'core/code',
				'core/columns',
				'core/cover-image',
				'core/embed',
				'core/file',
				'core/gallery',
				'core/image',
				'core/paragraph',
				'core/preformatted',
				'core/pullquote',
				'core/quote',
				'core/separator',
				'core/subhead',
				'core/table',
				'core/verse',

				'core/archives',
				'core/categories',
				'core/latest-posts',
				'core/latest-comments',
				'core/shortcode',
			];
		}

	}

	/**
	 * Register a new menu page for section templates panel
	 */
	public function add_menu_page() {

		add_menu_page(
			esc_html__( 'Section Templates', 'amply-addons' ),
			'Section Templates', // This menu cannot be translated because it's used for the $hook prefix.
			apply_filters( 'amply_section_templates_capabilities', 'manage_options' ),
			'amply-section-templates-panel',
			'',
			AMPLY_THEME_URI . '/assets/images/sunset-icon.png',
			110
		);

	}

	/**
	 * Add sub menu page for header cpt
	 */
	public function add_header_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Headers', 'amply-addons' ),
			esc_html__( 'Headers', 'amply-addons' ),
			'manage_options',
			'edit.php?post_type=amply_header_cpt'
		);

	}

	/**
	 * Add sub menu page for banner cpt
	 */
	public function add_banner_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Banners', 'amply' ),
			esc_html__( 'Banners', 'amply' ),
			'manage_options',
			'edit.php?post_type=amply_banner_cpt'
		);

	}

	/**
	 * Add sub menu page for sidebar cpt
	 */
	public function add_sidebar_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Sidebars', 'amply-addons' ),
			esc_html__( 'Sidebars', 'amply-addons' ),
			'manage_options',
			'edit.php?post_type=amply_sidebar_cpt'
		);

	}

	/**
	 * Add sub menu page for footer cpt
	 */
	public function add_footer_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Footers', 'amply-addons' ),
			esc_html__( 'Footers', 'amply-addons' ),
			'manage_options',
			'edit.php?post_type=amply_footer_cpt'
		);

	}

	/**
	 * Add sub menu page for mobile cpt
	 */
	public function add_mobile_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Mobile Menus', 'amply-addons' ),
			esc_html__( 'Mobile Menus', 'amply-addons' ),
			'manage_options',
			'edit.php?post_type=amply_mobile_cpt'
		);

	}

	/**
	 * Add sub menu page for slideout cpt
	 */
	public function add_slideout_submenu_page() {

		add_submenu_page(
			'amply-section-templates-panel',
			esc_html__( 'Slide-out Panels', 'amply-addons' ),
			esc_html__( 'Slide-out Panels', 'amply-addons' ),
			'manage_options',
			'edit.php?post_type=amply_slideout_cpt'
		);

	}

	/**
	 * Enqueue cpt block editor styles.
	 */
	public function enqueue_block_editor_styles() {

		$screen = get_current_screen();

		if ( is_object( $screen ) ) {

			switch ( $screen->post_type ) {

				// Add header cpt style.
				case 'amply_header_cpt':
					wp_enqueue_style( 'amply-header-editor-style', plugins_url( '/css/header-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

				// Add banner cpt style.
				case 'amply_banner_cpt':
					wp_enqueue_style( 'amply-banner-editor-style', plugins_url( '/css/banner-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

				// Add sidebar cpt style.
				case 'amply_sidebar_cpt':
					wp_enqueue_style( 'amply-sidebar-editor-style', plugins_url( '/css/sidebar-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

				// Add footer cpt style.
				case 'amply_footer_cpt':
					wp_enqueue_style( 'amply-footer-editor-style', plugins_url( '/css/footer-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

				// Add mobile cpt style.
				case 'amply_mobile_cpt':
					wp_enqueue_style( 'amply-mobile-menu-editor-style', plugins_url( '/css/mobile-menu-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

				// Add slideout cpt style.
				case 'amply_slideout_cpt':
					wp_enqueue_style( 'amply-slideout-panel-editor-style', plugins_url( '/css/slideout-panel-editor-style.css', __FILE__ ), array(), AMPLY_THEME_VERSION );
					break;

			}
		}

	}

}
Amply_Addons_Section_Templates::get_instance();

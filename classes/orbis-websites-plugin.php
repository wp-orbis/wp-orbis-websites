<?php

class Orbis_Websites_Plugin extends Orbis_Plugin {
	public function __construct( $file ) {
		parent::__construct( $file );

		$this->set_name( 'orbis-websites' );
		$this->set_db_version( '1.0.0' );

		// general hooks
		add_action( 'init', array( $this, 'init' ) );

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

		add_action( 'save_post_orbis_website', array( $this, 'save_post' ) );

		add_filter( 'the_content', array( $this, 'extend_website_content' ) );
	}

	//////////////////////////////////////////////////

	/**
	 * Add meta boxes
	 */
	public function add_meta_boxes( $post_type ) {
		add_meta_box(
			'orbis_website_details',
			__( 'Website Details', 'orbis-websites' ),
			array( $this, 'meta_box_details' ),
			'orbis_website',
			'normal',
			'high'
		);
	}

	public function meta_box_details( $post ) {
		include plugin_dir_path( $this->file ) . '/admin/meta-box-website-details.php';
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save_post( $post_id ) {
		// Nonce
		if ( ! filter_has_var( INPUT_POST, 'orbis_website_details_meta_box_nonce' ) ) {
			return $post_id;
		}

		check_admin_referer( 'orbis_save_website_details', 'orbis_website_details_meta_box_nonce' );

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		/* OK, its safe for us to save the data now. */
		$definition = array(
			'_orbis_website_url'              => FILTER_VALIDATE_URL,
			'_orbis_website_host'             => FILTER_SANITIZE_STRING,
			'_orbis_website_host_keychain_id' => FILTER_SANITIZE_STRING,
			'_orbis_website_root_path'        => FILTER_SANITIZE_STRING,
			'_orbis_website_public_path'      => FILTER_SANITIZE_STRING,
			'_orbis_website_has_wp_cli'       => FILTER_VALIDATE_BOOLEAN,
			'_orbis_website_git_url'          => FILTER_SANITIZE_STRING,
			'_orbis_website_infinitewp_id'    => FILTER_SANITIZE_STRING,
			'_orbis_website_wp_keychain_id'   => FILTER_SANITIZE_STRING,
			'_orbis_website_monitor_id'       => FILTER_SANITIZE_STRING,
		);

		$data = filter_input_array( INPUT_POST, $definition );

		foreach ( $data as $key => $value ) {
			if ( empty( $value ) ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}

	public function loaded() {
		$this->load_textdomain( 'orbis-websites', '/languages/' );
	}

	public function init() {
		register_post_type( 'orbis_website', array(
			'labels'             => array(
				'name'               => _x( 'Websites', 'post type general name', 'orbis-websites' ),
				'singular_name'      => _x( 'Website', 'post type singular name', 'orbis-websites' ),
				'menu_name'          => _x( 'Websites', 'admin menu', 'orbis-websites' ),
				'name_admin_bar'     => _x( 'Website', 'add new on admin bar', 'orbis-websites' ),
				'add_new'            => _x( 'Add New', 'website', 'orbis-websites' ),
				'add_new_item'       => __( 'Add New Website', 'orbis-websites' ),
				'new_item'           => __( 'New Website', 'orbis-websites' ),
				'edit_item'          => __( 'Edit Website', 'orbis-websites' ),
				'view_item'          => __( 'View Website', 'orbis-websites' ),
				'all_items'          => __( 'All Websites', 'orbis-websites' ),
				'search_items'       => __( 'Search Websites', 'orbis-websites' ),
				'parent_item_colon'  => __( 'Parent Website:', 'orbis-websites' ),
				'not_found'          => __( 'No websites found.', 'orbis-websites' ),
				'not_found_in_trash' => __( 'No websites found in Trash.', 'orbis-websites' ),
			),
			'description'        => __( 'Description.', 'orbis-websites' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'websites' ),
			'menu_icon'          => 'dashicons-admin-home',
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array(
				'title',
				'author',
				'comments',
				'page-attributes',
			),
		) );
	}

	public function extend_website_content( $content ) {
		if ( 'orbis_website' !== get_post_type() ) {
			return $content;
		}

		ob_start();

		include plugin_dir_path( $this->file ) . 'templates/content.php';

		$extend = ob_get_clean();

		$content .= $extend;

		return $content;
	}
}

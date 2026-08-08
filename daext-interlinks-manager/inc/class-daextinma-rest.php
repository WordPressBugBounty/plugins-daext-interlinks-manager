<?php
/**
 * Here the REST API endpoint of the plugin are registered.
 *
 * @package daext-interlinks-manager
 */

/**
 * This class should be used to work with the REST API endpoints of the plugin.
 */
class Daextinma_Rest {

	/**
	 * The singleton instance of the class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * An instance of the shared class.
	 *
	 * @var Daextrevop_Shared|null
	 */
	private $shared = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// Assign an instance of the shared class.
		$this->shared = Daextinma_Shared::get_instance();

		/**
		 * Add custom routes to the Rest API.
		 */
		add_action( 'rest_api_init', array( $this, 'rest_api_register_route' ) );
	}

	/**
	 * Create a singleton instance of the class.
	 *
	 * @return self|null
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Add custom routes to the Rest API.
	 *
	 * @return void
	 */
	public function rest_api_register_route() {

		// Add the POST 'interlinks-manager-pro/v1/read-options/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/read-options/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_read_options_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_options_callback_permission_check' ),
			)
		);

		// Add the POST 'interlinks-manager-pro/v1/options/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/options',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_update_options_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_update_options_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/statistics/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/statistics/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_read_statistics_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_statistics_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/juice/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/juice/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_read_juice_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_juice_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/juice-url/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/juice-url/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_read_juice_url_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_juice_url_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/http-status/' endpoint to the Rest API.
		register_rest_route(
			'daext-interlinks-manager/v1',
			'/http-status/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_interlinks_manager_read_http_status_callback' ),
				'permission_callback' => array( $this, 'rest_api_daext_interlinks_manager_read_http_status_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/dashboard-menu-export-csv/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/dashboard-menu-export-csv/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_dashboard_menu_export_csv_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_statistics_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/juice-menu-export-csv/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/juice-menu-export-csv/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_juice_menu_export_csv_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_juice_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/anchors-menu-export-csv/' endpoint to the Rest API.
		register_rest_route(
			'interlinks-manager-pro/v1',
			'/anchors-menu-export-csv/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_interlinks_manager_pro_anchors_menu_export_csv_callback' ),
				'permission_callback' => array( $this, 'rest_api_interlinks_manager_pro_read_juice_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/http-status-menu-export-csv/' endpoint to the Rest API.
		register_rest_route(
			'daext-interlinks-manager/v1',
			'/http-status-menu-export-csv/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_interlinks_manager_http_status_menu_export_csv_callback' ),
				'permission_callback' => array( $this, 'rest_api_daext_interlinks_manager_read_http_status_callback_permission_check' ),
			)
		);

		// Add the POST 'daext-interlinks-manager/v1/generate-interlinks-optimization/' endpoint to the Rest API.
		register_rest_route(
			'daext-interlinks-manager/v1',
			'/generate-interlinks-optimization/',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'rest_api_daext_interlinks_manager_generate_interlinks_optimization_callback' ),
				'permission_callback' => array( $this, 'rest_api_daext_interlinks_manager_generate_interlinks_optimization_callback_permission_check' ),
			)
		);
	}

	/**
	 * Callback for the GET 'interlinks-manager-pro/v1/options' endpoint of the Rest API.
	 *
	 *   This method is in the following contexts:
	 *
	 *  - To retrieve the plugin options in the "Options" menu.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_read_options_callback() {

		// Generate the response.
		$response = array();
		foreach ( $this->shared->get( 'options' ) as $key => $value ) {
			$response[ $key ] = get_option( $key );
		}

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_interlinks_manager_pro_read_options_callback_permission_check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'rest_read_error',
				'Sorry, you are not allowed to read the Interlinks Manager options.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/options' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 *  - To update the plugin options in the "Options" menu.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_update_options_callback( $request ) {

		// get and sanitize data --------------------------------------------------------------------------------------.

		$options = array();

		// Link Analysis ------------------------------------------------------------------------------------------.

		// Juice.
		$options['daextinma_default_seo_power']                = $request->get_param( 'daextinma_default_seo_power' ) !== null ? intval( $request->get_param( 'daextinma_default_seo_power' ), 10 ) : null;
		$options['daextinma_penality_per_position_percentage'] = $request->get_param( 'daextinma_penality_per_position_percentage' ) !== null ? intval( $request->get_param( 'daextinma_penality_per_position_percentage' ), 10 ) : null;
		$options['daextinma_remove_link_to_anchor']            = $request->get_param( 'daextinma_remove_link_to_anchor' ) !== null ? intval( $request->get_param( 'daextinma_remove_link_to_anchor' ), 10 ) : null;
		$options['daextinma_remove_url_parameters']            = $request->get_param( 'daextinma_remove_url_parameters' ) !== null ? intval( $request->get_param( 'daextinma_remove_url_parameters' ), 10 ) : null;

		// Technical Options.
		$options['daextinma_set_max_execution_time']               = $request->get_param( 'daextinma_set_max_execution_time' ) !== null ? intval( $request->get_param( 'daextinma_set_max_execution_time' ), 10 ) : null;
		$options['daextinma_max_execution_time_value']             = $request->get_param( 'daextinma_max_execution_time_value' ) !== null ? intval( $request->get_param( 'daextinma_max_execution_time_value' ), 10 ) : null;
		$options['daextinma_set_memory_limit']                     = $request->get_param( 'daextinma_set_memory_limit' ) !== null ? intval( $request->get_param( 'daextinma_set_memory_limit' ), 10 ) : null;
		$options['daextinma_memory_limit_value']                   = $request->get_param( 'daextinma_memory_limit_value' ) !== null ? intval( $request->get_param( 'daextinma_memory_limit_value' ), 10 ) : null;
		$options['daextinma_limit_posts_analysis']                 = $request->get_param( 'daextinma_limit_posts_analysis' ) !== null ? intval( $request->get_param( 'daextinma_limit_posts_analysis' ), 10 ) : null;
		$options['daextinma_dashboard_post_types']                 = $request->get_param( 'daextinma_dashboard_post_types' ) !== null && is_array( $request->get_param( 'daextinma_dashboard_post_types' ) ) ? array_map( 'sanitize_text_field', $request->get_param( 'daextinma_dashboard_post_types' ) ) : null;
		$options['daextinma_juice_post_types']                     = $request->get_param( 'daextinma_juice_post_types' ) !== null && is_array( $request->get_param( 'daextinma_juice_post_types' ) ) ? array_map( 'sanitize_text_field', $request->get_param( 'daextinma_juice_post_types' ) ) : null;
		$options['daextinma_http_status_post_types']   = $request->get_param( 'daextinma_http_status_post_types' ) !== null && is_array($request->get_param( 'daextinma_http_status_post_types' )) ? array_map( 'sanitize_text_field', $request->get_param( 'daextinma_http_status_post_types' ) ) : null;
		$options['daextinma_internal_links_data_update_frequency'] = $request->get_param( 'daextinma_internal_links_data_update_frequency' ) !== null ? sanitize_key( $request->get_param( 'daextinma_internal_links_data_update_frequency' ) ) : null;
		$options['daextinma_juice_data_update_frequency']          = $request->get_param( 'daextinma_juice_data_update_frequency' ) !== null ? sanitize_key( $request->get_param( 'daextinma_juice_data_update_frequency' ) ) : null;

		// Advanced -----------------------------------------------------------------------------------------------.

		// Optimization Parameters.
		$options['daextinma_optimization_num_of_characters'] = $request->get_param( 'daextinma_optimization_num_of_characters' ) !== null ? intval( $request->get_param( 'daextinma_optimization_num_of_characters' ), 10 ) : null;
		$options['daextinma_optimization_delta']             = $request->get_param( 'daextinma_optimization_delta' ) !== null ? intval( $request->get_param( 'daextinma_optimization_delta' ), 10 ) : null;

		// Meta boxes.
		$options['daextinma_interlinks_options_post_types']      = $request->get_param( 'daextinma_interlinks_options_post_types' ) !== null && is_array( $request->get_param( 'daextinma_interlinks_options_post_types' ) ) ? array_map( 'sanitize_text_field', $request->get_param( 'daextinma_interlinks_options_post_types' ) ) : null;
		$options['daextinma_interlinks_optimization_post_types'] = $request->get_param( 'daextinma_interlinks_optimization_post_types' ) !== null && is_array( $request->get_param( 'daextinma_interlinks_optimization_post_types' ) ) ? array_map( 'sanitize_text_field', $request->get_param( 'daextinma_interlinks_optimization_post_types' ) ) : null;

		// Broken Links.
		$options['daextinma_http_status_checks_per_iteration']   = $request->get_param( 'daextinma_http_status_checks_per_iteration' ) !== null ? intval( $request->get_param( 'daextinma_http_status_checks_per_iteration' ), 10 ) : null;
		$options['daextinma_http_status_cron_schedule_interval'] = $request->get_param( 'daextinma_http_status_cron_schedule_interval' ) !== null ? intval( $request->get_param( 'daextinma_http_status_cron_schedule_interval' ), 10 ) : null;
		$options['daextinma_http_status_request_timeout']        = $request->get_param( 'daextinma_http_status_request_timeout' ) !== null ? intval( $request->get_param( 'daextinma_http_status_request_timeout' ), 10 ) : null;

		foreach ( $options as $key => $option ) {
			if ( null !== $option ) {
				update_option( $key, $option );
			}
		}

		return new WP_REST_Response( 'Data successfully added.', '200' );
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_interlinks_manager_pro_update_options_callback_permission_check() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to update the Interlinks Manager options.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/statistics' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Statistics" menu to retrieve the statistics of the internal links on the posts.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_read_statistics_callback( $request ) {

		$data_update_required = intval( $request->get_param( 'data_update_required' ), 10 );

		if ( 0 === $data_update_required ) {

			// Use the provided form data.
			$optimization_status = intval( $request->get_param( 'optimization_status' ), 10 );
			$search_string       = sanitize_text_field( $request->get_param( 'search_string' ) );
			$sorting_column      = sanitize_text_field( $request->get_param( 'sorting_column' ) );
			$sorting_order       = sanitize_text_field( $request->get_param( 'sorting_order' ) );

		} else {

			// Set the default values of the form data.
			$optimization_status = 0;
			$search_string       = '';
			$sorting_column      = 'post_date';
			$sorting_order       = 'desc';

			// Run update_interlinks_archive() to update the archive with the statistics.
			$this->shared->update_interlinks_archive();

			/**
			 * Record that the analysis feature has been used.
			 */
			$analysis_runs = (int) get_option( $this->shared->get( 'slug' ) . '_analysis_runs' );
			update_option( $this->shared->get( 'slug' ) . '_analysis_runs', $analysis_runs + 1 );

		}

		// Create the WHERE part of the query based on the $optimization_status value.
		global $wpdb;
		switch ( $optimization_status ) {
			case 0:
				$filter = '';
				break;
			case 1:
				$filter = 'WHERE optimization = 0';
				break;
			case 2:
				$filter = 'WHERE optimization = 1';
				break;
			default:
				$filter = '';
		}

		// Create the WHERE part of the string based on the $search_string value.
		if ( '' !== $search_string ) {
			if ( strlen( $filter ) === 0 ) {
				$filter .= $wpdb->prepare( 'WHERE (post_title LIKE %s)', '%' . $search_string . '%' );
			} else {
				$filter .= $wpdb->prepare( ' AND (post_title LIKE %s)', '%' . $search_string . '%' );

			}
		}

		// Create the ORDER BY part of the query based on the $sorting_column and $sorting_order values.
		if ( '' !== $sorting_column ) {
			$filter .= ' ORDER BY ' . sanitize_key( $sorting_column );
		} else {
			$filter .= ' ORDER BY post_date';
		}

		if ( 'desc' === $sorting_order ) {
			$filter .= ' DESC';
		} else {
			$filter .= ' ASC';
		}

		// Get the data from the "_archive" db table using $wpdb and put them in the $response array.

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $filter is prepared.
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$requests = $wpdb->get_results(
			"
			SELECT *
			FROM {$wpdb->prefix}daextinma_archive $filter"
		);
		// phpcs:enable

		if ( is_array( $requests ) && count( $requests ) > 0 ) {

			/**
			 * Add the formatted date (based on the date format defined in the WordPress settings) to the $requests
			 * array.
			 */
			foreach ( $requests as $key => $request ) {
				$requests[ $key ]->formatted_post_date = mysql2date( get_option( 'date_format' ), $request->post_date );
			}

			$response = array(
				'statistics' => array(
					'all_posts'   => count( $requests ),
					'average_mil' => $this->shared->get_average_mil( $requests ),
				),
				'table'      => $requests,
			);

		} else {

			$response = array(
				'statistics' => array(
					'all_posts'   => 0,
					'average_mil' => 'N/A',
					'average_ail' => 'N/A',
				),
				'table'      => array(),
			);

		}

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_interlinks_manager_pro_read_statistics_callback_permission_check() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to read the Interlinks Manager statistics.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/juice' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Juice" menu to retrieve the statistics of the internal links on the posts.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_read_juice_callback( $request ) {

		$data_update_required = intval( $request->get_param( 'data_update_required' ), 10 );

		if ( 0 === $data_update_required ) {

			// Use the provided form data.
			$search_string  = sanitize_text_field( $request->get_param( 'search_string' ) );
			$sorting_column = sanitize_text_field( $request->get_param( 'sorting_column' ) );
			$sorting_order  = sanitize_text_field( $request->get_param( 'sorting_order' ) );

		} else {

			// Set the default values of the form data.
			$search_string  = '';
			$sorting_column = 'juice';
			$sorting_order  = 'desc';

			// Run update_interlinks_archive() to update the archive with the statistics.
			$this->shared->update_interlinks_archive();

			/**
			 * Record that the analysis feature has been used.
			 */
			$analysis_runs = (int) get_option( $this->shared->get( 'slug' ) . '_analysis_runs' );
			update_option( $this->shared->get( 'slug' ) . '_analysis_runs', $analysis_runs + 1 );

		}

		// Create the WHERE part of the string based on the $search_string value.
		$filter = '';
		global $wpdb;
		if ( '' !== $search_string ) {
			if ( strlen( $filter ) === 0 ) {
				$filter .= $wpdb->prepare( 'WHERE (url LIKE %s)', '%' . $search_string . '%' );
			} else {
				$filter .= $wpdb->prepare( ' AND (url LIKE %s)', '%' . $search_string . '%' );

			}
		}

		// Create the ORDER BY part of the query based on the $sorting_column and $sorting_order values.
		if ( '' !== $sorting_column ) {
			$filter .= ' ORDER BY ' . sanitize_key( $sorting_column );
		} else {
			$filter .= ' ORDER BY url';
		}

		if ( 'desc' === $sorting_order ) {
			$filter .= ' DESC';
		} else {
			$filter .= ' ASC';
		}

		// Get the data from the "_archive" db table using $wpdb and put them in the $response array.

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $filter is prepared.
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$requests = $wpdb->get_results(
			"
			SELECT *
			FROM {$wpdb->prefix}daextinma_juice $filter"
		);
		// phpcs:enable

		if ( is_array( $requests ) && count( $requests ) > 0 ) {
			$response = array(
				'statistics' => array(
					'all_urls'      => count( $requests ),
					'average_iil'   => $this->shared->get_average_iil( $requests ),
					'average_juice' => $this->shared->get_average_juice( $requests ),
				),
				'table'      => $requests,
			);
		} else {
			$response = array(
				'statistics' => array(
					'all_urls'      => 0,
					'average_iil'   => 'N/A',
					'average_juice' => 'N/A',
				),
				'table'      => array(),
			);
		}

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_interlinks_manager_pro_read_juice_callback_permission_check() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to read the Interlinks Manager statistics.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/juice-url' endpoint of the Rest API.
	 *
	 * Return the URL details data displayed in the Juice menu.
	 *
	 *  This method is called when in the "Juice" menu one the "Details View" button is clicked.of these elements is
	 * clicked.
	 *
	 * @param object $request The request data.
	 *
	 * @return void
	 */
	public function rest_api_interlinks_manager_pro_read_juice_url_callback( $request ) {

		// Init Variables.
		$data      = array();
		$juice_max = 0;

		$juice_id = sanitize_text_field( $request->get_param( 'id' ) );

		global $wpdb;
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$juice_obj = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}daextinma_juice WHERE id = %d", $juice_id ),
			OBJECT
		);

		// Body -------------------------------------------------------------------------------------------------------.

		// Get the maximum value of the juice.
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$results = $wpdb->get_results(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}daextinma_anchors WHERE url = %s ORDER BY id ASC", $juice_obj->url ),
			ARRAY_A
		);

		if ( count( $results ) > 0 ) {

			// Calculate the maximum value.
			foreach ( $results as $result ) {
				if ( $result['juice'] > $juice_max ) {
					$juice_max = $result['juice'];
				}
			}
		} else {

			echo 'no data';
			die();

		}

		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$results = $wpdb->get_results(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}daextinma_anchors WHERE url = %s ORDER BY juice DESC", $juice_obj->url ),
			ARRAY_A
		);

		if ( count( $results ) > 0 ) {

			foreach ( $results as $result ) {

				$data[] = array(
					'id'            => $result['id'],
					'postTitle'     => $result['post_title'],
					'juice'         => intval( $result['juice'], 10 ),
					'juiceVisual'   => intval( 100 * $result['juice'] / $juice_max, 10 ),
					'anchor'        => $result['anchor'],
					'postId'        => intval( $result['post_id'], 10 ),
					'postPermalink' => $result['post_permalink'],
					'postEditLink'  => $result['post_edit_link'],
				);

			}
		} else {

			echo 'no data';
			die();

		}

		// Return respose.
		echo wp_json_encode( $data );
		die();
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_interlinks_manager_pro_read_juice_url_callback_permission_check() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to read the Interlinks Manager statistics.',
				array( 'status' => 403 )
			);
		}

		return true;
	}

	/**
	 * Callback for the POST 'daext-interlinks-manager/v1/http-status' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Broken Links" menu to retrieve the statistics of the internal links on the posts.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_daext_interlinks_manager_read_http_status_callback( $request ) {

		$data_update_required = intval( $request->get_param( 'data_update_required' ), 10 );

		if ( 0 === $data_update_required ) {

			// Use the provided form data.
			$status_code    = sanitize_key( $request->get_param( 'status_code' ) );
			$search_string  = sanitize_text_field( $request->get_param( 'search_string' ) );
			$sorting_column = sanitize_text_field( $request->get_param( 'sorting_column' ) );
			$sorting_order  = sanitize_text_field( $request->get_param( 'sorting_order' ) );

		} else {

			// Set the default values of the form data.
			$status_code    = 'all';
			$search_string  = '';
			$sorting_column = 'last_check_date';
			$sorting_order  = 'desc';

			// Update the Broken Links Archive.
			$this->shared->update_http_status_archive();

		}

		// Create the WHERE part of the query based on the $optimization_status value.
		global $wpdb;
		switch ( $status_code ) {
			case 0:
				$filter = '';
				break;
			default:
				$filter = 'WHERE code = $status_code';
				break;
		}

		// status code.
		if ( ! is_null( $status_code ) &&
		     ( trim( $status_code ) !== 'all' ) ) {

			switch ( trim( $status_code ) ) {

				case 'unknown':
					$filter = "WHERE code = ''";
					break;

				case '1xx':
					$filter  = "WHERE (code = '100'";
					$filter .= " OR code = '101'";
					$filter .= " OR code = '102'";
					$filter .= " OR code = '103')";
					break;

				case '2xx':
					$filter  = "WHERE (code = '200'";
					$filter .= " OR code = '201'";
					$filter .= " OR code = '202'";
					$filter .= " OR code = '203'";
					$filter .= " OR code = '204'";
					$filter .= " OR code = '205'";
					$filter .= " OR code = '206'";
					$filter .= " OR code = '207'";
					$filter .= " OR code = '208'";
					$filter .= " OR code = '226')";
					break;

				case '3xx':
					$filter  = "WHERE (code = '300'";
					$filter .= " OR code = '301'";
					$filter .= " OR code = '302'";
					$filter .= " OR code = '303'";
					$filter .= " OR code = '304'";
					$filter .= " OR code = '305'";
					$filter .= " OR code = '305'";
					$filter .= " OR code = '306'";
					$filter .= " OR code = '307'";
					$filter .= " OR code = '308')";
					break;

				case '4xx':
					$filter  = "WHERE (code = '400'";
					$filter .= " OR code = '401'";
					$filter .= " OR code = '402'";
					$filter .= " OR code = '403'";
					$filter .= " OR code = '404'";
					$filter .= " OR code = '405'";
					$filter .= " OR code = '406'";
					$filter .= " OR code = '407'";
					$filter .= " OR code = '408'";
					$filter .= " OR code = '409'";
					$filter .= " OR code = '410'";
					$filter .= " OR code = '411'";
					$filter .= " OR code = '412'";
					$filter .= " OR code = '413'";
					$filter .= " OR code = '414'";
					$filter .= " OR code = '415'";
					$filter .= " OR code = '416'";
					$filter .= " OR code = '417'";
					$filter .= " OR code = '418'";
					$filter .= " OR code = '421'";
					$filter .= " OR code = '422'";
					$filter .= " OR code = '423'";
					$filter .= " OR code = '424'";
					$filter .= " OR code = '426'";
					$filter .= " OR code = '428'";
					$filter .= " OR code = '429'";
					$filter .= " OR code = '431'";
					$filter .= " OR code = '451')";

					break;

				case '5xx':
					$filter  = "WHERE (code = '500'";
					$filter .= " OR code = '501'";
					$filter .= " OR code = '502'";
					$filter .= " OR code = '503'";
					$filter .= " OR code = '504'";
					$filter .= " OR code = '505'";
					$filter .= " OR code = '506'";
					$filter .= " OR code = '507'";
					$filter .= " OR code = '508'";
					$filter .= " OR code = '510'";
					$filter .= " OR code = '511')";

					break;

			}
		} else {
			$filter = '';
		}

		// Create the WHERE part of the string based on the $search_string value.
		if ( '' !== $search_string ) {
			if ( strlen( $filter ) === 0 ) {
				$filter .= $wpdb->prepare( 'WHERE (post_title LIKE %s)', '%' . $search_string . '%' );
			} else {
				$filter .= $wpdb->prepare( ' AND (post_title LIKE %s)', '%' . $search_string . '%' );

			}
		}

		// Create the ORDER BY part of the query based on the $sorting_column and $sorting_order values.
		if ( '' !== $sorting_column ) {
			$filter .= $wpdb->prepare( ' ORDER BY %i', $sorting_column );
		} else {
			$filter .= ' ORDER BY last_check_date';
		}

		if ( 'desc' === $sorting_order ) {
			$filter .= ' DESC';
		} else {
			$filter .= ' ASC';
		}

		/**
		 * Check in the "_http_status" db table if all the links have been checked. (if there are zero links to
		 * check)
		 */
		global $wpdb;

		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$count       = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}daextinma_http_status WHERE checked = 0" );

		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$count_total = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}daextinma_http_status" );

		// Get the data from the "_archive" db table using $wpdb and put them in the $response array.
		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $filter is prepared.
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$requests   = $wpdb->get_results(
			"SELECT *
			FROM {$wpdb->prefix}daextinma_http_status $filter"
		);
		// phpcs:enable

		if ( is_array( $requests ) && count( $requests ) > 0 ) {

			/**
			 * Add the formatted date (based on the date format defined in the WordPress settings) to the $requests
			 * array.
			 */
			foreach ( $requests as $key => $request ) {
				$requests[ $key ]->formatted_last_check_date = mysql2date( get_option('date_format') . ' ' . get_option('time_format') , $request->last_check_date );
			}

			$response = array(
				'statistics' => array(
					'all_posts'            => count( $requests ),
					'successful_responses' => $this->shared->get_successful_responses( $requests ),
				),
				'table'      => $requests,
			);
		} else {
			$response = array(
				'statistics' => array(
					'all_posts'            => 0,
					'successful_responses' => 0,
				),
				'table'      => array(),
			);
		}

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_daext_interlinks_manager_read_http_status_callback_permission_check() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to read the Interlinks Manager statistics.',
				array( 'status' => 403 )
			);
		}

		return true;

	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/dashboard-menu-export-csv' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Dashboard" menu to download the CSV statistics of the internal links on the posts when the "Export"
	 * button is clicked.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_dashboard_menu_export_csv_callback() {

		// Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
		$this->shared->set_met_and_ml();

		// get the data from the db table.
		global $wpdb;
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}daextinma_archive ORDER BY post_date DESC", ARRAY_A );

		// if there are data generate the csv header and content.
		if ( count( $results ) > 0 ) {

			$csv_content = '';
			$new_line    = "\n";

			// set the csv header.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/csv; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=dashboard-' . time() . '.csv' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// set headings.
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Post', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Date', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Type', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Length', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Internal Links', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Inbound Links', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Status', 'daext-interlinks-manager' ) ) . '"';
			$csv_content .= $new_line;

			// set column content.
			foreach ( $results as $result ) {

				$status_text = 1 === intval( $result['optimization'], 10 ) ? __( 'Optimized', 'daext-interlinks-manager' ) : __( 'Not Optimized', 'daext-interlinks-manager' );
				$status_text .= ' (' . $result['manual_interlinks'] . ' ' . __( 'of', 'daext-interlinks-manager' ) . ' ' . $result['recommended_interlinks'] . ')';

				$csv_content .= '"' . $this->shared->esc_csv( $result['post_title'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( mysql2date( get_option( 'date_format' ), $result['post_date'] ) ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['post_type'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['content_length'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['manual_interlinks'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['iil'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $status_text ) . '"';
				$csv_content .= $new_line;

			}
		} else {
			return false;
		}

		$response = array(
			'csv_content' => $csv_content,
		);

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/juice-menu-export-csv' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Juice" menu to download the juice statistics when the "Export" button is clicked.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_juice_menu_export_csv_callback() {

		// Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
		$this->shared->set_met_and_ml();

		// get the data from the db table.
		global $wpdb;

		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}daextinma_juice ORDER BY juice DESC", ARRAY_A );

		// if there are data generate the csv header and content.
		if ( count( $results ) > 0 ) {

			$csv_content = '';
			$new_line    = "\n";

			// set the csv header.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/csv; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=juice-' . time() . '.csv' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// set headings.
			$csv_content .= '"' . $this->shared->esc_csv( __( 'URL', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Inbound Links', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Link Equity', 'daext-interlinks-manager' ) ) . '"';
			$csv_content .= $new_line;

			// set column content.
			foreach ( $results as $result ) {

				$csv_content .= '"' . $this->shared->esc_csv( $result['url'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['iil'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['juice'] ) . '"';
				$csv_content .= $new_line;

			}
		} else {
			return false;
		}

		$response = array(
			'csv_content' => $csv_content,
		);

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Callback for the POST 'interlinks-manager-pro/v1/anchors-menu-export-csv' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Juice" menu to download the juice data of a specific URL when the "Export" button available in the last
	 * column of the data table is clicked.
	 *
	 * @param object $request The request data.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_interlinks_manager_pro_anchors_menu_export_csv_callback( $request ) {

		$url = sanitize_text_field( $request->get_param( 'url' ) );

		// Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
		$this->shared->set_met_and_ml();

		// get the URL.
		$url = esc_url_raw( urldecode( $url ) );

		// get the data from the db table.
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$results = $wpdb->get_results(
			$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}daextinma_anchors WHERE url = %s ORDER BY juice DESC", $url ),
			ARRAY_A
		);

		// if there are data generate the csv header and content.
		if ( count( $results ) > 0 ) {

			$csv_content = '';
			$new_line    = "\n";

			// set the csv header.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/csv; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=juice-details-' . time() . '.csv' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// set headings.
			$csv_content .= '"' . $this->shared->esc_csv( __( 'URL', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Post', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Anchor Text', 'daext-interlinks-manager' ) ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Link Equity', 'daext-interlinks-manager' ) ) . '"';

			$csv_content .= $new_line;

			// set column content.
			foreach ( $results as $result ) {

				$csv_content .= '"' . $this->shared->esc_csv( $result['url'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['post_title'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['anchor'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['juice'] ) . '"';

				$csv_content .= $new_line;

			}
		} else {
			return false;
		}

		$response = array(
			'csv_content' => $csv_content,
		);

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Callback for the POST 'daext-interlinks-manager/v1/http-status-menu-export-csv' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the "Broken Links" menu to download the broken links statistics when the "Export" button is clicked.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_daext_interlinks_manager_http_status_menu_export_csv_callback() {

		// Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
		$this->shared->set_met_and_ml();

		// get the data from the db table.
		global $wpdb;

		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$results    = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}daextinma_http_status ORDER BY last_check_date DESC", ARRAY_A );

		// if there are data generate the csv header and content.
		if ( count( $results ) > 0 ) {

			$csv_content = '';
			$new_line    = "\n";

			// set the csv header.
			header( 'Content-Encoding: UTF-8' );
			header( 'Content-type: text/csv; charset=UTF-8' );
			header( 'Content-Disposition: attachment; filename=http-response-' . time() . '.csv' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			// set headings.
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Post', 'daext-interlinks-manager') ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Anchor Text', 'daext-interlinks-manager') ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'URL', 'daext-interlinks-manager') ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Status Code', 'daext-interlinks-manager') ) . '",';
			$csv_content .= '"' . $this->shared->esc_csv( __( 'Last Check', 'daext-interlinks-manager') ) . '"';
			$csv_content .= $new_line;

			// set column content.
			foreach ( $results as $result ) {

				$csv_content .= '"' . $this->shared->esc_csv( $result['post_title'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['anchor'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['url'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( $result['code'] . ' ' . $result['code_description'] ) . '",';
				$csv_content .= '"' . $this->shared->esc_csv( mysql2date( get_option('date_format') . ' ' . get_option('time_format'), $result['last_check_date'] ) ) . '"';
				$csv_content .= $new_line;

			}
		} else {
			return false;
		}

		$response = array(
			'csv_content' => $csv_content,
		);

		// Prepare the response.
		$response = new WP_REST_Response( $response );

		return $response;
	}

	/**
	 * Callback for the POST 'daext-interlinks-manager/v1/generate-interlinks-optimization' endpoint of the Rest API.
	 *
	 * This method is in the following contexts:
	 *
	 * - In the block editor to retrieve internal links optimization data for the edited post.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function rest_api_daext_interlinks_manager_generate_interlinks_optimization_callback($request) {

		// Set the PHP "Max Execution Time" and "Memory Limit" based on the values defined in the options.
		$this->shared->set_met_and_ml();

		// Get the post id for which the suggestions should be generated.
		$post_id = $request->get_param( 'id' ) !== null ? intval( $request->get_param( 'id' ), 10 ) : null;

		// Get the post object.
		$post = get_post( $post_id );

		$data = array();
		$data['suggested_min_number_of_interlinks'] = $this->shared->get_suggested_min_number_of_interlinks( $post->ID );
		$data['suggested_max_number_of_interlinks'] = $this->shared->get_suggested_max_number_of_interlinks( $post->ID );
		$data['number_of_manual_interlinks']        = $this->shared->get_manual_interlinks( $post->post_content );
		$data['total_number_of_interlinks']         = $data['number_of_manual_interlinks'];

		// Return the suggestions as a JSON response.
		return new WP_REST_Response( $data, 200 );

	}

	/**
	 * Check the user capability.
	 *
	 * @return true|WP_Error
	 */
	public function rest_api_daext_interlinks_manager_generate_interlinks_optimization_callback_permission_check() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error(
				'rest_update_error',
				'Sorry, you are not allowed to generate internal optimization data.',
				array( 'status' => 403 )
			);
		}

		return true;

	}
}

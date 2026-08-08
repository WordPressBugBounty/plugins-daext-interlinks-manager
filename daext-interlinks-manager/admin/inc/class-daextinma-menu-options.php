<?php
/**
 * Used to generate the data used in the options menu powered by React.
 *
 * @package daext-interlinks-manager
 */

/**
 * This menu_options_configuration() method of this class is used to generate the data used in the options menu powered
 * by React.
 */
class Daextinma_Menu_Options {

	/**
	 * The singleton instance of the class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * Get the singleton instance of the class.
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
	 * Returns an array with the data used by the React based options menu to initialize the options.
	 *
	 * @return array[]
	 */
	public function menu_options_configuration() {

		// Get the public post types that have a UI.
		$args               = array(
			'public'  => true,
			'show_ui' => true,
		);
		$post_types_with_ui = get_post_types( $args );
		unset( $post_types_with_ui['attachment'] );
		$post_types_select_options = array();
		foreach ( $post_types_with_ui as $post_type ) {
			$post_type_obj               = get_post_type_object( $post_type );
			$post_types_select_options[] = array(
				'value' => $post_type,
				'text'  => $post_type_obj->label,
			);
		}

		// This variable includes all the data used by the configuration options.
		$configuration = array(

			array(
				'title'       => __( 'Link Analysis', 'daext-interlinks-manager' ),
				'description' => __( 'Configure options and parameters used for the link analysis.', 'daext-interlinks-manager' ),
				'cards'       => array(
					array(
						'title'   => __( 'Link Equity', 'daext-interlinks-manager' ),
						'options' => array(
							array(
								'name'      => 'daextinma_default_seo_power',
								'label'     => __( 'Total Link Equity (Default)', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'Define the default total link equity assigned to posts. This value represents the amount of link equity a post passes through its internal links and determines the equity assigned to linked pages in the plugin reports.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the default total link equity assigned to posts.', 'daext-interlinks-manager' ),
								'rangeMin'  => 100,
								'rangeMax'  => 1000000,
								'rangeStep' => 1,
							),
							array(
								'name'      => 'daextinma_penality_per_position_percentage',
								'label'     => __( 'Position Penalty (%)', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'With multiple links in an article, the algorithm that calculates the link equity passed by each link removes a percentage of the passed link equity based on the position of the link compared to the other links.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the link penalty per position percentage.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 100,
								'rangeStep' => 1,
							),
							array(
								'name'    => 'daextinma_remove_link_to_anchor',
								'label'   => __( 'Remove Fragment Identifier', 'daext-interlinks-manager' ),
								'type'    => 'toggle',
								'tooltip' => __( 'Automatically remove anchors from every URL used to calculate link equity. With this option enabled, "http://example.com" and "http://example.com#myanchor" will both contribute to generate link equity for a single URL, that is "http://example.com".', 'daext-interlinks-manager' ),
								'help'    => __(
									'Remove the fragment identifier from the URL.',
									'daext-interlinks-manager'
								),
							),
							array(
								'name'    => 'daextinma_remove_url_parameters',
								'label'   => __( 'Remove URL Parameters', 'daext-interlinks-manager' ),
								'type'    => 'toggle',
								'tooltip' => __( 'Automatically remove URL parameters from every URL used to calculate link equity. With this option enabled, "http://example.com" and "http://example.com?param=1" will both contribute to generate link equity for a single URL, that is "http://example.com". This option should not be enabled if your website uses URL parameters to identify specific pages (for example when pretty permalinks are not enabled).', 'daext-interlinks-manager' ),
								'help'    => __(
									'Remove the parameters from the URL.',
									'daext-interlinks-manager'
								),
							),
						),
					),
					array(
						'title'   => __( 'Technical Options', 'daext-interlinks-manager' ),
						'options' => array(
							array(
								'name'    => 'daextinma_set_max_execution_time',
								'label'   => __( 'Set Max Execution Time', 'daext-interlinks-manager' ),
								'type'    => 'toggle',
								'tooltip' => __( 'Enable the custom "Max Execution Time Value" for long-running scripts.', 'daext-interlinks-manager' ),
								'help'    => __(
									'Enable a custom max execution time value.',
									'daext-interlinks-manager'
								),
							),
							array(
								'name'      => 'daextinma_max_execution_time_value',
								'label'     => __( 'Max Execution Time Value', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'This value determines the maximum number of seconds allowed to execute long running scripts.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the max execution time value.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 3600,
								'rangeStep' => 1,
							),
							array(
								'name'    => 'daextinma_set_memory_limit',
								'label'   => __( 'Set Memory Limit', 'daext-interlinks-manager' ),
								'type'    => 'toggle',
								'tooltip' => __( 'Enable the custom "Memory Limit Value" for long-running scripts.', 'daext-interlinks-manager' ),
								'help'    => __(
									'Enable a custom memory limit.',
									'daext-interlinks-manager'
								),
							),
							array(
								'name'      => 'daextinma_memory_limit_value',
								'label'     => __( 'Memory Limit Value', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'This value determines the PHP memory limit in megabytes allowed to execute long running scripts.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the memory limit value.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 16384,
								'rangeStep' => 1,
							),
							array(
								'name'      => 'daextinma_limit_posts_analysis',
								'label'     => __( 'Limit Posts Analysis	', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'With this options you can determine the maximum number of posts analyzed to get information about your internal links, to get information about the internal links juice and to get suggestions in the "Interlinks Suggestions" meta box. If you select for example "1000", the analysis performed by the plugin will use your latest "1000" posts.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Limit the maximum number of analyzed posts.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 100000,
								'rangeStep' => 1,
							),
							array(
								'name'          => 'daextinma_dashboard_post_types',
								'label'         => __( 'Dashboard Post Types', 'daext-interlinks-manager' ),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'With this option you are able to determine the post types analyzed in the Dashboard menu.',
									'daext-interlinks-manager'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types analyzed in the Dashboard menu.', 'daext-interlinks-manager' ),
							),
							array(
								'name'          => 'daextinma_juice_post_types',
								'label'         => __( 'Link Equity Post Types', 'daext-interlinks-manager' ),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'With this option you are able to determine the post types analyzed in the Link Equity menu.',
									'daext-interlinks-manager'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types analyzed in the Link Equity menu.', 'daext-interlinks-manager' ),
							),
							array(
								'name'          => 'daextinma_http_status_post_types',
								'label'         => __( 'Broken Links Post Types', 'daext-interlinks-manager' ),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'With this option you are able to determine the post types analyzed in the Broken Links menu. Leave this field empty to perform the analysis in any post type.',
									'daext-interlinks-manager'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types analyzed in the Broken Links menu.', 'daext-interlinks-manager' ),
							),
							array(
								'name'          => 'daextinma_internal_links_data_update_frequency',
								'label'         => __( 'Internal Links Data Update Frequency', 'daext-interlinks-manager' ),
								'type'          => 'select',
								'tooltip'       => __(
									'The frequency of the automatic data updates performed in the Dashboard menu.',
									'daext-interlinks-manager'
								),
								'selectOptions' => array(
									array(
										'value' => 'never',
										'text'  => __( 'Never', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'hourly',
										'text'  => __( 'Hourly', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'daily',
										'text'  => __( 'Daily', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'weekly',
										'text'  => __( 'Weekly', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'monthly',
										'text'  => __( 'Monthly', 'daext-interlinks-manager' ),
									),
								),
								'help'          => __( 'Select the frequency of the automatic data updates performed in the Dashboard menu.', 'daext-interlinks-manager' ),
							),
							array(
								'name'          => 'daextinma_juice_data_update_frequency',
								'label'         => __( 'Link Equity Data Update Frequency', 'daext-interlinks-manager' ),
								'type'          => 'select',
								'tooltip'       => __(
									'The frequency of the automatic data updates performed in the Link Equity menu.',
									'daext-interlinks-manager'
								),
								'selectOptions' => array(
									array(
										'value' => 'never',
										'text'  => __( 'Never', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'hourly',
										'text'  => __( 'Hourly', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'daily',
										'text'  => __( 'Daily', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'weekly',
										'text'  => __( 'Weekly', 'daext-interlinks-manager' ),
									),
									array(
										'value' => 'monthly',
										'text'  => __( 'Monthly', 'daext-interlinks-manager' ),
									),
								),
								'help'          => __( 'Select the frequency of the automatic data updates performed in the Link Equity menu.', 'daext-interlinks-manager' ),
							),
						),
					),
				),
			),

			array(
				'title'       => __( 'Advanced', 'daext-interlinks-manager' ),
				'description' => __( 'Manage advanced plugin settings.', 'daext-interlinks-manager' ),
				'cards'       => array(
					array(
						'title'   => __( 'Optimization Parameters', 'daext-interlinks-manager' ),
						'options' => array(
							array(
								'name'      => 'daextinma_optimization_num_of_characters',
								'label'     => __( 'Characters per Interlink', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'The "Recommended Interlinks" value available in the "Dashboard" menu and in the "Internal Links Optimization" editor panel is based on the defined "Characters per Interlink" and on the content length of the post. For example if you define 500 "Characters per Interlink", in the "Dashboard" menu, with a post that has a content length of 2000 characters you will get 4 as the value for the "Recommended Interlinks".',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the optimal number of characters per internal link.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 1000000,
								'rangeStep' => 1,
							),
							array(
								'name'      => 'daextinma_optimization_delta',
								'label'     => __( 'Optimization Delta	', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'The "Optimization Delta" is used to generate the "Optimization Flag" available in the "Dashboard" menu and the text message displayed in the "Internal Links Optimization" editor panel. This option determines how different can be the actual number of internal links in a post from the calculated "Recommended Interlinks". This option defines a range, so for example in a post with 10 "Recommended Interlinks" and this option value equal to 4, the post will be considered optimized when it includes from 8 to 12 interlinks.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set how different can the number of internal links of a post from the optimal value.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 1000000,
								'rangeStep' => 1,
							),
						),
					),
					array(
						'title'   => __( 'Editor Panels', 'daext-interlinks-manager' ),
						'options' => array(
							array(
								'name'          => 'daextinma_interlinks_options_post_types',
								'label'         => __( 'Internal Links Settings Post Types', 'daext-interlinks-manager' ),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'Use this option to determine in which post types the "Internal Links Settings" panel should be displayed.',
									'daext-interlinks-manager'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types where the "Internal Links Settings" panel should be available.', 'daext-interlinks-manager' ),
							),
							array(
								'name'          => 'daextinma_interlinks_optimization_post_types',
								'label'         => __( 'Internal Links Optimization Post Types', 'daext-interlinks-manager' ),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'Use this option to determine in which post types the "Internal Links Optimization" panel should be displayed.',
									'daext-interlinks-manager'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types where the "Internal Links Optimization" panel should be available.', 'daext-interlinks-manager' ),
							),
						),
					),
					array(
						'title'   => __( 'Broken Links', 'daext-interlinks-manager' ),
						'options' => array(
							array(
								'name'      => 'daextinma_http_status_checks_per_iteration',
								'label'     => __( 'WP-Cron Checks Per Run', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'This value determines the number of HTTP requests sent at each run of the WP-Cron event. This parameter is used in the WP-Cron event used to verify the HTTP response status codes of the URLs used in the internal links.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the number of HTTP requests sent at each run of the WP-Cron event.', 'daext-interlinks-manager' ),
								'rangeMin'  => 1,
								'rangeMax'  => 4,
								'rangeStep' => 1,
							),
							array(
								'name'      => 'daextinma_http_status_cron_schedule_interval',
								'label'     => __( 'WP-Cron Event Interval', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'This value determines the interval in seconds between the custom WP-Cron events used to verify the HTTP response status codes of the URLs used in the internal links.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the interval in seconds between the WP-Cron events.', 'daext-interlinks-manager' ),
								'rangeMin'  => 60,
								'rangeMax'  => 900,
								'rangeStep' => 60,
							),
							array(
								'name'      => 'daextinma_http_status_request_timeout',
								'label'     => __( 'Request Timeout', 'daext-interlinks-manager' ),
								'type'      => 'range',
								'tooltip'   => __(
									'This value determines how long the connection should stay open in seconds for the HTTP requests used to verify the HTTP response status codes of the URLs used in the internal links.',
									'daext-interlinks-manager'
								),
								'help'      => __( 'Set the HTTP request timeout in seconds.', 'daext-interlinks-manager' ),
								'rangeMin'  => 2,
								'rangeMax'  => 8,
								'rangeStep' => 1,
							),
						),
					),
				),
			),

		);

		return $configuration;
	}
}

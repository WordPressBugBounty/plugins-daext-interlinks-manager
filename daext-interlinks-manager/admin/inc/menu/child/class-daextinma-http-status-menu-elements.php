<?php
/**
 * Class used to implement the back-end functionalities of the "Broken Links" menu.
 *
 * @package daext-interlinks-manager
 */

/**
 * Class used to implement the back-end functionalities of the "Broken Links" menu.
 */
class Daextinma_Http_Status_Menu_Elements extends Daextinma_Menu_Elements {

	/**
	 * Constructor.
	 *
	 * @param $shared
	 * @param $page_query_param
	 * @param $config
	 */
	public function __construct( $shared, $page_query_param, $config ) {

		parent::__construct( $shared, $page_query_param, $config );

		$this->menu_slug          = 'http-status';
		$this->slug_plural        = 'http-status';
		$this->label_singular     = 'Broken Links';
		$this->label_plural       = 'Broken Links';
		$this->primary_key        = 'category_id';
		$this->db_table           = 'category';
		$this->list_table_columns = array(
			array(
				'db_field' => 'name',
				'label'    => 'Name',
			),
			array(
				'db_field' => 'description',
				'label'    => 'Description',
			),
		);
		$this->searchable_fields  = array(
			'name',
			'description',
		);
	}

	/**
	 * Display the body content.
	 */
	function display_custom_content() {

		?>

		<div class="daextinma-admin-body">

			<div id="react-root"></div>

		</div>

		<?php

	}

}

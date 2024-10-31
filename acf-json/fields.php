<?php if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5ca8522748f4b',
	'title' => 'Settings',
	'fields' => array(
		array(
			'key' => 'field_5ca852c35e308',
			'label' => 'Script One On Header (Do need to write &lt;script&gt; tag)',
			'name' => 'script_one_on_header',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 14,
			'new_lines' => '',
		),
		array(
			'key' => 'field_5ca852e55e309',
			'label' => 'Script Second On Footer (Do need to write &lt;script&gt; tag)',
			'name' => 'script_second_on_footer',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 14,
			'new_lines' => '',
		),
		array(
			'key' => 'field_5ca853145e30a',
			'label' => 'style css (Do need to write &lt;style&gt; tag)',
			'name' => 'style_css',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 14,
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-setting',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
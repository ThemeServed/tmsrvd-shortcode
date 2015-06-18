<?php
/**
 * Define the shortcode parameters
 *
 * @package TmsrvdShortcodes
 * @since 1.0
 */

/* Button Config --- */

$tmsrvd_shortcodes['button'] = array(
	'title' => __('Button', 'TMSRVD'),
	'id' => 'tmsrvd-button-shortcode',
	'template' => '[tmsrvd_button {{attributes}}] {{content}} [/tmsrvd_button]',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __('Button Type', 'TMSRVD'),
			'desc' => __('Select the button\'s type', 'TMSRVD'),
			'options' => array(
                'default' => 'Default', 
                'primary' => 'Primary', 
                'success' => 'Success', 
                'info' => 'Info', 
                'warning' => 'Warning', 
                'danger' => 'Danger', 
                'link' => 'Link'
			)
		),
		'size' => array(
            'default' => 'sm',
			'type' => 'select',
			'label' => __('Button Size', 'TMSRVD'),
			'desc' => __('Select the button\'s size', 'TMSRVD'),
			'options' => array(
                'xs' => 'Extra small', 
                'sm' => 'Small', 
                'lg' => 'Large'
			)
		),
		'block' => array(
            'default' => false,
			'type' => 'checkbox',
			'label' => __('Button Block', 'TMSRVD'),
			'desc' => __('Whether the button should be a block-level button', 'TMSRVD')
		),
		'active' => array(
            'default' => false,
			'type' => 'checkbox',
			'label' => __('Active Button', 'TMSRVD'),
			'desc' => __('Apply the "active" style', 'TMSRVD')
		),
		'disabled' => array(
            'default' => false,
			'type' => 'checkbox',
			'label' => __('Disabled Button', 'TMSRVD'),
			'desc' => __('Whether the button be disabled', 'TMSRVD')
		),
		'xclass' => array(
            'std' => '',
			'type' => 'text',
			'label' => __('Button\'s Class', 'TMSRVD'),
			'desc' => __('Any extra classes you want to add', 'TMSRVD')
		),
        'link' => array(
            'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'TMSRVD'),
			'desc' => __('Add the button\'s url eg http://example.com', 'TMSRVD')
		),
        'data' => array(
            'std' => '',
			'type' => 'text',
			'label' => __('Button Data Attibuts', 'TMSRVD'),
			'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'TMSRVD'),
			'desc' => __('Set the browser behavior for the click action.', 'TMSRVD'),
			'options' => array(
				'_self' => 'Same window',
				'_blank' => 'New window'
			)
		),
		'content' => array(
            'std' => '',
			'type' => 'text',
			'label' => __('Button\'s Text', 'TMSRVD'),
			'desc' => __('Add the button\'s text', 'TMSRVD')
		)
	)
);

/* Columns Config --- */

$tmsrvd_shortcodes['columns'] = array(
	'title' => __('Columns', 'TMSRVD'),
	'id' => 'tmsrvd-columns-shortcode',
	'template' => ' [tmsrvd_row]{{child_shortcode}}[/tmsrvd_row] ', // There is no wrapper shortcode
	'notes' => __('Click \'Add Column\' to add a new column. Drag and drop to reorder columns.', 'TMSRVD'),
	'params' => array(),
	'child_shortcode' => array(
		'params' => array(
            'start_acc_width' => array(
				'type' => 'acc_start',
				'label' => __('Setup Column Widths', 'TMSRVD'),
                'open' => true
            ),
			'lg' => array(
				'type' => 'select',
				'label' => __('Column Large Screens', 'TMSRVD'),
				'desc' => __('Size of column on large screens (greater than 1200px).', 'TMSRVD'),
				'options' => array(
					'-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'md' => array(
				'type' => 'select',
				'label' => __('Column Medium Screens', 'TMSRVD'),
				'desc' => __('Size of column on medium screens (greater than 992px).', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'sm' => array(
				'type' => 'select',
				'label' => __('Column Small Screens', 'TMSRVD'),
				'desc' => __('Size of column on small screens (greater than 768px).', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'xs' => array(
				'type' => 'select',
				'label' => __('Column Extra Small Screens', 'TMSRVD'),
				'desc' => __('Size of column on extra small screens (less than 768px).', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
            'end_acc_width' => array(
				'type' => 'acc_end'
            ),
            'start_acc_offset' => array(
				'type' => 'acc_start',
				'label' => __('Setup Column Offset', 'TMSRVD'),
                'open' => true
            ),
			'offset_lg' => array(
				'type' => 'select',
				'label' => __('Offset On Large Screens', 'TMSRVD'),
				'desc' => __('Offset on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'offset_md' => array(
				'type' => 'select',
				'label' => __('Offset On Medium Screens', 'TMSRVD'),
				'desc' => __('Offset on column on medium screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'offset_sm' => array(
				'type' => 'select',
				'label' => __('Offset On Small Screens', 'TMSRVD'),
				'desc' => __('Offset on small screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'offset_xs' => array(
				'type' => 'select',
				'label' => __('Offset On Extra Small Screens', 'TMSRVD'),
				'desc' => __('Offset on extra small screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
            'end_acc_offset' => array(
				'type' => 'acc_end'
            ),
            'start_acc_pull' => array(
				'type' => 'acc_start',
				'label' => __('Setup Column Pull', 'TMSRVD'),
                'open' => true
            ),
			'pull_lg' => array(
				'type' => 'select',
				'label' => __('Pull On Large Screens', 'TMSRVD'),
				'desc' => __('Pull on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'pull_md' => array(
				'type' => 'select',
				'label' => __('Pull On Medium Screens', 'TMSRVD'),
				'desc' => __('Pull on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'pull_sm' => array(
				'type' => 'select',
				'label' => __('Pull On Small Screens', 'TMSRVD'),
				'desc' => __('Pull on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'pull_xs' => array(
				'type' => 'select',
				'label' => __('Pull On Extra Small Screens', 'TMSRVD'),
				'desc' => __('Pull on extra small screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
            'end_acc_pull' => array(
				'type' => 'acc_end'
            ),
            'start_acc_push' => array(
				'type' => 'acc_start',
				'label' => __('Setup Column Push', 'TMSRVD'),
                'open' => true
            ),
			'push_lg' => array(
				'type' => 'select',
				'label' => __('Push On Large Screens', 'TMSRVD'),
				'desc' => __('Push on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'push_md' => array(
				'type' => 'select',
				'label' => __('Push On Medium Screens', 'TMSRVD'),
				'desc' => __('Push on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'push_sm' => array(
				'type' => 'select',
				'label' => __('Push On Small Screens', 'TMSRVD'),
				'desc' => __('Push on column on large screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
			'push_xs' => array(
				'type' => 'select',
				'label' => __('Push On Extra Small Screens', 'TMSRVD'),
				'desc' => __('Push on extra small screens.', 'TMSRVD'),
				'options' => array(
                    '-' => '-',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12'
				)
			),
            'end_acc_push' => array(
				'type' => 'acc_end'
            ),
            'data' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Column Data Attibuts', 'TMSRVD'),
                'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
            ),
            'xclass' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Columns\'s Class', 'TMSRVD'),
                'desc' => __('Any extra classes you want to add', 'TMSRVD')
            ),
			'content' => array(
				'std' => __('Column content', 'TMSRVD'),
				'type' => 'textarea',
				'label' => __('Column Content', 'TMSRVD'),
				'desc' => __('Add the column content.', 'TMSRVD')
			)
		),
		'template' => '[tmsrvd_column {{attributes}}] {{content}} [/tmsrvd_column]',
		'clone_button' => __('Add Column', 'TMSRVD')
	)
);


/* Accordion Config --- */

$tmsrvd_shortcodes['collapsibles'] = array(
	'title' => __('Accordion', 'TMSRVD'),
	'id' => 'tmsrvd-collapsibles-shortcode',
	'template' => ' [tmsrvd_collapsibles]{{child_shortcode}}[/tmsrvd_collapsibles] ',
	'notes' => __('Click \'Add Accordion Item\' to add a new accordion item. Drag and drop to reorder items.', 'TMSRVD'),
	'params' => array(
//            'data' => array(
//                'std' => '',
//                'type' => 'text',
//                'label' => __('Accordion Data Attibuts', 'TMSRVD'),
//                'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
//            ),
//            'xclass' => array(
//                'std' => '',
//                'type' => 'text',
//                'label' => __('Accordion\'s Class', 'TMSRVD'),
//                'desc' => __('Any extra classes you want to add', 'TMSRVD')
//            )
    ),
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'type' => 'text',
				'label' => __('Accordion Item Title', 'TMSRVD'),
				'desc' => __('Add the title that will go above the item content', 'TMSRVD'),
				'std' => 'Title'
			),
            'type' => array(
				'type' => 'select',
				'label' => __('Accordion Item Type', 'TMSRVD'),
				'desc' => __('The type of the panel.', 'TMSRVD'),
				'options' => array(
                    'default' => 'Default', 
                    'primary' => 'Primary', 
                    'success' => 'Success', 
                    'info' => 'Info', 
                    'warning' => 'Warning', 
                    'danger' => 'Danger', 
                    'link' => 'Link'
                )
			),
            'data' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Accordion Item Data Attibuts', 'TMSRVD'),
                'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
            ),
            'xclass' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Accordion Item\'s Class', 'TMSRVD'),
                'desc' => __('Any extra classes you want to add', 'TMSRVD')
            ),
			'content' => array(
				'std' => 'Content',
				'type' => 'textarea',
				'label' => __('Accordion Item Content', 'TMSRVD'),
				'desc' => __('Add the item content. Will accept HTML', 'TMSRVD'),
			)
		),
		'template' => '[tmsrvd_collapse {{attributes}}] {{content}} [/tmsrvd_collapse]',
		'clone_button' => __('Add Accordion Item', 'TMSRVD')
	)
);


/* Accordion Config --- */

$tmsrvd_shortcodes['tab'] = array(
    'title' => __('Tabs', 'TMSRVD'),
    'id' => 'tmsrvd-tabs-shortcode',
    'template' => '[tmsrvd_tabs] {{child_shortcode}} [/tmsrvd_tabs]',
	'notes' => __('Click \'Add Tag\' to add a new tag. Drag and drop to reorder tabs.', 'TMSRVD'),
	'params' => array(
//            'data' => array(
//                'std' => '',
//                'type' => 'text',
//                'label' => __('Accordion Data Attibuts', 'TMSRVD'),
//                'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
//            ),
//            'xclass' => array(
//                'std' => '',
//                'type' => 'text',
//                'label' => __('Accordion\'s Class', 'TMSRVD'),
//                'desc' => __('Any extra classes you want to add', 'TMSRVD')
//            )
    ),
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'type' => 'text',
				'label' => __('Tab Title', 'TMSRVD'),
				'desc' => __('Add the title that will go above the item content', 'TMSRVD'),
				'std' => 'Title'
			),
			'active' => array(
                'default' => false,
				'type' => 'checkbox',
				'label' => __('Tab State', 'TMSRVD'),
				'desc' => __('Whether this tab should be "active" or selected', 'TMSRVD')
			),
			'fade' => array(
                'default' => false,
				'type' => 'checkbox',
				'label' => __('Fade', 'TMSRVD'),
				'desc' => __('Whether to use the "fade" effect when showing this tab', 'TMSRVD')
			),
            'data' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Tab Data Attibuts', 'TMSRVD'),
                'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
            ),
            'xclass' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Tab\'s Class', 'TMSRVD'),
                'desc' => __('Any extra classes you want to add', 'TMSRVD')
            ),
			'content' => array(
				'std' => 'Content',
				'type' => 'textarea',
				'label' => __('Tab Content', 'TMSRVD'),
				'desc' => __('Add the item content. Will accept HTML', 'TMSRVD'),
			)
		),
		'template' => '[tmsrvd_tab {{attributes}}] {{content}} [/tmsrvd_tab]',
		'clone_button' => __('Add Tab', 'TMSRVD')
	)
);


/* Alert Config --- */

$tmsrvd_shortcodes['alert'] = array(
	'title' => __('Alert', 'TMSRVD'),
	'id' => 'tmsrvd-alert-shortcode',
	'template' => '[tmsrvd_alert {{attributes}}] {{content}} [/tmsrvd_alert]',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __('Alert Type', 'TMSRVD'),
			'desc' => __('The type of the alert.', 'TMSRVD'),
			'options' => array(
                'success' => 'Success', 
                'info' => 'Info', 
                'warning' => 'Warning', 
                'danger' => 'Danger'
			)
		),
        'dismissable' => array(
            'default' => false,
            'type' => 'checkbox',
            'label' => __('Dismissable', 'TMSRVD'),
            'desc' => __('If the alert should be dismissable.', 'TMSRVD')
        ),
        'data' => array(
            'std' => '',
            'type' => 'text',
            'label' => __('Alert Data Attibuts', 'TMSRVD'),
            'desc' => __('Data attribute and value pairs separated by a comma. Pairs separated by pipe', 'TMSRVD')
        ),
        'xclass' => array(
            'std' => '',
            'type' => 'text',
            'label' => __('Alert\'s Class', 'TMSRVD'),
            'desc' => __('Any extra classes you want to add', 'TMSRVD')
        ),
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert Text', 'TMSRVD'),
			'desc' => __('Add the alert\'s text.', 'TMSRVD'),
		)

	)
);


?>
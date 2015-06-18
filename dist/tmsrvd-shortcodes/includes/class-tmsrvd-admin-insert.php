<?php
/**
 * Creates the admin interface to add shortcodes to the editor
 *
 * @package  TmsrvdShortcodes
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * TMSRVD_Admin_Insert class
 */
class TMSRVD_Admin_Insert {
  
	/**
	 * __construct function
	 *
	 * @access public
	 * @return  void
	 */
	public function __construct() {
		add_action( 'media_buttons', array( $this, 'media_buttons' ), 20 );
		add_action( 'admin_footer', array( $this, 'TMSRVD_popup_html' ) );
	}

	/**
	 * media_buttons function
	 *
	 * @access public
	 * @return void
	 */
	public function media_buttons( $editor_id = 'content' ) {
		global $pagenow;

		// Only run on add/edit screens
		if ( in_array( $pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php') ) ) {
			$output = '<a href="#TB_inline?width=4000&amp;inlineId=tmsrvd-choose-shortcode" class="thickbox button TMSRVD-thicbox" title="' . __( 'Insert Shortcode', 'TMSRVD' ) . '">' . __( 'Insert Shortcode', 'TMSRVD' ) . '</a>';
		}
		echo $output;
	}

	/**
	 * Build out the input fields for shortcode content
	 * @param  string $key
	 * @param  array $param the parameters of the input
	 * @return void
	 */
	public function TMSRVD_build_fields($key, $param) {
        if($param['type'] == 'acc_start') {
            $html = '<div class="acc"><div class="toggle">' . $param['label'] . '</div><div class="content">';
        }elseif($param['type'] == 'acc_end'){
            $html = '</div></div>';
        }else{ 
            $html = '<div class="table-row">';
            $html .= '<div class="label">' . $param['label'] . ':</div>';
            switch( $param['type'] )
            {
                case 'text' :

                    // prepare
                    $output = '<div><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
                    $output .= '<input type="text" class="tmsrvd-form-text tmsrvd-input" name="' . $key . '" id="' . $key . '" value="' . $param['std'] . '" />' . "\n";
                    $output .= '<span class="tmsrvd-form-desc">' . $param['desc'] . '</span></div>' . "\n";

                    // append
                    $html .= $output;

                    break;

                case 'textarea' :

                    // prepare
                    $output = '<div><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
                    $output .= '<textarea rows="10" cols="30" name="' . $key . '" id="' . $key . '" class="tmsrvd-form-textarea tmsrvd-input">' . $param['std'] . '</textarea>' . "\n";
                    $output .= '<span class="tmsrvd-form-desc">' . $param['desc'] . '</span></div>' . "\n";

                    // append
                    $html .= $output;

                    break;

                case 'select' :

                    // prepare
                    $output = '<div><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
                    $output .= '<select name="' . $key . '" id="' . $key . '" class="tmsrvd-form-select tmsrvd-input">' . "\n";

                    $selected = '';
                    if(isset($param['default'])) { $selected = $param['default']; }

                    foreach( $param['options'] as $value => $option )
                    {
                        $output .= '<option value="' . $value . '"'. ($value == $selected ?  'selected="selected"' : '') .'>' . $option . '</option>' . "\n";
                    }

                    $output .= '</select>' . "\n";
                    $output .= '<span class="tmsrvd-form-desc">' . $param['desc'] . '</span></div>' . "\n";

                    // append
                    $html .= $output;

                    break;

                case 'checkbox' :

                    // prepare
                    $output = '<div><label class="screen-reader-text" for="' . $key .'">' . $param['label'] . '</label>';
                    $output .= '<input type="checkbox" name="' . $key . '" id="' . $key . '" class="tmsrvd-form-checkbox tmsrvd-input"' . ( $param['default'] ? 'checked' : '' ) . '>' . "\n";
                    $output .= '<span class="tmsrvd-form-desc">' . $param['desc'] . '</span></div>';

                    $html .= $output;

                    break;

                default :
                    break;
            }
            $html .= '</div>';
        }
        
		return $html;
	}

	/**
	 * Popup window
	 *
	 * Print the footer code needed for the Insert Shortcode Popup
	 *
	 * @since 2.0
	 * @global $pagenow
	 * @return void Prints HTML
	 */
	function TMSRVD_popup_html() {
		global $pagenow;
		include(TMSRVD_PLUGIN_DIR . 'includes/config.php');

		// Only run in add/edit screens
		if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) { ?>

			<script type="text/javascript">
				function TMSRVDInsertShortcode() {
					// Grab input content, build the shortcodes, and insert them
					// into the content editor
					var select = jQuery('#select-tmsrvd-shortcode').val(),
						type = select.replace('TMSRVD-', '').replace('-shortcode', ''),
						template = jQuery('#' + select).data('shortcode-template'),
						childTemplate = jQuery('#' + select).data('shortcode-child-template'),
						tables = jQuery('#' + select).find('.table').not('.tmsrvd-clone-template'),
						attributes = '',
						content = '',
						contentToEditor = '';

					// go over each table, build the shortcode content
					for (var i = 0; i < tables.length; i++) {
						var elems = jQuery(tables[i]).find('input, select, textarea');

						// Build an attributes string by mapping over the input
						// fields in a given table.
						attributes = jQuery.map(elems, function(el, index) {
							var $el = jQuery(el);

							//console.log($el.attr('id'));

							if( $el.attr('id') === 'content' ) {
								content = $el.val();
								return '';
							} else if( $el.is(":checkbox") ) {
								if( $el.is(':checked') ) {
									return $el.attr('id') + '="true"';
								} else {
									return '';
								}
                            } else if( $el.is("select") ) {
                                if($el.val() !== '-') {
                                    return $el.attr('id') + '="' + $el.val() + '"';
                                } else {
									return '';
								}
							} else {
                                if($el.val()) {
								    return $el.attr('id') + '="' + $el.val() + '"';
                                }
							}
                            
						});
						attributes = attributes.join(' ').trim();

						// Place the attributes and content within the provided
						// shortcode template
						if( childTemplate ) {
							// Run the replace on attributes for columns because the
							// attributes are really the shortcodes
							contentToEditor += childTemplate.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
						} else {
							// Run the replace on attributes for columns because the
							// attributes are really the shortcodes
							contentToEditor += template.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
						}
					};

					// Insert built content into the parent template
					if( childTemplate ) {
						contentToEditor = template.replace('{{child_shortcode}}', contentToEditor);
					}

					// Send the shortcode to the content editor and reset the fields
					window.send_to_editor( contentToEditor );
					TMSRVDResetFields();
				}

				// Set the inputs to empty state
				function TMSRVDResetFields() {
					jQuery('#tmsrvd-shortcode-title').text('');
					jQuery('#tmsrvd-shortcode-wrap').find('input[type=text], select').val('');
					jQuery('#tmsrvd-shortcode-wrap').find('textarea').text('');
					jQuery('.tmsrvd-was-cloned').remove();
					jQuery('.tmsrvd-shortcode-type').hide();
				}

				// Function to redraw the thickbox for new content
				function TMSRVDResizeTB() {
					var	ajaxCont = jQuery('#TB_ajaxContent'),
						tbWindow = jQuery('#TB_window'),
						tmsrvdPopup = jQuery('#tmsrvd-shortcode-wrap');

					ajaxCont.css({
						height: (tbWindow.outerHeight()-47),
						overflow: 'auto', // IMPORTANT
						width: (tbWindow.outerWidth() - 30)
					});
				}

				// Simple function to clone an included template
				function TMSRVDCloneContent(el) {
					var clone = jQuery(el).find('.tmsrvd-clone-template').clone().removeClass('hidden tmsrvd-clone-template').removeAttr('id').addClass('tmsrvd-was-cloned');

					jQuery(el).append(clone);
				}

				jQuery(document).ready(function($) {
					var $shortcodes = $('.tmsrvd-shortcode-type').hide(),
						$title = $('#tmsrvd-shortcode-title');

					// Show the selected shortcode input fields
	                $('#select-tmsrvd-shortcode').change(function () {
	                	var text = $(this).find('option:selected').text();

	                	$shortcodes.hide();
	                	$title.text(text);
	                    $('#' + $(this).val()).show();
	                    TMSRVDResizeTB();
	                });

	                // Clone a set of input fields
	                $('.clone-content').on('click', function() {
						var el = $(this).siblings('.tmsrvd-sortable');
                        
						TMSRVDCloneContent(el);
						TMSRVDResizeTB();
						$('.tmsrvd-sortable').sortable('refresh');
					});

	                // Remove a set of input fields
					$('.tmsrvd-shortcode-type').on('click', '.tmsrvd-remove' ,function() {
						$(this).closest('.table').remove();
					});

					// Make content sortable using the jQuery UI Sortable method
					$('.tmsrvd-sortable').sortable({
						items: '.table:not(".hidden")',
						placeholder: 'tmsrvd-sortable-placeholder'
					});
                    
                    // Toggles
                    $('.acc .toggle').click(function(){
                        $(this).next().slideToggle();
                    });
	            });
			</script>

			<div id="tmsrvd-choose-shortcode" style="display: none;">
				<div id="tmsrvd-shortcode-wrap" class="wrap tmsrvd-shortcode-wrap">
					<div class="tmsrvd-shortcode-select">
						<label for="tmsrvd-shortcode"><?php _e('Select the shortcode type', 'TMSRVD'); ?></label>
						<select name="tmsrvd-shortcode" id="select-tmsrvd-shortcode">
							<option><?php _e('Select Shortcode', 'TMSRVD'); ?></option>
							<?php foreach( $tmsrvd_shortcodes as $shortcode ) {
								echo '<option data-title="' . $shortcode['title'] . '" value="' . $shortcode['id'] . '">' . $shortcode['title'] . '</option>';
							} ?>
						</select>
					</div>

					<h3 id="tmsrvd-shortcode-title"></h3>

				<?php

				$html = '';
				$clone_button = array( 'show' => false );

				// Loop through each shortcode building content
				foreach( $tmsrvd_shortcodes as $key => $shortcode ) {

					// Add shortcode templates to be used when building with JS
					$shortcode_template = ' data-shortcode-template="' . $shortcode['template'] . '"';
					if( array_key_exists('child_shortcode', $shortcode ) ) {
						$shortcode_template .= ' data-shortcode-child-template="' . $shortcode['child_shortcode']['template'] . '"';
					}

					// Individual shortcode 'block'
					$html .= '<div id="' . $shortcode['id'] . '" class="tmsrvd-shortcode-type" ' . $shortcode_template . '>';

					// If shortcode has children, it can be cloned and is sortable.
					// Add a hidden clone template, and set clone button to be displayed.
					if( array_key_exists('child_shortcode', $shortcode ) ) {
						$html .= (isset($shortcode['child_shortcode']['shortcode']) ? $shortcode['child_shortcode']['shortcode'] : null);
						$shortcode['params'] = $shortcode['child_shortcode']['params'];
						$clone_button['show'] = true;
						$clone_button['text'] = $shortcode['child_shortcode']['clone_button'];
						$html .= '<div class="tmsrvd-sortable">';
						$html .= '<div id="clone-' . $shortcode['id'] . '" class="table hidden tmsrvd-clone-template">';
						foreach( $shortcode['params'] as $key => $param ) {
							$html .= $this->TMSRVD_build_fields($key, $param);
						}
						if( $clone_button['show'] ) {
							$html .= '<div class="table-row"><div colspan="2"><a href="#" class="tmsrvd-remove">' . __('Remove', 'TMSRVD') . '</a></div></div>';
						}
						$html .= '</div>'; // end table
					}

					// Build the actual shortcode input fields
					$html .= '<div class="table">';
					foreach( $shortcode['params'] as $key => $param ) {
						$html .= $this->TMSRVD_build_fields($key, $param);
					}

					// Add a link to remove a content block
					if( $clone_button['show'] ) {
						$html .= '<div class="table-row"><div colspan="2"><a href="#" class="tmsrvd-remove">' . __('Remove', 'TMSRVD') . '</a></div></div>';
					}
					$html .= '</div>'; // end table

					// Close out the sortable div and display the clone button as needed
					if( $clone_button['show'] ) {
						$html .= '</div>';
						$html .= '<a id="add-' . $shortcode['id'] . '" href="#" class="button-secondary clone-content">' . $clone_button['text'] . '</a>';
						$clone_button['show'] = false;
					}

					// Display notes if provided
					if( array_key_exists('notes', $shortcode) ) {
						$html .= '<p class="tmsrvd-notes">' . $shortcode['notes'] . '</p>';
					}
					$html .= '</div>';
				}

				echo $html;
				?>

				<p class="submit">
					<input type="button" id="tmsrvd-insert-shortcode" class="button-primary" value="<?php _e('Insert Shortcode', 'TMSRVD'); ?>" onclick="TMSRVDInsertShortcode();" />
					<a href="#" id="tmsrvd-cancel-shortcode-insert" class="button-secondary tmsrvd-cancel-shortcode-insert" onclick="tb_remove();"><?php _e('Cancel', 'TMSRVD'); ?></a>
				</p>
				</div>
			</div>

		<?php
		}
	}
}

new TMSRVD_Admin_Insert();
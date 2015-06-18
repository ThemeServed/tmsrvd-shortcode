<?php
/**
 * Create and define the shortcodes
 *
 * @package TmsrvdShortcodes
 * @since  1.0
 */

/*--------------------------------------------------------------------------------------
*
* Parse data-attributes for shortcodes
*
*-------------------------------------------------------------------------------------*/
function parse_data_attributes( $data ) {

    $data_props = '';

    if( $data ) {
      $data = explode( '|', $data );

      foreach( $data as $d ) {
        $d = explode( ',', $d );
        $data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
      }
    }
    else { 
      $data_props = false;
    }
    return $data_props;
}

// Intelligently remove extra P and BR tags around shortcodes that WordPress likes to add
function tmsrvd_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']',
        ']<br>' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'tmsrvd_fix_shortcodes');

function tmsrvd_cleanup_domdocument($content) {
    $content = preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', $content);
    return $content;
}

// We need to be able to figure out the attributes of a wrapped shortcode
function tmsrvd_attribute_map($str, $att = null) {
    $res = array();
    $return = array();
    $reg = get_shortcode_regex();
    preg_match_all('~'.$reg.'~',$str, $matches);
    foreach($matches[2] as $key => $name) {
        $parsed = shortcode_parse_atts($matches[3][$key]);
        $parsed = is_array($parsed) ? $parsed : array();

            $res[$name] = $parsed;
            $return[] = $res;
        }
    return $return;
}



/*--------------------------------------------------------------------------------------
*
* tmsrvd_column
*
* @since 1.0.0
* @todo pull and offset
*-------------------------------------------------------------------------------------*/

function tmsrvd_column( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        "lg"          => false,
        "md"          => false,
        "sm"          => false,
        "xs"          => false,
        "offset_lg"   => false,
        "offset_md"   => false,
        "offset_sm"   => false,
        "offset_xs"   => false,
        "pull_lg"     => false,
        "pull_md"     => false,
        "pull_sm"     => false,
        "pull_xs"     => false,
        "push_lg"     => false,
        "push_md"     => false,
        "push_sm"     => false,
        "push_xs"     => false,
        "xclass"      => false,
        "data"        => false
    ), $atts );

    $class  = '';
    $class .= ( $atts['lg'] )			                                ? ' col-lg-' . $atts['lg'] : '';
    $class .= ( $atts['md'] )                                           ? ' col-md-' . $atts['md'] : '';
    $class .= ( $atts['sm'] )                                           ? ' col-sm-' . $atts['sm'] : '';
    $class .= ( $atts['xs'] )                                           ? ' col-xs-' . $atts['xs'] : '';
    $class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" )      ? ' col-lg-offset-' . $atts['offset_lg'] : '';
    $class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" )      ? ' col-md-offset-' . $atts['offset_md'] : '';
    $class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" )      ? ' col-sm-offset-' . $atts['offset_sm'] : '';
    $class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" )      ? ' col-xs-offset-' . $atts['offset_xs'] : '';
    $class .= ( $atts['pull_lg']   || $atts['pull_lg'] === "0" )        ? ' col-lg-pull-' . $atts['pull_lg'] : '';
    $class .= ( $atts['pull_md']   || $atts['pull_md'] === "0" )        ? ' col-md-pull-' . $atts['pull_md'] : '';
    $class .= ( $atts['pull_sm']   || $atts['pull_sm'] === "0" )        ? ' col-sm-pull-' . $atts['pull_sm'] : '';
    $class .= ( $atts['pull_xs']   || $atts['pull_xs'] === "0" )        ? ' col-xs-pull-' . $atts['pull_xs'] : '';
    $class .= ( $atts['push_lg']   || $atts['push_lg'] === "0" )        ? ' col-lg-push-' . $atts['push_lg'] : '';
    $class .= ( $atts['push_md']   || $atts['push_md'] === "0" )        ? ' col-md-push-' . $atts['push_md'] : '';
    $class .= ( $atts['push_sm']   || $atts['push_sm'] === "0" )        ? ' col-sm-push-' . $atts['push_sm'] : '';
    $class .= ( $atts['push_xs']   || $atts['push_xs'] === "0" )        ? ' col-xs-push-' . $atts['push_xs'] : '';
    $class .= ( $atts['xclass'] )                                       ? ' ' . $atts['xclass'] : '';

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf( 
        '<div class="%s"%s>%s</div>',
            esc_attr( $class ),
            ( $data_props ) ? ' ' . $data_props : '',
            do_shortcode( $content )
        );
    }

add_shortcode('tmsrvd_column', 'tmsrvd_column');

/*--------------------------------------------------------------------------------------
*
* tmsrvd_button
*
* @since 1.0.0
* //DW mod added xclass var
* @todo dropdown
*-------------------------------------------------------------------------------------*/


function tmsrvd_button( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        "type"     => false,
        "size"     => false,
        "block"    => false,
//        "dropdown" => false,
        "link"     => '',
        "target"   => false,
        "disabled" => false,
        "active"   => false,
        "xclass"   => false,
        "title"    => false,
        "title"    => false,
        "data"     => false
    ), $atts );

    $class  = 'btn';
    $class .= ( $atts['type'] )     ? ' btn-' . $atts['type'] : ' btn-default';
    $class .= ( $atts['size'] )     ? ' btn-' . $atts['size'] : '';
    $class .= ( $atts['block'] == 'true' )    ? ' btn-block' : '';
//    $class .= ( $atts['dropdown']   == 'true' ) ? ' dropdown-toggle' : '';
    $class .= ( $atts['disabled']   == 'true' ) ? ' disabled' : '';
    $class .= ( $atts['active']     == 'true' )   ? ' active' : '';
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf( 
    '<a href="%s" class="%s"%s%s%s>%s</a>',
        esc_url( $atts['link'] ),
        esc_attr( $class ),
        ( $atts['target'] )     ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
        ( $atts['title'] )      ? sprintf( ' title="%s"',  esc_attr( $atts['title'] ) )  : '',
        ( $data_props ) ? ' ' . $data_props : '',
        do_shortcode( $content )
    );

}
    
add_shortcode('tmsrvd_button', 'tmsrvd_button');



/*--------------------------------------------------------------------------------------
*
* tmsrvd_collapsibles
*
* @since 1.0
*
*-------------------------------------------------------------------------------------*/
function tmsrvd_collapsibles( $atts, $content = null ) {

    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;

	$atts = shortcode_atts( array(
      "xclass" => false,
      "data"   => false
	), $atts );
      
    $class = 'panel-group';
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';
      
    $id = 'custom-collapse-'. $GLOBALS['collapsibles_count'];
 
    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf( 
      '<div class="%s" id="%s"%s>%s</div>',
      esc_attr( $class ),
      esc_attr( $id ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );

}

add_shortcode('tmsrvd_collapsibles', 'tmsrvd_collapsibles');

/*--------------------------------------------------------------------------------------
*
* tmsrvd_collapse
*
* @since 1.0
*
*-------------------------------------------------------------------------------------*/
function tmsrvd_collapse( $atts, $content = null ) {

	$atts = shortcode_atts( array(
      "title"   => false,
      "type"    => false,
      "active"  => false,
      "xclass"  => false,
      "data"    => false
	), $atts );

    $panel_class = 'panel';
    $panel_class .= ( $atts['type'] )     ? ' panel-' . $atts['type'] : ' panel-default';
    $panel_class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';
      
    $collapse_class = 'panel-collapse';
    $collapse_class .= ( $atts['active'] == 'true' )  ? ' in' : ' collapse';
      
    $a_class = '';
    $a_class .= ( $atts['active'] == 'true' )  ? '' : 'collapsed';

    $parent = 'custom-collapse-'. $GLOBALS['collapsibles_count'];
    $current_collapse = $parent . '-'. md5( $atts['title'] );

    $data_props = parse_data_attributes( $atts['data'] );
      
    return sprintf( 
      '<div class="%1$s"%2$s>
        <div class="panel-heading">
          <h4 class="panel-title">
            <a class="%3$s" data-toggle="collapse" data-parent="#%4$s" href="#%5$s">%6$s</a>
          </h4>
        </div>
        <div id="%5$s" class="%7$s">
          <div class="panel-body">%8$s</div>
        </div>
      </div>',
      esc_attr( $panel_class ),
      ( $data_props ) ? ' ' . $data_props : '',
      $a_class,
      $parent,
      $current_collapse,
      $atts['title'],
      esc_attr( $collapse_class ),
      do_shortcode( $content )
    );
}

add_shortcode('tmsrvd_collapse', 'tmsrvd_collapse');

/*--------------------------------------------------------------------------------------
*
* tmsrvd_alert
*
* @since 1.0
*
*-------------------------------------------------------------------------------------*/
function tmsrvd_alert( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      "type"          => false,
      "dismissable"   => false,
      "xclass"        => false,
      "data"          => false
    ), $atts );

    $class  = 'alert';
    $class .= ( $atts['type'] )         ? ' alert-' . $atts['type'] : ' alert-success';
    $class .= ( $atts['dismissable']   == 'true' )  ? ' alert-dismissable' : '';
    $class .= ( $atts['xclass'] )       ? ' ' . $atts['xclass'] : '';

    $dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '';

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf( 
      '<div class="%s"%s>%s%s</div>',
      esc_attr( $class ),
      ( $data_props )  ? ' ' . $data_props : '',
      $dismissable,
      do_shortcode( $content )
    );
}
add_shortcode('tmsrvd_alert', 'tmsrvd_alert');

/*--------------------------------------------------------------------------------------
*
* tmsrvd_tabs
*
* @author Filip Stefansson
* @since 1.0
* Modified by TwItCh twitch@designweapon.com
* Now acts a whole nav/tab/pill shortcode solution!
*-------------------------------------------------------------------------------------*/
function tmsrvd_tabs( $atts, $content = null ) {

    if( isset( $GLOBALS['tabs_count'] ) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;

    $GLOBALS['tabs_default_count'] = 0;

    $atts = shortcode_atts( array(
      "type"   => false,
      "xclass" => false,
      "data"   => false
    ), $atts );

    $ul_class  = 'nav';
    $ul_class .= ( $atts['type'] )     ? ' nav-' . $atts['type'] : ' nav-tabs';
    $ul_class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

    $div_class = 'tab-content';

    $id = 'custom-tabs-'. $GLOBALS['tabs_count'];

    $data_props = parse_data_attributes( $atts['data'] );

    $atts_map = tmsrvd_attribute_map( $content );

    // Extract the tab titles for use in the tab widget.
    if ( $atts_map ) {
      $tabs = array();
      $GLOBALS['tabs_default_active'] = true;
      foreach( $atts_map as $check ) {
          if( !empty($check["tmsrvd_tab"]["active"]) ) {
              $GLOBALS['tabs_default_active'] = false;
          }
      }
      $i = 0;
      foreach( $atts_map as $tab ) {

        $class  ='';
        $class .= ( !empty($tab["tmsrvd_tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? 'active' : '';
        $class .= ( !empty($tab["tmsrvd_tab"]["xclass"]) ) ? ' ' . $tab["tmsrvd_tab"]["xclass"] : '';

        $tabs[] = sprintf(
          '<li%s><a href="#%s" data-toggle="tab">%s</a></li>',
          ( !empty($class) ) ? ' class="' . $class . '"' : '',
          'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5($tab["tmsrvd_tab"]["title"]),
          $tab["tmsrvd_tab"]["title"]
        );
        $i++;
      }
}
return sprintf( 
  '<ul class="%s" id="%s"%s>%s</ul><div class="%s">%s</div>',
  esc_attr( $ul_class ),
  esc_attr( $id ),
  ( $data_props ) ? ' ' . $data_props : '',
  ( $tabs )  ? implode( $tabs ) : '',
  esc_attr( $div_class ),
  do_shortcode( $content )
);
}

add_shortcode('tmsrvd_tabs', 'tmsrvd_tabs');

/*--------------------------------------------------------------------------------------
*
* tmsrvd_tab
*
* @author Filip Stefansson
* @since 1.0
*
*-------------------------------------------------------------------------------------*/
function tmsrvd_tab( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      'title'   => false,
      'active'  => false,
      'fade'    => false,
      'xclass'  => false,
      'data'    => false
    ), $atts );

    if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
        $atts['active'] = true;
    }
    $GLOBALS['tabs_default_count']++;

    $class  = 'tab-pane';
    $class .= ( $atts['fade']   == 'true' )                            ? ' fade' : '';
    $class .= ( $atts['active'] == 'true' )                            ? ' active' : '';
    $class .= ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? ' in' : '';
    $class .= ( $atts['xclass'] )                                      ? ' ' . $atts['xclass'] : '';


    $id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. md5( $atts['title'] );

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf( 
      '<div id="%s" class="%s"%s>%s</div>',
      esc_attr( $id ),
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );

}

add_shortcode('tmsrvd_tab', 'tmsrvd_tab');


?>
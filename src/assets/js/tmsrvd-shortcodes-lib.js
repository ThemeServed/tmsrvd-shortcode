jQuery(document).ready(function($) {
    $('.acc .toggle').click(function(){
        $(this).next().slideToggle();
    });
//
//	$(".tmsrvd-tabs").tabs();
//
//	$(".tmsrvd-toggle").each( function () {
//		var $this = $(this);
//		if( $this.attr('data-id') == 'closed' ) {
//			$this.accordion({ header: '.tmsrvd-toggle-title', collapsible: true, active: false  });
//		} else {
//			$this.accordion({ header: '.tmsrvd-toggle-title', collapsible: true});
//		}
//
//		$this.on('accordionactivate', function( e, ui ) {
//			$this.accordion('refresh');
//		});
//
//		$(window).on('resize', function() {
//			$this.accordion('refresh');
//		});
//	});

});
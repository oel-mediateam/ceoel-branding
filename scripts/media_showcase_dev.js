jQuery( document ).ready( function() {
    
    var items = jQuery( '.showcase-cat-nav ul li.cat-parent a' ).not( jQuery( 'ul.children li a' ) );
    
    items.each( function() {
        
        jQuery( this ).parent().attr( 'data-open', 0 );
        
    } );
    
    jQuery.fn.mobileNavClick( items );
    jQuery.fn.navHover( items );
    
    if ( jQuery( '.showcase-tags' ).length ) {
        
        jQuery.fn.showcaseTooltip();
        
    }
    
} );

jQuery.fn.navHover = function( items ) {
    
    items.on( 'mouseover', function() {
        
        var parent = jQuery( this ).parent();
        var children = parent.find( '.children' );
        var open = Number( parent.attr( 'data-open' ) );
        
        if ( jQuery( window ).width() >= 620 ) {
            
            if ( open === 0  ) {
                
                children.slideDown( function() {
                
                    parent.attr( 'data-open', 1 );
                    
                    parent.on( 'mouseleave', function() {
                        
                        if ( jQuery( window ).width() >= 620 ) {
                            
                            children.slideUp( function() {
                                
                                parent.attr( 'data-open', 0 );
                                
                            } );
                        
                        }
                        
                    } );
                    
                } );
                
            }
            
        }
        
    } );
    
};

jQuery.fn.mobileNavClick = function( items ) {
    
    items.on( 'click', function() {
        
        var parent = jQuery( this ).parent();
        var children = parent.find( '.children' );
        var open = Number( parent.attr( 'data-open' ) );
        
        if ( jQuery( window ).width() < 619 ) {
            
            if ( open === 0  ) {
            
                jQuery( this ).addClass( 'open' );
                
                children.slideDown( function() {
                
                    parent.attr( 'data-open', 1 );
                    
                } );
                
            } else {
                
                jQuery( this ).removeClass( 'open' );
                
                children.slideUp( function() {
                
                    parent.attr( 'data-open', 0 );
                    
                } );
                
            }
            
            return false;
            
        }
        
    } );   
    
};

jQuery.fn.showcaseTooltip = function() {
    
    jQuery( '.showcase-tags' ).on( 'mouseover', function() {
        
        if ( jQuery( window ).width() >= 955 ) {
            
            var pos = jQuery( this ).position();
            var top = Math.floor( pos.top + 32 );
            var left = Math.floor( pos.left - 125 + ( jQuery( this ).width() / 2 ) );
            
            jQuery( this ).after( '<div class="showcase-tooltip" style="display:none; top: ' + top + 'px; left: ' + left + 'px;">' + '<p><strong>' + jQuery( this ).html() + '</strong></p><p>' + jQuery( this ).attr( 'data-desc' ) + '</p><p><small>Click this tag to see more showcase items like it.</small></p></div>' );
            
            jQuery( '.showcase-tooltip' ).fadeIn( 'fast' );
        
            jQuery( this ).on( 'mouseleave', function() {
                
                jQuery( '.showcase-tooltip' ).fadeOut( 'fast', function() {
                    
                    jQuery( this ).remove();
                    
                } );
                
            } );

        }
                
    } );
    
};
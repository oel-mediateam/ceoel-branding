jQuery( document ).ready( function() {
    
    var items = jQuery( '.branding-cat-nav ul li.cat-parent a' ).not( jQuery( 'ul.children li a' ) );
    
    items.each( function() {
        
        jQuery( this ).parent().attr( 'data-open', 0 );
        
    } );
    
    jQuery.fn.mobileNavClick( items );
    jQuery.fn.navHover( items );
    
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
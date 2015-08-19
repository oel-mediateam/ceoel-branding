$( document ).ready( function() {
    
    var items = $( '.showcase-cat-nav ul li.cat-parent a' ).not( $( 'ul.children li a' ) );
    
    items.each( function() {
        
        $( this ).parent().attr( 'data-open', 0 );
        
    } );
    
    $.fn.mobileNavClick( items );
    $.fn.navHover( items );
    
} );

$.fn.navHover = function( items ) {
    
    items.on( 'mouseover', function() {
        
        var parent = $( this ).parent();
        var children = parent.find( '.children' );
        var open = Number( parent.attr( 'data-open' ) );
        
        if ( $( window ).width() >= 620 ) {
            
            if ( open === 0  ) {
                
                children.slideDown( function() {
                
                    parent.attr( 'data-open', 1 );
                    
                    parent.on( 'mouseleave', function() {
                        
                        if ( $( window ).width() >= 620 ) {
                            
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

$.fn.mobileNavClick = function( items ) {
    
    items.on( 'click', function() {
        
        var parent = $( this ).parent();
        var children = parent.find( '.children' );
        var open = Number( parent.attr( 'data-open' ) );
        
        if ( $( window ).width() < 619 ) {
            
            if ( open === 0  ) {
            
                $( this ).addClass( 'open' );
                
                children.slideDown( function() {
                
                    parent.attr( 'data-open', 1 );
                    
                } );
                
            } else {
                
                $( this ).removeClass( 'open' );
                
                children.slideUp( function() {
                
                    parent.attr( 'data-open', 0 );
                    
                } );
                
            }
            
            return false;
            
        }
        
    } );   
    
};
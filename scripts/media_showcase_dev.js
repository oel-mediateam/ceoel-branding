$( document ).ready( function() {
    
    $.fn.mobileNav();
    
} );

$.fn.mobileNav = function() {
    
    var parents = $( '.showcase-cat-nav ul li.cat-parent a' ).not( $( 'ul.children li a' ) );
    
    parents.each( function() {
        
        $( this ).parent().attr( 'data-open', 0 );
        
    } );
    
    parents.on( 'click', function() {
        
        var width = $( window ).width();
        var open = Number( $( this ).parent().attr( 'data-open' ) );
        
        if ( width < 619 ) {
            
            if ( open === 0  ) {
            
                $( this ).addClass( 'open' );
                
                $( this ).parent().find( '.children' ).slideDown( function() {
                
                    $( this ).parent().attr( 'data-open', 1 );
                    
                } );
                
            } else {
                
                $( this ).removeClass( 'open' );
                
                $( this ).parent().find( '.children' ).slideUp( function() {
                
                    $( this ).parent().attr( 'data-open', 0 );
                    
                } );
                
            }
            
            return false;
            
        }
        
    } );
        
    
};
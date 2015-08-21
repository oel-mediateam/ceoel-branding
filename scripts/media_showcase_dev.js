$( document ).ready( function() {
    
    var items = $( '.showcase-cat-nav ul li.cat-parent a' ).not( $( 'ul.children li a' ) );
    
    items.each( function() {
        
        $( this ).parent().attr( 'data-open', 0 );
        
    } );
    
    $.fn.mobileNavClick( items );
    $.fn.navHover( items );
    
    if ( $( '.showcase-tags' ).length ) {
        
        $.fn.tooltip();
        
    }
    
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

$.fn.tooltip = function() {
    
    $( '.showcase-tags' ).on( 'mouseover', function() {
        
        if ( $( window ).width() >= 955 ) {
            
            var pos = $( this ).position();
            var top = Math.floor( pos.top + 32 );
            var left = Math.floor( pos.left - 125 + ( $( this ).width() / 2 ) );
            
            console.log( top );
            
            $( this ).after( '<div class="tooltip" style="display:none; top: ' + top + 'px; left: ' + left + 'px;">' + '<p><strong>' + $( this ).html() + '</strong></p><p>' + $( this ).attr( 'data-desc' ) + '</p><p><small>Click this tag to see more showcase items like it.</small></p></div>' );
            
            $( '.tooltip' ).fadeIn( 'fast' );
        
            $( this ).on( 'mouseleave', function() {
                
                $( '.tooltip' ).fadeOut( 'fast', function() {
                    
                    $( this ).remove();
                    
                } );
                
            } );

        }
                
    } );
    
};
jQuery( document ).ready( function($) {
    var $branding_single = $('.single-branding');
    if($branding_single.length){
        //Creates a jump menu on single post type pages based on h2 headings
        var $headings = $('h2'),
            $entry_header = $('.entry-header'),
            nav_string = '<div id="ceoel-branding-jump-wrapper"><p><a name="top"></a>Jump to:</p><ul>';
        if($headings.length) {
            $.each($headings, function(index, element){
                var $el = $(element),
                    el_text = $.trim($el.text());
                if(el_text !== '') {
                    var el_link = el_text.replace(/\s+/g, "_").toLowerCase();
                    $el.html('<a name="'+ el_link +'"></a>' + el_text );
                    nav_string += (index > 0 ? '<li>|</li>' : '') + '<li><a href="#'+ el_link + '">' + el_text + '</a>';
                    if(index > 0) {
                        $el.before('<p><a href="#top">Back to top</a></p>');
                    }
                }
            });

            nav_string += '</ul><div style="clear:both;"></div></div>';
            $entry_header.append(nav_string);
            //smooth scrolling on the jump menu
            $('a[href^=#]:not([href=#])').on('click', function() {
                var $target =  $('a[name=' + this.hash.replace('#','') +']');
                if ($target.length) {
                    $('html,body').animate({
                        scrollTop:$target.offset().top
                    }, 1000);
                    return false;
                }
            });
        }
    }  
    
} );
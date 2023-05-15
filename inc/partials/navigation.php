<?php 
if ( paginate_links() ) printf(
    '<div class="navigation">%s</div>',
    paginate_links(
        array( 
            'prev_text' => '«',
            'next_text' => '»' 
        )
    )
);
?>
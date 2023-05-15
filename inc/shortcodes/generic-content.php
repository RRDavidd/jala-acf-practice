<?php
// Add Shortcode
function generic_content( $args ) {

	// Example
	// [generic_content]

    return '<h1>This is a h1</h1>
        <h2>This is a h2</h2>
        <h3>This is a h3</h3>
        <h4>This is a h4</h4>
        <h5>This is a h5</h5>
        <h6>This is a h6</h6>
        <p>This is a paragraph. <em>This is italic text.</em> <strong>This is bold text.</strong> <del>This is strikethrough text.</del> <a href="https://jaladesign.com.au/" target="_blank" rel="noopener">This is a link.</a></p>
        <p class="h5 font-weight-thin">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-extralight">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-light">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-normal">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-medium">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-semibold">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-bold">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-extrabold">The quick brown fox jumps over the lazy dog.</p>
        <p class="h5 font-weight-black">The quick brown fox jumps over the lazy dog.</p>
        <ul>
            <li>Item A</li>
            <li>Item B</li>
            <li>Item C</li>
        </ul>
        <ol>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ol>
        <blockquote>This is a blockquote.</blockquote>';

}
add_shortcode( 'generic_content', 'generic_content' );
<?php

header( 'Content-Type: text/plain; charset=' . get_option( 'blog_charset' ), true );

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$cmd = get_query_var( 'orbis_website_command' );

		$file = plugin_dir_path( __FILE__ ) . 'website-command-' . $cmd . '.php';

		if ( is_readable( $file ) ) {
			include $file;
		}

		echo "\r\n";
		echo "\r\n";
	}
}

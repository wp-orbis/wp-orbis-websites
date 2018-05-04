<?php

$post = get_post();

$url              = get_post_meta( $post->ID, '_orbis_website_url', true );
$host             = get_post_meta( $post->ID, '_orbis_website_host', true );
$host_keychain_id = get_post_meta( $post->ID, '_orbis_website_host_keychain_id', true );
$root_path        = get_post_meta( $post->ID, '_orbis_website_root_path', true );
$public_path      = get_post_meta( $post->ID, '_orbis_website_public_path', true );
$has_wp_cli       = get_post_meta( $post->ID, '_orbis_website_has_wp_cli', true );
$git_url          = get_post_meta( $post->ID, '_orbis_website_git_url', true );
$iwp_site_id      = get_post_meta( $post->ID, '_orbis_website_infinitewp_id', true );

?>
<dl>
	<dt><?php esc_html_e( 'Git Checkout', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		printf(
			'git checkout %s .',
			$git_url
		);

		?></code>
	</dd>

	<dt><?php esc_html_e( 'cURL Head', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		printf(
			'curl --head %s',
			$url
		);

		?></code>
	</dd>

	<dt><?php esc_html_e( 'cURL HTTP Status', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		echo esc_html( implode( ' ', array(
			'curl',
			'--silent', // https://curl.haxx.se/docs/manpage.html#-s
			'--location', // https://curl.haxx.se/docs/manpage.html#-L
			'--max-time 7', // https://curl.haxx.se/docs/manpage.html#-m
			'--write-out "%{http_code}\t%{url_effective}\\n"', // https://curl.haxx.se/docs/manpage.html#-w
			'--user-agent "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/601.5.17 (KHTML, like Gecko) Version/9.1 Safari/601.5.17"', // https://curl.haxx.se/docs/manpage.html#-A
			$url
		) ) );

		?></code>
	</dd>

	<dt><?php esc_html_e( 'Dig Any', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		printf(
			'dig %s ANY',
			get_the_title()
		);

		?></code>
	</dd>

	<dt><?php esc_html_e( 'Chrome Screenshot', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		printf(
			'chrome --headless --disable-gpu --screenshot %s',
			$url
		);

		?></code>
	</dd>

	<dt><?php esc_html_e( 'webkit2png', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php

		echo esc_html( implode( ' ', array(
			'webkit2png',
			'--timeout=45',
			'--ignore-ssl-check',
			'--width=1280',
			'--clipwidth=320',
			'--clipheight=320',
			'--datestamp',
			$url
		) ) );

		?></code>
	</dd>

	<dt><?php esc_html_e( 'InfiniteWP Load Site', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		$url = add_query_arg( array(
			'action' => 'loadSite',
			'siteID' => $iwp_site_id,
		), 'https://infinitewp.pronamic.eu/ajax.php' );

		printf(
			'<a href="%s" target="_blank">%s</a>',
			esc_url( $url ),
			esc_html( $url )
		);

		?>
	</dd>

	<dt><?php esc_html_e( 'WP-CLI Verify Checksums', 'orbis-websites' ); ?></dt>
	<dd>
		<ul>
			<li>
				<code>wp core verify-checksums</code>
			</li>
			<li>
				<code>wp plugin verify-checksums --all --strict</code>
			</li>
		</ul>
	</dd>
</dl>

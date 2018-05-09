<?php

use League\Uri\Uri;

$post = get_post();

$url              = get_post_meta( $post->ID, '_orbis_website_url', true );
$host             = get_post_meta( $post->ID, '_orbis_website_host', true );
$ftp_keychain_id  = get_post_meta( $post->ID, '_orbis_website_ftp_keychain_id', true );
$ssh_keychain_id  = get_post_meta( $post->ID, '_orbis_website_ssh_keychain_id', true );
$root_path        = get_post_meta( $post->ID, '_orbis_website_root_path', true );
$public_path      = get_post_meta( $post->ID, '_orbis_website_public_path', true );
$has_wp_cli       = get_post_meta( $post->ID, '_orbis_website_has_wp_cli', true );
$git_url          = get_post_meta( $post->ID, '_orbis_website_git_url', true );
$iwp_site_id      = get_post_meta( $post->ID, '_orbis_website_infinitewp_id', true );
$wp_keychain_id   = get_post_meta( $post->ID, '_orbis_website_wp_keychain_id', true );
$monitor_id       = get_post_meta( $post->ID, '_orbis_website_monitor_id', true );

?>
<dl>
	<dt><?php esc_html_e( 'URL', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		printf(
			'<a href="%s">%s</a>',
			esc_url( $url ),
			esc_html( $url )
		);

		?>
	</dd>

	<dt><?php esc_html_e( 'Host', 'orbis-websites' ); ?></dt>
	<dd>
		<code><?php echo esc_html( $host ); ?></code>
	</dd>

	<dt><?php esc_html_e( 'FTP Keychain', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		if ( empty( $ftp_keychain_id ) ) {
			echo '';
		} else {
			printf(
				'<a href="%s">%s</a>',
				esc_url( get_permalink( $ftp_keychain_id ) ),
				esc_html( get_the_title( $ftp_keychain_id ) )
			);
		}

		?>
	</dd>

	<dt><?php esc_html_e( 'SSH Keychain', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		if ( empty( $ssh_keychain_id ) ) {
			echo '';
		} else {
			printf(
				'<a href="%s">%s</a>',
				esc_url( get_permalink( $ssh_keychain_id ) ),
				esc_html( get_the_title( $ssh_keychain_id ) )
			);
		}

		?>
	</dd>

	<dt><?php esc_html_e( 'WordPress Keychain', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		if ( empty( $wp_keychain_id ) ) {
			echo '';
		} else {
			printf(
				'<a href="%s">%s</a>',
				esc_url( get_permalink( $wp_keychain_id ) ),
				esc_html( get_the_title( $wp_keychain_id ) )
			);
		}

		?>
	</dd>

	<dt><?php esc_html_e( 'Monitor', 'orbis-websites' ); ?></dt>
	<dd>
		<?php

		if ( empty( $monitor_id ) ) {
			echo '';
		} else {
			printf(
				'<a href="%s">%s</a>',
				esc_url( get_permalink( $monitor_id ) ),
				esc_html( get_the_title( $monitor_id ) )
			);
		}

		?>
	</dd>

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
			'--output /dev/null',
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

	<?php if ( ! empty( $host_keychain_id ) ) : ?>

		<dt>LFTP Download <code>.htaccess</code></dt>
		<dd>
			<code><?php

			$url      = get_post_meta( $ftp_keychain_id, '_orbis_keychain_url', true );
			$username = get_post_meta( $ftp_keychain_id, '_orbis_keychain_username', true );
			$password = get_post_meta( $ftp_keychain_id, '_orbis_keychain_password', true );

			$uri = Uri::createFromString( $url );
			$uri = $uri->withUserInfo( $username, $password );

			$command = implode( ' ', array(
				'lftp',
				'-c',
				escapeshellarg( implode( '; ', array(
					'set ssl:verify-certificate no',
					'set ftp:list-options -a',
					'open ' . $uri,
					/*
					 * -c          continue, reget.
					 * -d          create directories the same as file  names  and  get  the  files  into  them
                        instead of current directory.
                     */
					'get public_html/.htaccess',
				) ) ),
			) );

			echo esc_html( $command );

			?></code>
		</dd>

	<?php endif; ?>

</dl>

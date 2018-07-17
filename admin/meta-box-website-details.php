<?php

wp_nonce_field( 'orbis_save_website_details', 'orbis_website_details_meta_box_nonce' );

$url              = get_post_meta( $post->ID, '_orbis_website_url', true );
$ipv4_address     = get_post_meta( $post->ID, '_orbis_website_ipv4_address', true );
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

$ftp_keychain  = null;
$ssh_keychain  = null;
$wp_keychain   = null;
$monitor       = null;

if ( ! empty( $ftp_keychain_id ) ) {
	$ftp_keychain = get_post( $ftp_keychain_id );
}

if ( ! empty( $ssh_keychain_id ) ) {
	$ssh_keychain = get_post( $ssh_keychain_id );
}

if ( ! empty( $wp_keychain_id ) ) {
	$wp_keychain = get_post( $wp_keychain_id );
}

if ( ! empty( $monitor_id ) ) {
	$monitor = get_post( $monitor_id );
}

?>
<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_url"><?php esc_html_e( 'URL', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_url" name="_orbis_website_url" value="<?php echo esc_attr( $url ); ?>" type="url" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_ipv4_address"><?php esc_html_e( 'IPv4 address', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_ipv4_address" name="_orbis_website_ipv4_address" value="<?php echo esc_attr( $ipv4_address ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_host"><?php esc_html_e( 'Host', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_host" name="_orbis_website_host" value="<?php echo esc_attr( $host ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_ftp_keychain_id"><?php esc_html_e( 'FTP Keychain', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<select id="orbis_website_ftp_keychain_id" name="_orbis_website_ftp_keychain_id" data-post-suggest="orbis/keychains">
				<?php

				if ( $ftp_keychain ) {
					printf(
						'<option value="%s" selected="selected">%s</option>',
						esc_attr( $ftp_keychain->ID ),
						esc_html( get_the_title( $ftp_keychain ) )
					);
				}

				?>
			</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_ssh_keychain_id"><?php esc_html_e( 'SSH Keychain', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<select id="orbis_website_ssh_keychain_id" name="_orbis_website_ssh_keychain_id" data-post-suggest="orbis/keychains">
				<?php

				if ( $ssh_keychain ) {
					printf(
						'<option value="%s" selected="selected">%s</option>',
						esc_attr( $ssh_keychain->ID ),
						esc_html( get_the_title( $ssh_keychain ) )
					);
				}

				?>
			</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_root_path"><?php esc_html_e( 'Root Path', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_root_path" name="_orbis_website_root_path" value="<?php echo esc_attr( $root_path ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_public_path"><?php esc_html_e( 'Public Path', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_public_path" name="_orbis_website_public_path" value="<?php echo esc_attr( $public_path ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_has_wp_cli">
				<?php esc_html_e( 'WP-CLI', 'orbis_keychains' ); ?>
			</label>
		</th>
		<td>
			<label for="orbis_website_has_wp_cli">
				<input type="checkbox" value="yes" id="orbis_website_has_wp_cli" name="_orbis_website_has_wp_cli" <?php checked( $has_wp_cli ); ?> />
				<?php esc_html_e( 'WP-CLI is enabled.', 'orbis_keychains' ); ?>
			</label>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_git_url"><?php esc_html_e( 'Git URL', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_git_url" name="_orbis_website_git_url" value="<?php echo esc_attr( $git_url ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_infinitewp_id"><?php esc_html_e( 'InfiniteWP Site ID', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_infinitewp_id" name="_orbis_website_infinitewp_id" value="<?php echo esc_attr( $iwp_site_id ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_wp_keychain_id"><?php esc_html_e( 'WordPress Keychain', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<select id="orbis_website_wp_keychain_id" name="_orbis_website_wp_keychain_id" data-post-suggest="orbis/keychains">
				<?php

				if ( $wp_keychain ) {
					printf(
						'<option value="%s" selected="selected">%s</option>',
						esc_attr( $wp_keychain->ID ),
						esc_html( get_the_title( $wp_keychain ) )
					);
				}

				?>
			</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_monitor_id"><?php esc_html_e( 'Monitor', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<select id="orbis_website_monitor_id" name="_orbis_website_monitor_id" data-post-suggest="orbis/monitors">
				<?php

				if ( $monitor ) {
					printf(
						'<option value="%s" selected="selected">%s</option>',
						esc_attr( $monitor->ID ),
						esc_html( get_the_title( $monitor ) )
					);
				}

				?>
			</select>
		</td>
	</tr>
</table>

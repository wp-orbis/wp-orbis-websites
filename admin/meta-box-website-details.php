<?php

wp_nonce_field( 'orbis_save_website_details', 'orbis_website_details_meta_box_nonce' );

$url              = get_post_meta( $post->ID, '_orbis_website_url', true );
$host             = get_post_meta( $post->ID, '_orbis_website_host', true );
$host_keychain_id = get_post_meta( $post->ID, '_orbis_website_host_keychain_id', true );
$root_path        = get_post_meta( $post->ID, '_orbis_website_root_path', true );
$public_path      = get_post_meta( $post->ID, '_orbis_website_public_path', true );
$has_wp_cli       = get_post_meta( $post->ID, '_orbis_website_has_wp_cli', true );
$git_url          = get_post_meta( $post->ID, '_orbis_website_git_url', true );
$iwp_site_id      = get_post_meta( $post->ID, '_orbis_website_infinitewp_id', true );

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
			<label for="orbis_website_host"><?php esc_html_e( 'Host', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<input id="orbis_website_host" name="_orbis_website_host" value="<?php echo esc_attr( $host ); ?>" type="text" class="regular-text" />
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="orbis_website_host_keychain_id"><?php esc_html_e( 'Host Keychain ID', 'orbis-websites' ); ?></label>
		</th>
		<td>
			<select id="orbis_website_host_keychain_id" name="_orbis_website_host_keychain_id" data-post-suggest="orbis/keychains">

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
</table>

<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		+	var subscriptionURL = window.location.origin + "/wp-json/wp/v2/orbis/subscriptions/select2";
	
		$( '.orbis-subscription-rest' ).select2( {
			minimumInputLength: 2,
			allowClear: true,
			ajax: {
				url: subscriptionURL,
				dataType: 'json',
				data: function( params ) {
					return {
						search: params.term
					}
				},
				processResults: function( data ) {
					return { results: data };
				},
				width: '100%',
				selectOnClose: true,
				formatNoMatches: formatNoMatches,
				formatInputTooShort: formatInputTooShort,
				formatSelectionTooBig: formatSelectionTooBig,
				formatLoadMore: formatLoadMore,
				formatSearching: formatSearching
			},
		} );
	} );
</script>

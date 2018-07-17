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
		'open --user ' . $username . ' --password ' . $password . ' ' . $url,
		'cd .'
	) ) ),
) );

echo $command;

<?php

use League\Uri\Uri;

$post = get_post();

$host = get_post_meta( $post->ID, '_orbis_website_host', true );
$ip   = get_post_meta( $post->ID, '_orbis_website_ipv4_address', true );

printf(
	'[ `dig +short %1$s` != "%2$s" ] && echo "%1$s != %2$s"',
	$host,
	$ip
);

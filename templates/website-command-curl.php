<?php

use League\Uri\Uri;

$post = get_post();

$url = get_post_meta( $post->ID, '_orbis_website_url', true );

echo implode( ' ', array(
	'curl',
	'--silent', // https://curl.haxx.se/docs/manpage.html#-s
	'--location', // https://curl.haxx.se/docs/manpage.html#-L
	'--max-time 7', // https://curl.haxx.se/docs/manpage.html#-m
	'--write-out "%{http_code}\t%{url_effective}\\n"', // https://curl.haxx.se/docs/manpage.html#-w
	'--user-agent "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/601.5.17 (KHTML, like Gecko) Version/9.1 Safari/601.5.17"', // https://curl.haxx.se/docs/manpage.html#-A
	'--output /dev/null',
	$url
) );

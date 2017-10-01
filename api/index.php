<?php

define('__ROOT__', __DIR__ . '/..');

require_once __ROOT__ . '/vendor/autoload.php';

header( 'Content-type: image/png' );

$avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
$input  = new \Utils\Input;

if ( ! isset( $_GET['no-cache'] ) && file_exists( __ROOT__ . "/cache/{$input->cacheKey}.png" ) ) {
	echo readfile( __ROOT__ . "/cache/{$input->cacheKey}.png" );

	return;
}

$image = $avatar->name( $input->name )
                ->length( $input->length )
                ->fontSize( $input->fontSize )
                ->size( $input->size )
                ->background( $input->background )
                ->color( $input->color )
                ->smooth()
                ->rounded( $input->rounded )
                ->generate();

$image->save( __ROOT__ . "/cache/{$input->cacheKey}.png" );

echo $image->stream( 'png', 100 );
return;
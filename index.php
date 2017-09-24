<?php

require_once __DIR__ . '/vendor/autoload.php';

header( 'Content-type: image/png' );

$avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
$input  = new \Utils\Input;

$initials = ( new LasseRafn\Initials\Initials )->generate( $input->name );

if ( file_exists( __DIR__ . "/cache/{$input->cacheKey}.png" ) ) {
	echo readfile( __DIR__ . "/cache/{$input->cacheKey}.png" );

	return;
}

$image = $avatar->name( $input->name )
                ->length( $input->length )
                ->fontSize( $input->fontSize )
                ->size( $input->size )
                ->background( $input->background )
                ->color( $input->color )
                ->generate();

$image->save( __DIR__ . "/cache/{$input->cacheKey}.png" );

echo $image->stream( 'png', 100 );
return;

<?php

if ( !function_exists( 'base_uri' ) ) {
    function base_uri (): string
    {
        return ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'HTTP_HOST' ];
    }
}

if ( !function_exists( 'asset' ) ) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @return string
     */
    function asset ( string $path ): string
    {
        $file_path = '/public' . $path;

        $dir_path = __DIR__ . '/..' . $file_path;
        $file_uri = base_uri() . $file_path;

        if ( file_exists( $dir_path ) ) {
            return $file_uri;
        }

        return '';
    }
}

if ( !function_exists( 'json' ) ) {
    function json ( array $array, int $status ): bool|string
    {
        if ( $status === 400 ) {
            header( 'HTTP/1.1 400 Bad Request' );
        } else {
            header( "HTTP/1.1 200 OK" );
        }

        header( "Content-Type: application/json; charset=utf-8" );
        return json_encode( $array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
    }
}

if ( !function_exists( 'dd' ) ) {
    function dd ( $data )
    {
        echo '<pre>';
        var_dump( $data );
        echo '</pre>';

        exit;
    }
}

if ( !function_exists( 'config' ) ) {
    function config ( string $env_name )
    {
        $dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/..' );
        $dotenv->load();

        return $_ENV[ $env_name ];
    }
}

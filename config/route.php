<?php
// Route
$base     = '/';
$handlers = static function ( FastRoute\RouteCollector $r ) use ( $base ) {
    $r->addRoute( 'GET', $base, 'App\Controllers\AppController@index' );
    $r->addRoute( 'POST', $base . 'api/v1/store', 'App\Controllers\Api\AccessTokenController@store' );
};

$dispatcher = FastRoute\cachedDispatcher( $handlers, [
    'cacheFile'     => __DIR__ . '/route.cache',
    'cacheDisabled' => true
] );

$uri       = $_SERVER[ 'REQUEST_URI' ];
$method    = $_SERVER[ 'REQUEST_METHOD' ];
$routeInfo = $dispatcher->dispatch( $method, $uri );

switch ( $routeInfo[ 0 ] ) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );
        echo "ページが見つかりませんでした。\n";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[ 1 ];
        header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 405 Method not allowed' );
        echo "許可されない HTTP リクエストです。\n";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[ 1 ];
        $targets = explode( '@', $handler );
        $action  = new $targets[ 0 ]();
        $vars    = $routeInfo[ 2 ];
        echo call_user_func_array( [ $action, $targets[ 1 ] ], $vars );
        break;
}
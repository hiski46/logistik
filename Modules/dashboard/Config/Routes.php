<?php

$routes->group('dashboard', ['namespace' => 'Modules\dashboard\Controllers'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('(:any)', 'Dashboard::$1');
    // $routes->post('procurement', 'MaterialRequest::index', ['namespace' => 'Procurement\Controllers']);
    // $routes->post('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->add('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->delete('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->put('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->get('procurement_settings', 'Procurement_settings::index', ['namespace' => 'Procurement\Controllers']);
});
$routes->group('material', ['namespace' => 'Modules\dashboard\Controllers'], function ($routes) {
    $routes->get('/', 'Material::index');
    $routes->get('(:any)', 'Material::$1');
    $routes->post('(:any)', 'Material::$1');
    // $routes->post('procurement', 'MaterialRequest::index', ['namespace' => 'Procurement\Controllers']);
    // $routes->post('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->add('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->delete('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->put('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->get('procurement_settings', 'Procurement_settings::index', ['namespace' => 'Procurement\Controllers']);
});
$routes->group('request', ['namespace' => 'Modules\dashboard\Controllers'], function ($routes) {
    $routes->get('/', 'Request::index');
    $routes->get('(:any)', 'Request::$1');
    $routes->post('(:any)', 'Request::$1');
    // $routes->post('procurement', 'MaterialRequest::index', ['namespace' => 'Procurement\Controllers']);
    // $routes->post('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->add('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->delete('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->put('procurement/(:any)', 'MaterialRequest::$1', ['namespace' => 'Procurement\Controllers']);
    // $routes->get('procurement_settings', 'Procurement_settings::index', ['namespace' => 'Procurement\Controllers']);
});

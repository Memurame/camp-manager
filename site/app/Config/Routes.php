<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


if (file_exists(ROOTPATH . '/pending_install')){
    $migrate = \Config\Services::migrations();
    $migrate->latest();

    // Installation
    $routes->match(['get', 'post'],'(:any)', 'InstallController::index', ['as' => 'install']);
} else {
    /*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
    
    // Login and Logout
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');


    $routes->get('anmelden', 'PublicController::index/$1', ['as' => 'public.index']);
    $routes->get('anmelden/(:any)', 'PublicController::register/$1', ['as' => 'public.register']);
    $routes->post('anmelden/(:any)', 'PublicController::register/$1');



    // CLI
    $routes->cli('sendmail', 'Cron::mail');
    $routes->get('diemails_jetztsenden', 'Cron::mail');


    // Error seiten
    $routes->get('/error/no-access', 'Error::noaccess');

    //API
    $routes->delete('/api/person/delete/(:num)', 'Registrations::api_delete/$1',['filter' => 'permission:anmeldungen.delete']);

    $routes->delete('/api/user/delete/(:num)', 'Users::api_delete/$1',['filter' => 'permission:user.delete']);
    $routes->put('/api/user/reset/(:num)', 'Users::api_reset/$1',['filter' => 'permission:user.edit']);
    $routes->post('/api/user/add', 'Users::api_add',['filter' => 'permission:user.create']);

    $routes->delete('/api/usergroup/(:num)/delete', 'UserGroups::api_delete/$1',['filter' => 'permission:group.delete']);

    $routes->put('/api/material/(:num)/status', 'Material::api_set_status/$1',['filter' => 'permission:matlist.edit']);
    $routes->put('/api/material/(:num)/assign', 'Material::api_assign/$1',['filter' => 'permission:matlist.edit']);
    $routes->delete('/api/material/(:num)/delete', 'Material::api_delete_material/$1',['filter' => 'permission:matlist.delete']);

    $routes->delete('/api/room/(:num)/member/delete', 'Room::api_member_delete/$1',['filter' => 'permission:zimmer.assign']);
    $routes->delete('/api/room/(:num)/delete', 'Room::api_room_delete/$1',['filter' => 'permission:zimmer.delete']);
    $routes->post('/api/room/member/add', 'Room::api_member_add',['filter' => 'permission:zimmer.assign']);
    $routes->get('/api/room/(:num)/members', 'Room::api_member_list/$1',['filter' => 'permission:zimmer.show']);
    $routes->get('/api/room/personlist', 'Room::api_person_list',['filter' => 'permission:zimmer.show']);

    $routes->delete('/api/mail/delete/(:num)', 'Mail::api_delete/$1',['filter' => 'permission:admin.mail']);


    $routes->get('my/(:any)', 'PublicController::my/$1', ['as' => 'public.my']);
    $routes->get('my/(:any)/(:num)', 'PublicController::detail/$1/$2', ['as' => 'public.detail']);

    $routes->group('app', static function ($routes) {
        $routes->get('', 'Dashboard::index',['filter' => 'permission:page.dashboard', 'as' => 'dashboard']);

        // User Profile
        $routes->get('profile', 'Profile::index' ,['filter' => 'permission:page.profile', 'as' => 'profile']);
        $routes->post('profile/update', 'Profile::updateProfile' ,['filter' => 'permission:page.profile', 'as' => 'profile.update']);
        $routes->post('profile/password', 'Profile::updatePassword' ,['filter' => 'permission:page.profile', 'as' => 'profile.password']);
        // Materialliste
        $routes->get('materialliste', 'Material::index',['filter' => 'permission:matlist.show', 'as'=>'material']);
        $routes->match(['get', 'post'],'materialliste/edit/(:num)', 'Material::edit/$1',['filter' => 'permission:matlist.edit', 'as'=>'material.edit']);
        $routes->match(['get', 'post'],'materialliste/add', 'Material::add',['filter' => 'permission:matlist.create', 'as'=>'material.create']);
        // Zimmer
        $routes->get('zimmer', 'Room::index',['filter' => 'permission:zimmer.show', 'as'=>'zimmer']);
        $routes->get( 'zimmer/edit/(:num)', 'Room::edit/$1',['filter' => 'permission:zimmer.edit', 'as'=>'zimmer.edit']);
        $routes->post( 'zimmer/edit/(:num)', 'Room::edit/$1',['filter' => 'permission:zimmer.edit']);
        $routes->match(['get', 'post'], 'zimmer/add', 'Room::add',['filter' => 'permission:zimmer.create', 'as'=>'zimmer.create']);
        // Mail Versand
        $routes->get('mail', 'Mail::index',['filter' => 'permission:admin.mail', 'as'=>'mail']);
        $routes->post('mail', 'Mail::send',['filter' => 'permission:admin.mail']);
        $routes->get('mail/(:num)', 'Mail::index/$1',['filter' => 'permission:admin.mail', 'as'=>'mail.copy']);
        $routes->get('mail/gesendet', 'Mail::sent',['filter' => 'permission:admin.mail', 'as'=>'mail.sent']);
        $routes->get('mail/gesendet/(:num)', 'Mail::detail/$1',['filter' => 'permission:admin.mail', 'as'=>'mail.detail']);
        $routes->post('mail/save', 'Mail::save',['filter' => 'permission:admin.mail', 'as'=>'mail.save']);
        $routes->get('mail/gespeichert', 'Mail::saved',['filter' => 'permission:admin.mail', 'as'=>'mail.saved']);
        $routes->get('mail/gespeichert/(:num)', 'Mail::saved/$1',['filter' => 'permission:admin.mail', 'as'=>'mail.load']);
        $routes->post('mail/gespeichert/(:num)', 'Mail::save/$1',['filter' => 'permission:admin.mail']);
        // Teilnehmer Verwaltung
        $routes->get('anmeldungen', 'Registrations::index',['filter' => 'permission:anmeldungen.show', 'as'=>'anmeldungen']);
        $routes->get('anmeldungen/export', 'Registrations::export',['filter' => 'permission:anmeldungen.export', 'as'=>'anmeldungen.export']);
        $routes->get('anmeldungen/show/(:num)', 'Registrations::show/$1',['filter' => 'permission:anmeldungen.show', 'as'=>'anmeldungen.detail']);
        $routes->match(['get', 'post'],'anmeldungen/edit/(:num)', 'Registrations::edit/$1',['filter' => 'permission:anmeldungen.edit', 'as'=>'anmeldungen.edit']);
        $routes->match(['get', 'post'],'anmeldungen/add', 'Registrations::add',['filter' => 'permission:anmeldungen.create', 'as'=>'anmeldungen.create']);
        $routes->match(['get', 'post'],'anmeldungen/stack', 'Registrations::stack_edit',['filter' => 'permission:anmeldungen.stack', 'as'=>'anmeldungen.stack']);
    });

    $routes->group('admin', static function ($routes) {

        // LOG
        $routes->get('log', 'Log::index',['filter' => 'permission:admin.log', 'as'=>'log']);

        // FORMULARE
        $routes->get('formular', 'Forms::index',['filter' => 'permission:form.show', 'as'=>'form']);

        // EInstellungen
        $routes->get('einstellungen', 'Settings::index',['filter' => 'permission:admin.settings', 'as'=>'settings']);
        $routes->post('einstellungen', 'Settings::saveSettings',['filter' => 'permission:admin.settings']);
        $routes->post('einstellungen/delete', 'Settings::deleteData',['filter' => 'permission:admin.settings', 'as'=>'settings.delete']);

        // Benutzergruppen
        $routes->get('benutzergruppe', 'UserGroups::index',['filter' => 'permission:group.show', 'as'=>'group']);
        $routes->match(['get','post'],'benutzergruppe/add', 'UserGroups::add',['filter' => 'permission:group.create', 'as'=>'group.create']);
        $routes->match(['get','post'],'benutzergruppe/edit/(:num)', 'UserGroups::edit/$1',['filter' => 'permission:group.edit', 'as'=>'group.edit']);

        // Benutzerverwaltung
        $routes->get('benutzer', 'Users::index',['filter' => 'permission:user.show', 'as'=>'user']);
        $routes->match(['get', 'post'],'benutzer/edit/(:num)', 'Users::edit/$1',['filter' => 'permission:user.edit', 'as'=>'user.edit']);
        $routes->match(['get', 'post'],'benutzer/add', 'Users::add',['filter' => 'permission:user.create', 'as'=>'user.create']);
    });


    $routes->addRedirect('/', 'dashboard');
    $routes->addRedirect('/admin', 'dashboard');

}

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
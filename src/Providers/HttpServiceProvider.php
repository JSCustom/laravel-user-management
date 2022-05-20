<?php

namespace JSCustom\LaravelUserManagement\Providers;

use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    CONST BAD_REQUEST = 400; /* IF CLIENT DID NOT SEND SOME REQUIRED PARAMETERS TO THE API */
    CONST NOT_AUTHORIZED = 401; /* IF CLIENT DID NOT SEND API KEY */
    CONST FORBIDDEN_ACCESS = 403; /* IF CLIENT IS TRYING TO ACCESS AN API THAT HAS DIFFERENT PERMISSIONS */
    CONST NOT_FOUND = 404; /* IF CLIENT IS TRYING TO ACCESS AN API THAT DOES NOT EXIST */

    CONST BAD_REQUEST_MESSAGE = 'You are missing some parameters.';
    CONST NOT_AUTHORIZED_MESSAGE = 'You are not logged in.';
    CONST FORBIDDEN_ACCESS_MESSAGE = 'You are not allowed to access this module.';
    CONST NOT_FOUND_MESSAGE = 'The API you are trying to access does not exist.';

    CONST OK = 200;
    CONST CREATED = 201;
    /* CONST NO_CONTENT = 204; */

    CONST GENERAL_SERVER_ERROR = 500; /* IF API FAILED TO RUN (CREATE, READ, UPDATE, DELETE) */
    /* CONST NOT_IMPLEMENTED = 501;
    CONST BAD_GATEWAY = 502;
    CONST SERVICE_UNAVAILABLE = 503;
    CONST GATEWAY_TIMEOUT = 504; */
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

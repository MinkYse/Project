<?php

use App\Services\Router;

Router::page('/', 'catalog');
Router::page('/login', 'login');
Router::page('/logout', 'logout');

Router::enable();

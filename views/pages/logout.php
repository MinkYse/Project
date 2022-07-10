<?php

unset($_SESSION['user']);
\App\Services\Router::redirect('/');

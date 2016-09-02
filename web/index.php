<?php

/*
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * @author leandro713 <leandro@leandro.org>
 * @copyright Copyright (c) 2016, Leandro Vazquez Cervantes
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @package leash
*/

 date_default_timezone_set('Europe/Madrid');

 require_once __DIR__.'/../vendor/autoload.php';

 $app = require __DIR__.'/../app/app.php';

 if (1 == $app['config']['debug']) {
     $app['debug'] = true;
    //$app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());
 }

 $app->run();

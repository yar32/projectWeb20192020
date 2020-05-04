<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');
//Users
Router::get('user/login',	'UserController/login');
Router::get('user/register',	'UserController/register');
Router::get('user/profile',	'UserController/profile');
Router::get('backoffice/allusers',	'UserController/backusers');
Router::get('backoffice/roles',	'UserController/roles');

//Game
Router::get('game/index',	'GameController/index');
Router::get('game/game',	'GameController/game');












/************** End of URLEncoder Routing Rules ************************************/
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
Router::get('home/top',	'HomeController/top');
//Users
Router::get('user/login',	'UserController/login');
Router::get('user/logout',	'UserController/logout');
Router::get('user/register',	'UserController/create');
Router::get('user/profile',	'UserController/show');
Router::get('backoffice/allusers',	'UserController/backusers');
Router::get('backoffice/roles',	'UserController/roles');
Router::post("user/register","UserController/store");
Router::post("user/login","UserController/makelogin");
Router::post("user/edit","UserController/update");
Router::get("user/ban","UserController/destroy");

//Game
Router::get('game/index',	'GameController/index');
Router::get('game/game',	'GameController/game');

//ajax
Router::post('ajax/infouser',"AjaxController/infouser");
Router::post('ajax/banuser',"AjaxController/banneduser");










/************** End of URLEncoder Routing Rules ************************************/
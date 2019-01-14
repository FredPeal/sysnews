<?php 
use App\Core\Router;

Router::get('user','UserController@index');
Router::post('user','UserController@store');
Router::get('user/find','UserController@show');
Router::post('user/update','UserController@update');
Router::post('user/delete','UserController@del');

Router::post('auth','Auth@auth');
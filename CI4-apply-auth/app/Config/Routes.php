<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

// Dashboard routes
$routes->get('/dashboard', 'Dashboard::index');

// Course routes
$routes->get('/course', 'Course::index');
$routes->get('/course/create', 'Course::create');
$routes->post('/course/create', 'Course::create');
$routes->get('/course/edit/(:num)', 'Course::edit/$1');
$routes->post('/course/edit/(:num)', 'Course::edit/$1');
$routes->get('/course/delete/(:num)', 'Course::delete/$1');

// Enrollment routes
$routes->get('/course/enroll/(:num)', 'Course::enroll/$1');
$routes->get('/course/unenroll/(:num)', 'Course::unenroll/$1');

// Student management routes
$routes->get('/student', 'Student::index');
$routes->get('/student/create', 'Student::create');
$routes->post('/student/create', 'Student::create');
$routes->get('/student/edit/(:num)', 'Student::edit/$1');
$routes->post('/student/edit/(:num)', 'Student::edit/$1');
$routes->get('/student/delete/(:num)', 'Student::delete/$1');
$routes->get('/student/view/(:num)', 'Student::view/$1');
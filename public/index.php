<?php

require_once __DIR__ . '/../vendor/autoload.php';

use laundry\Controller\CustomerController;
use laundry\Controller\TransaksiController;
use laundry\App\Router;
use laundry\Config\Database;
use laundry\Controller\HomeController;
use laundry\Controller\UserController;
use laundry\Middleware\MustNotLoginMiddleware;
use laundry\Middleware\MustLoginMiddleware;

Database::getConnection('test');

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// User Controller
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/users/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/users/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/users/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

//Customer Controller
Router::add('GET', '/admin/tambah', CustomerController::class, 'save', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/tambah', CustomerController::class, 'postSave', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/dashboard', CustomerController::class, 'tampil', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/hapus', CustomerController::class, 'hapus', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/edit', CustomerController::class, 'edit', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/edit', CustomerController::class, 'postEdit', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/hapus', CustomerController::class, 'hapus', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/transaksi', TransaksiController::class, 'transaksi', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/transaksi', TransaksiController::class, 'postTransaksi', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/pembayaran', TransaksiController::class, 'pembayaran', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/cetaklaporan', TransaksiController::class, 'cetaklaporan', []);
Router::add('GET', '/admin/laporan', TransaksiController::class, 'laporan', [MustLoginMiddleware::class]);

Router::run();
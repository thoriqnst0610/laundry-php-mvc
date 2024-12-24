<?php

namespace laundry\Controller;

use laundry\App\View;
use laundry\Config\Database;
use laundry\Repository\SessionRepository;
use laundry\Repository\UserRepository;
use laundry\Service\SessionService;
use laundry\Service\CustomerService;
use laundry\Repository\CustomerRepository;

class HomeController
{

    private SessionService $sessionService;
    private CustomerService $customerService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $connection = Database::getConnection();
        $repository = new CustomerRepository($connection);
        $customerService = new CustomerService($repository);
        $this->customerService = $customerService;
    }


    function index()
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::render('User/login', [
                "title" => "PHP Login Management"
            ]);
        } else {

            $response = $this->customerService->tampil();
            $data = $response->customer;
            $data = $data->semua;
            View::render('admin/dashboard', [
                "title" => "Dashboard",
                "user" => [
                    "name" => $user->name
                ],
                "message" => $data
            ]);
        }
    }

}
<?php

namespace laundry\Controller;

use laundry\App\View;
use laundry\Repository\CustomerRepository;
use laundry\Service\CustomerService;
use laundry\Model\Customer\CustomerSaveRequest;
use laundry\Model\Customer\CustomerSaveResponse;
use laundry\Config\Database;
use Laundry\Domain\Customer;
use laundry\Exception\ValidationException;
use laundry\Model\Customer\CustomerEditRequest;

class CustomerController{

    private CustomerService $customerService;

    public function __construct()
    {

        $connection = Database::getConnection();
        $repository = new CustomerRepository($connection);
        $customerService = new CustomerService($repository);
        $this->customerService = $customerService;

    }

    public function save()
    {

        View::render('Admin/tambah',[
            "nama" => "Thoriq"
        ]);

    }

    public function postSave()
    {

        $request = new CustomerSaveRequest();
        $request->name = $_POST['name'];
        $request->phone = $_POST['phone'];
        $request->address = $_POST['address'];

        try{

            $response = $this->customerService->save($request);
            View::redirect('/admin/dashboard'
        );
        }catch(ValidationException $ex){

            View::render('/admin/tambah',
        [
            'message' => $ex->getMessage()
        ]
        );

        }
        
    }

    public function tampil()
    {
        try{


            $response = $this->customerService->tampil();
            $data = $response->customer;
            $data = $data->semua;
            View::render('/admin/dashboard',[
                'message' => $data
            ]);

        }catch(ValidationException $ex){

            View::render('/admin/dashboard',[
                'message' => 'Kosong'
            ]);

        }
    }

    public function edit()
    {
        $request = $this->customerService->ambil($_GET['idc']);
        $request = $request->customer;
        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;

        try{

            View::render('admin/edit',[
                'id' => $id,
                'name' => $name,
                'phone' => $phone,
                'address' => $address
            ]);

        }catch(ValidationException $ex){

        }
        

    }

    public function postEdit()
    {

        $request = new CustomerEditRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->phone = $_POST['phone'];
        $request->address = $_POST['address'];

        try{

            $response = $this->customerService->edit($request);
            View::redirect('/admin/dashboard');

        }catch(ValidationException $ex){

            View::render('/admin/edit',[
                "message" => $ex->getMessage()
            ]);
        }

        
    }

    public function hapus()
    {

        $this->customerService->hapus($_GET['idc']);
        View::redirect('/admin/dashboard');
    }

    
}
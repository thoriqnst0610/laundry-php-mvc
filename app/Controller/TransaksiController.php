<?php

namespace laundry\Controller;

use laundry\App\View;
use laundry\Repository\OrderRepository;
use laundry\Repository\OrderDetailsRepository;
use laundry\Service\OrderService;
use laundry\Service\OrderDetailsService;
use laundry\Model\Order\OrderSaveRequest;
use laundry\Model\Order\OrderSaveResponse;
use laundry\Model\OrderDetails\OrderDetailsSaveRequest;
use laundry\Model\OrderDetails\OrdeDetailsResponse;
use laundry\Repository\CustomerRepository;
use laundry\Service\CustomerService;
use laundry\Model\Customer\CustomerSaveRequest;
use laundry\Model\Customer\CustomerSaveResponse;
use laundry\Config\Database;
use Laundry\Domain\Order;
use laundry\Exception\ValidationException;


class TransaksiController{

    private OrderService $orderService;
    private OrderDetailsService $orderDetailsService;
    private CustomerService $customerService;

    public function __construct()
    {

        $connection = Database::getConnection();
        $repository = new OrderRepository($connection);
        $details = new OrderDetailsRepository($connection);
        $orderService = new OrderService($repository, $details);
        $this->orderService = $orderService;

        $repository = new OrderDetailsRepository($connection);
        $orderDetailsService = new OrderDetailsService($repository);
        $this->orderDetailsService = $orderDetailsService;

        $repository = new CustomerRepository($connection);
        $customerService = new CustomerService($repository);
        $this->customerService = $customerService;

    }

    public function transaksi()
    {

        $request = $this->customerService->ambil($_GET['idc']);
        $customer = $request->customer;
        $id = $customer->id;
        $nama = $customer->name;
        View::render('/admin/transaksi',[
            'id' => $id,
            'name' => $nama
        ]);

    }

    public function postTransaksi()
    {

        $request = $this->orderService->transaksi($_POST['item_name'],$_POST['quantity'],$_POST['order_date'],$_POST['customer']);
        View::redirect('/admin/dashboard');
        
    }

    public function pembayaran()
    {

        $response = $this->orderService->semua();
        $data = $response->semua;

        View::render('/admin/pembayaran',[
            'data' => $data
        ]);

    }

    public function cetaklaporan()
    {
        $response = $this->orderService->semua();
        $data = $response->semua;
        View::render('/admin/cetaklaporan',['data' => $data]);
    }

    public function laporan()
    {
        $idc = $_GET['idc'];
        $ido = $_GET['ido'];
        $idd = $_GET['idd'];

        $response = $this->orderService->semuas($idc,$ido,$idd);
        $data = $response->semua;
        View::render('/admin/laporan',['data' => $data]);

    }

}
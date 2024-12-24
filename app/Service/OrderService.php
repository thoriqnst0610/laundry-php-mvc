<?php

namespace laundry\Service;

use DateTime;
use Exception;
use laundry\Domain\Order;
use laundry\Domain\OrderDetails;
use laundry\Config\Database;
use laundry\Exception\ValidationException;
use laundry\Model\Order\OrderSaveRequest;
use laundry\Model\Order\OrderSaveResponse;
use laundry\Model\OrderDetails\OrderDetailsSaveRequest;
use laundry\Model\OrderDetails\OrderDetailsResponse;
use laundry\Repository\OrderDetailsRepository;
use laundry\Repository\OrderRepository;

class OrderService{
    

    private OrderRepository $orderRepository;
    private OrderDetailsRepository $orderDetailsRepository;

    public function __construct(OrderRepository $orderRepository, OrderDetailsRepository $orderDetailsRepository)
    {

        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->orderRepository = $orderRepository;

    }

    public function cekIdOrder(string $id): ?array
    {

        $ambil_data = $this->orderRepository->findById($id);
        return $ambil_data;
        
    }

    public function saveOrder(int $id_customer, string $order_date, int $total_amount)
    {

        $order = new Order();
        $order->customer_id = $id_customer;
        $order->order_date = $order_date;
        $order->total_amount = $total_amount;



            $response = $this->orderRepository->save($order);
            return $response;


    }

    public function saveOrderDetails(int $order_id, string $item_name, int $quantity, string $order_date)
    {

        $price = $this->hitungHargaOrderDetails($order_date, $item_name,$quantity);

        $order = new OrderDetails();
        $order->order_id = $order_id;
        $order->item_name = $item_name;
        $order->quantity = $quantity;
        $order->price = $price;



        $save = $this->orderDetailsRepository->save($order);

    }

    public function hitungHargaOrderDetails(string $ambil, string $jenis_kain, int $quantity)
    {

        //harga jenis pakaian
        

        if($jenis_kain == "Sarung"){

            $kain = 4000;
        }else if($jenis_kain == "Kasur"){
            $kain = 5000;
        }else if($jenis_kain == "Kain"){
            $kain = 3000;
        }

        //harga berdasarkan hari
        $hari = 8000;
        $hari_2 = 6000;
        $hari_3 = 4000;
        $hari_4 = 2000;
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = new DateTime();
        $status = "pending";

        //data sementara
        
        $ambil = DateTime::createFromFormat('Y-m-d', $ambil)->setTime(0, 0, 0);
        
        $harga_bayar = 0;
        $hari_ini->setTime(0, 0, 0);


        //cek pengambilan berapa hari
        $cek_hari = $ambil->diff($hari_ini);
        $selisih_hari =$cek_hari->days;


        if($selisih_hari == 1)
        {

            $harga_bayar = ($kain * $quantity) + $hari;

        }else if($selisih_hari == 2)
        {

            $harga_bayar = ($kain * $quantity) + $hari_2;

        }else if($selisih_hari == 3)
        {

            $harga_bayar = ($kain * $quantity) + $hari_3;
    
        }else{

            $harga_bayar = ($kain * $quantity) + $hari_4;
        }

        return $harga_bayar;

    }

    public function transaksi( string $item_name, int $quantity,  string $order_date, int $id_customer)
    {

        $harga = $this->hitungHargaOrderDetails($order_date, $item_name, $quantity);
        $simpan_order = $this->saveOrder($id_customer, $order_date, $harga);
        $simpan_detail = $this->saveOrderDetails($simpan_order, $item_name, $quantity, $order_date);

    }

    public function semua()
    {

        return $this->orderRepository->FindAll();
    }

    public function semuas($idc,$ido,$idd)
    {

        return $this->orderRepository->semua($idc,$ido,$idd);
    }
}
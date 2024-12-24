<?php

namespace laundry\Model\Order;

class OrderSaveRequest{

    public array $semua = [];
    public ?int $id = null;
    public ?int $customer_id = null;
    public ?string $order_date = null;
    public ?int $total_amount = null;
}
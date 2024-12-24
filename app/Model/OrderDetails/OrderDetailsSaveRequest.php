<?php

namespace laundry\Model\OrderDetails;

class OrderDetailsSaveRequest{

    public ?int $id = null;
    public ?int $order_id = null;
    public ?string $item_name = null;
    public ?int $quantity = null;
    public ?int $price = null;

}
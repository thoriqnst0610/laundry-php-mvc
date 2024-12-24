<?php

namespace laundry\Model\Customer;

class CustomerSaveRequest{

    public array $semua = [];
    public ?string $id = null;
    public ?string $name = null;
    public ?string $phone = null;
    public ?string $address = null;
}
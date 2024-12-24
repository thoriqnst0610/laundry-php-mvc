<?php

namespace laundry\Repository;

use laundry\Domain\Customer;
use PDO;

class CustomerRepository{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Customer $customer): Customer
    {
        
        $statement = $this->connection->prepare("insert into customers(name,phone,address) values(?,?,?)");
        $statement->execute([$customer->name, $customer->phone, $customer->address]);
        return $customer;
    }

    public function FindAll() : array|Customer
    {
        $statement = $this->connection->prepare("select * from customers");
        $statement->execute([]);

        try{

            if($row = $statement->fetchAll(PDO::FETCH_ASSOC)){

                $response = new Customer();
                $response->semua = $row;

                return $response;

            }else{

                $row = $statement->fetchAll(PDO::FETCH_ASSOC);
                $response = new Customer();
                $response->semua = $row;

                return $response;

            }
            

        }finally{

            $statement->closeCursor();

        }
        
    }

    public function update(Customer $customer) : Customer
    {
        $statement = $this->connection->prepare("UPDATE customers SET name = ?, phone = ?, address = ? WHERE idc = ?");
        $statement->execute([$customer->name, $customer->phone, $customer->address, $customer->id]);
    
        return $customer;
    }
    

    public function findById(string $id): ?Customer
    {
        $statement = $this->connection->prepare("SELECT * FROM customers WHERE idc = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new Customer();
                $user->id = $row['idc'];
                $user->name = $row['name'];
                $user->phone = $row['phone'];
                $user->address = $row['address'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM customers WHERE idc = ?");
        $statement->execute([$id]);
    }

}
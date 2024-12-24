<?php

namespace laundry\Repository;

use laundry\Domain\Order;
use PDO;

class OrderRepository{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Order $customer): int
    {
        
        $statement = $this->connection->prepare("insert into orders(customer_id,order_date,total_amount) values(?,?,?)");
        $statement->execute([$customer->customer_id, $customer->order_date, $customer->total_amount]);
        //return $customer->id;
        $lastInsertId = $this->connection->lastInsertId();
    
    return $lastInsertId;
    
    }

    public function update(Order $user): Order
    {
        $statement = $this->connection->prepare("UPDATE orders SET total_amount = ? WHERE id = ?");
        $statement->execute([
            $user->total_amount, $user->id
        ]);
        return $user;
    }

    public function findById(string $id): ?array
    {
    $statement = $this->connection->prepare("SELECT * FROM order WHERE ido = ?");
    $statement->execute([$id]);

    try {
        $row = $statement->fetch(PDO::FETCH_ASSOC); // Menggunakan FETCH_ASSOC untuk array asosiatif
        
        if ($row) {
            return $row; // Mengembalikan array asosiatif
        } else {
            return null; // Mengembalikan null jika tidak ada data yang ditemukan
        }
    } finally {
        $statement->closeCursor();
    }
    }

    public function FindAll() : array|Order
    {
        $statement = $this->connection->prepare("SELECT *
    FROM customers
    JOIN orders ON customers.idc = orders.customer_id
    JOIN order_details ON orders.ido = order_details.order_id;

");

        $statement->execute([]);

        try{

            if($row = $statement->fetchAll(PDO::FETCH_ASSOC)){

                $response = new Order();
                $response->semua = $row;

                return $response;

            }
            else{

                $row = $statement->fetchAll(PDO::FETCH_ASSOC);

                $response = new Order();
                $response->semua = $row;

                return $response;

            }

        }finally{

            $statement->closeCursor();

        }
        
    }

    public function semua($idc,$ido,$idd) : array|Order
    {
        $statement = $this->connection->prepare("SELECT *
        FROM customers
        JOIN orders ON customers.idc = orders.customer_id
        JOIN order_details ON orders.ido = order_details.order_id
        WHERE customers.idc = :idc AND orders.ido = :ido AND order_details.idd = :idd");
    
    // Gantikan nilai :idc, :ido, dan :idd dengan nilai yang sesuai
    
    
    $statement->bindParam(':idc', $idc);
    $statement->bindParam(':ido', $ido);
    $statement->bindParam(':idd', $idd);
    
    $statement->execute();

        try{

            if($row = $statement->fetchAll(PDO::FETCH_ASSOC)){

                $response = new Order();
                $response->semua = $row;

                return $response;

            }else{

                $row = $statement->fetchAll(PDO::FETCH_ASSOC);

                $response = new Order();
                $response->semua = $row;

                return $response;

            }

        }finally{

            $statement->closeCursor();

        }
        
    }


}
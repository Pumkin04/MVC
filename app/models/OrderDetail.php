<?php
class OrderDetail extends Model
{
    private $table = "order_details";

    public function add($data)
    {
        $sql = "INSERT INTO $this->table (order_id, product_id, product_name, product_price, quantity) 
                VALUES (:order_id, :product_id, :product_name, :product_price, :quantity)";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'product_price' => $data['product_price'],
            'quantity' => $data['quantity']
        ]);
    }

    public function getByOrderId($order_id)
    {
        $sql = "SELECT * FROM $this->table WHERE order_id = :order_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php
class Order extends Model
{
    private $table = "orders";

    public function create($data)
    {
        $sql = "INSERT INTO $this->table (user_id, customer_name, customer_email, customer_phone, customer_address, total_amount, status) 
                VALUES (:user_id, :customer_name, :customer_email, :customer_phone, :customer_address, :total_amount, 'pending')";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'user_id' => $data['user_id'] ?? null,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'customer_address' => $data['customer_address'],
            'total_amount' => $data['total_amount']
        ]);
        
        return $conn->lastInsertId();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUserId($user_id)
    {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $sql = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE $this->table SET status = :status WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_amount) as total FROM $this->table WHERE status = 'completed'";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getOrderCountByStatus($status = null)
    {
        if ($status) {
            $sql = "SELECT COUNT(*) as count FROM $this->table WHERE status = :status";
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute(['status' => $status]);
        } else {
            $sql = "SELECT COUNT(*) as count FROM $this->table";
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }

    public function getLatestOrders($limit = 5)
    {
        $sql = "SELECT * FROM $this->table ORDER BY created_at DESC LIMIT :limit";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyRevenue($year = null)
    {
        if (!$year) $year = date('Y');
        $sql = "SELECT MONTH(created_at) as month, SUM(total_amount) as amount 
                FROM $this->table 
                WHERE status = 'completed' AND YEAR(created_at) = :year 
                GROUP BY MONTH(created_at)
                ORDER BY month ASC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

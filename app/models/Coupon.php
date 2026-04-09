<?php
class Coupon extends Model
{
    private $table = "coupon";

    public function all()
    {
        $sql = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data = [])
    {
        $sql = "INSERT INTO $this->table (code, discount_type, discount_value, start_date, end_date, usage_limit) 
                VALUES (:code, :discount_type, :discount_value, :start_date, :end_date, :usage_limit)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'code'           => $data['code'],
            'discount_type'  => $data['discount_type'],
            'discount_value' => $data['discount_value'],
            'start_date'     => $data['start_date'],
            'end_date'       => $data['end_date'],
            'usage_limit'    => $data['usage_limit'] ?? 1,
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}

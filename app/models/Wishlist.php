<?php
class Wishlist extends Model
{
    private $table = "wishlist";

    public function all($user_id)
    {
        $sql = "SELECT w.*, p.name, p.price, p.image 
                FROM $this->table w
                JOIN product p ON w.product_id = p.id
                WHERE w.user_id = :user_id
                ORDER BY w.id DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($user_id, $product_id)
    {
        // Check if already exists
        if ($this->exists($user_id, $product_id)) {
            return false;
        }

        $sql = "INSERT INTO $this->table (user_id, product_id) VALUES (:user_id, :product_id)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
    }

    public function remove($user_id, $product_id)
    {
        $sql = "DELETE FROM $this->table WHERE user_id = :user_id AND product_id = :product_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
    }

    public function exists($user_id, $product_id)
    {
        $sql = "SELECT id FROM $this->table WHERE user_id = :user_id AND product_id = :product_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
        return $stmt->fetch() ? true : false;
    }

    public function count($user_id)
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table WHERE user_id = :user_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getWishlistIds($user_id)
    {
        $sql = "SELECT product_id FROM $this->table WHERE user_id = :user_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

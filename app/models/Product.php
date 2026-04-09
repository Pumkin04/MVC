<?php
class Product extends Model
{
    private $table = "product";
    public function all()
    {
        $sql = "SELECT p.*, b.name as brand_name, d.name as category_name, s.name as size_name, c.name as color_name 
                FROM $this->table p
                LEFT JOIN brand b ON p.brand_id = b.id
                LEFT JOIN danhmuc d ON p.category_id = d.id
                LEFT JOIN size s ON p.size_id = s.id
                LEFT JOIN color c ON p.color_id = c.id
                ORDER BY p.id DESC";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filter($category_id = null, $min_price = null, $max_price = null, $search = null)
    {
        $sql = "SELECT p.*, b.name as brand_name, d.name as category_name, s.name as size_name, c.name as color_name 
                FROM $this->table p
                LEFT JOIN brand b ON p.brand_id = b.id
                LEFT JOIN danhmuc d ON p.category_id = d.id
                LEFT JOIN size s ON p.size_id = s.id
                LEFT JOIN color c ON p.color_id = c.id
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($category_id)) {
            $sql .= " AND p.category_id = :category_id";
            $params['category_id'] = $category_id;
        }
        
        if ($min_price !== null && $min_price !== '') {
            $sql .= " AND p.price >= :min_price";
            $params['min_price'] = $min_price;
        }
        
        if ($max_price !== null && $max_price !== '') {
            $sql .= " AND p.price <= :max_price";
            $params['max_price'] = $max_price;
        }

        if (!empty($search)) {
            $sql .= " AND p.name LIKE :search";
            $params['search'] = "%$search%";
        }
        
        $sql .= " ORDER BY p.id DESC";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findWithDetails($id)
    {
        $sql = "SELECT p.*, b.name as brand_name, d.name as category_name, s.name as size_name, c.name as color_name 
                FROM $this->table p
                LEFT JOIN brand b ON p.brand_id = b.id
                LEFT JOIN danhmuc d ON p.category_id = d.id
                LEFT JOIN size s ON p.size_id = s.id
                LEFT JOIN color c ON p.color_id = c.id
                WHERE p.id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data = [])
    {
        $sql = "INSERT INTO $this->table (name, price, quantity, image, description, brand_id, category_id, size_id, color_id) 
                VALUES (:name, :price, :quantity, :image, :description, :brand_id, :category_id, :size_id, :color_id)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'image' => $data['image'],
            'description' => $data['description'],
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'size_id' => $data['size_id'],
            'color_id' => $data['color_id']
        ]);
    }

    public function update($data = [], $id) {
        $sql = "UPDATE $this->table SET 
                name = :name, 
                price = :price, 
                quantity = :quantity, 
                image = :image, 
                description = :description, 
                brand_id = :brand_id, 
                category_id = :category_id, 
                size_id = :size_id, 
                color_id = :color_id 
                WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'image' => $data['image'],
            'description' => $data['description'],
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'size_id' => $data['size_id'],
            'color_id' => $data['color_id'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]); 
    }

    public function getRelated($id, $category_id, $limit = 4)
    {
        $sql = "SELECT p.*, b.name as brand_name, d.name as category_name 
                FROM $this->table p
                LEFT JOIN brand b ON p.brand_id = b.id
                LEFT JOIN danhmuc d ON p.category_id = d.id
                WHERE p.category_id = :category_id AND p.id != :id
                ORDER BY RAND()
                LIMIT :limit";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reduceStock($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = quantity - :quantity WHERE id = :id AND quantity >= :quantity";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'quantity' => $quantity
        ]);
    }

    public function increaseStock($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = quantity + :quantity WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'quantity' => $quantity
        ]);
    }
}

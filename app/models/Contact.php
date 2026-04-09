<?php

class Contact extends Model
{
    private $table = "contacts";

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
        $sql = "INSERT INTO $this->table (full_name, email, phone, subject, message) 
                VALUES (:full_name, :email, :phone, :subject, :message)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'subject' => $data['subject'],
            'message' => $data['message']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function count($q = '')
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $params = [];
        if ($q) {
            $sql .= " WHERE full_name LIKE :q OR email LIKE :q OR subject LIKE :q";
            $params['q'] = "%$q%";
        }
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function search($q = '', $offset = 0, $limit = 10)
    {
        $sql = "SELECT * FROM $this->table";
        $params = [];
        if ($q) {
            $sql .= " WHERE full_name LIKE :q OR email LIKE :q OR subject LIKE :q";
            $params['q'] = "%$q%";
        }
        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        foreach ($params as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

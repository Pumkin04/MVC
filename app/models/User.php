<?php
class User extends Model
{
    private $table = "user";

    public function all()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
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

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data = [])
    {
        $sql = "INSERT INTO $this->table (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role']
        ]);
    }

    public function update($data = [], $id)
    {
        // Check if password is provided
        if (!empty($data['password'])) {
            $sql = "UPDATE $this->table SET username = :username, email = :email, password = :password, role = :role WHERE id = :id";
            $params = [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => $data['role'],
                'id' => $id
            ];
        } else {
            $sql = "UPDATE $this->table SET username = :username, email = :email, role = :role WHERE id = :id";
            $params = [
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'],
                'id' => $id
            ];
        }
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}

<?php

require_once __DIR__ . '/../config/database.php';

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $primaryKey;
    protected $fillable = [];

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    protected function filterData($data)
    {
        return array_intersect_key($data, array_flip($this->fillable));
    }

    public function getAll($limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM `{$this->table}` ORDER BY `{$this->primaryKey}` DESC";
        if ($limit !== null) {
            $sql .= " LIMIT " . max(1, (int) $limit) . " OFFSET " . max(0, (int) $offset);
        }
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM `{$this->table}` WHERE `{$this->primaryKey}` = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    public function create($data)
    {
        $data = $this->filterData($data);
        if (!$data) {
            throw new InvalidArgumentException("Tidak ada data valid untuk tabel {$this->table}.");
        }

        $columns = array_keys($data);
        $quoted = array_map(function ($column) {
            return "`{$column}`";
        }, $columns);
        $placeholders = implode(", ", array_fill(0, count($columns), "?"));
        $sql = "INSERT INTO `{$this->table}` (" . implode(", ", $quoted) . ") VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));

        return (int) $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $data = $this->filterData($data);
        if (!$data) {
            return false;
        }

        $sets = [];
        foreach (array_keys($data) as $column) {
            $sets[] = "`{$column}` = ?";
        }

        $sql = "UPDATE `{$this->table}` SET " . implode(", ", $sets)
            . " WHERE `{$this->primaryKey}` = ?";
        $stmt = $this->db->prepare($sql);
        $values = array_values($data);
        $values[] = $id;

        return $stmt->execute($values);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM `{$this->table}` WHERE `{$this->primaryKey}` = ?"
        );
        return $stmt->execute([$id]);
    }

    public function countAll()
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM `{$this->table}`")->fetchColumn();
    }
}

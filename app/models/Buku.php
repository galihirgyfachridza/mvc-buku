<?php
class Buku
{
    public function __construct(private PDO $db) {}

    public function getAll(): array
    {
        $stmt = $this->db->query(
            'SELECT id, judul, penulis, penerbit, tahun_terbit FROM buku ORDER BY judul ASC'
        );
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT id, judul, penulis, penerbit, tahun_terbit FROM buku WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insert(array $data): bool
    {
        $sql = 'INSERT INTO buku (judul, penulis, penerbit, tahun_terbit)
                VALUES (:judul, :penulis, :penerbit, :tahun_terbit)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':judul'        => $data['judul'],
            ':penulis'      => $data['penulis'],
            ':penerbit'     => $data['penerbit'],
            ':tahun_terbit' => $data['tahun_terbit']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE buku
                SET judul = :judul, penulis = :penulis, penerbit = :penerbit, tahun_terbit = :tahun_terbit
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'           => $id,
            ':judul'        => $data['judul'],
            ':penulis'      => $data['penulis'],
            ':penerbit'     => $data['penerbit'],
            ':tahun_terbit' => $data['tahun_terbit']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            'DELETE FROM buku WHERE id = :id'
        );
        return $stmt->execute([':id' => $id]);
    }
}
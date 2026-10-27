<?php

class Ubs extends Model
{
    public function cadastrar(
        string $nome,
        string $telefone,
        string $email,
        string $responsavel,
        string $cidade
    ): bool {
        $sql = "
            INSERT INTO ubs (
                nome,
                telefone,
                email,
                responsavel,
                cidade
            )
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nome,
            $telefone,
            $email,
            $responsavel,
            $cidade
        ]);
    }


    public function listarTodas(): array
    {
        $sql = "
            SELECT *
            FROM ubs
            ORDER BY nome ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function buscarPorId(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM ubs
            WHERE id = ?
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $ubs = $stmt->fetch();

        return $ubs ?: null;
    }


    public function atualizar(
        int $id,
        string $nome,
        string $telefone,
        string $email,
        string $responsavel,
        string $cidade
    ): bool {
        $sql = "
            UPDATE ubs
            SET
                nome = ?,
                telefone = ?,
                email = ?,
                responsavel = ?,
                cidade = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nome,
            $telefone,
            $email,
            $responsavel,
            $cidade,
            $id
        ]);
    }


    public function possuiVinculos(int $id): bool
    {
        $sql = "
            SELECT id
            FROM doacoes
            WHERE ubs_id = ?

            UNION

            SELECT id
            FROM retiradas
            WHERE ubs_id = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $id,
            $id
        ]);

        return (bool) $stmt->fetch();
    }


    public function excluir(int $id): bool
    {
        $sql = "
            DELETE FROM ubs
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}
<?php

class Doador extends Model
{
    public function listarTodos(): array
    {
        $sql = "
            SELECT *
            FROM doadores
            ORDER BY nome ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function cadastrar(array $dados): bool
    {
        $sql = "
            INSERT INTO doadores (
                nome,
                cpf,
                telefone,
                email,
                endereco,
                numero,
                cep,
                complemento,
                bairro,
                nasc,
                tipo_sangue_id,
                sexo,
                peso
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $dados['nome'],
            preg_replace('/\D/', '', $dados['cpf']),
            $dados['telefone'],
            $dados['email'],
            $dados['endereco'],
            $dados['numero'],
            preg_replace('/\D/', '', $dados['cep']),
            $dados['complemento'],
            $dados['bairro'],
            $dados['nasc'],
            $dados['tipo_sangue_id'],
            $dados['sexo'],
            $dados['peso']
        ]);
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "
            SELECT
                d.*,
                ts.tipo AS tipo_sangue
            FROM doadores d
            LEFT JOIN tipos_sangue ts
                ON d.tipo_sangue_id = ts.id
            WHERE d.id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $doador = $stmt->fetch();

        return $doador ?: null;
    }

    public function listarTiposSangue(): array
    {
        $sql = "
            SELECT id, tipo
            FROM tipos_sangue
            ORDER BY tipo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function atualizar(int $id, array $dados): bool
    {
        $sql = "
            UPDATE doadores SET
                nome = ?,
                cpf = ?,
                sexo = ?,
                nasc = ?,
                email = ?,
                cep = ?,
                endereco = ?,
                numero = ?,
                bairro = ?,
                complemento = ?,
                telefone = ?,
                peso = ?,
                tipo_sangue_id = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $dados['nome'],
            preg_replace('/\D/', '', $dados['cpf']),
            $dados['sexo'],
            $dados['nasc'],
            $dados['email'],
            preg_replace('/\D/', '', $dados['cep']),
            $dados['endereco'],
            $dados['numero'],
            $dados['bairro'],
            $dados['complemento'],
            $dados['telefone'],
            $dados['peso'],
            $dados['tipo_sangue_id'],
            $id
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "
            DELETE FROM doadores
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function validar(int $id): bool
    {
        $sql = "
            UPDATE doadores
            SET validado = 1
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}
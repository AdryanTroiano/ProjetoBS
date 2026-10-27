<?php

class UbsController extends Controller
{
    private Ubs $ubs;

    public function __construct()
    {
        $this->ubs = new Ubs();
    }


    // =========================
    // CADASTRO
    // =========================

    public function create(): void
    {
        $this->view('ubs/create');
    }


    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método não permitido.';
            return;
        }

        $nome = trim($_POST['nome'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $responsavel = trim($_POST['responsavel'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');


        // Nome é obrigatório
        if ($nome === '') {
            echo "
                <script>
                    alert('Informe o nome da UBS.');
                    window.history.back();
                </script>
            ";
            return;
        }


        // Valida o e-mail somente se ele for informado
        if (
            $email !== '' &&
            !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            echo "
                <script>
                    alert('Informe um e-mail válido.');
                    window.history.back();
                </script>
            ";
            return;
        }


        try {

            $this->ubs->cadastrar(
                $nome,
                $telefone,
                $email,
                $responsavel,
                $cidade
            );

            echo "
                <script>
                    alert('UBS cadastrada com sucesso!');
                    window.location.href='index.php?rota=ubs';
                </script>
            ";

        } catch (PDOException $e) {

            http_response_code(500);

            echo "
                <script>
                    alert('Erro ao cadastrar UBS.');
                    window.history.back();
                </script>
            ";
        }
    }


    // =========================
    // EDIÇÃO
    // =========================

    public function edit(int $id): void
    {
        if ($id <= 0) {
            http_response_code(400);
            echo 'ID inválido.';
            return;
        }

        $ubs = $this->ubs->buscarPorId($id);

        if (!$ubs) {
            http_response_code(404);

            echo "
                <p style='text-align:center; color:red;'>
                    UBS não encontrada.
                </p>
            ";

            return;
        }

        $this->view('ubs/edit', [
            'ubs' => $ubs
        ]);
    }


    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método não permitido.';
            return;
        }

        $id = (int) ($_POST['id'] ?? 0);

        $nome = trim($_POST['nome'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $responsavel = trim($_POST['responsavel'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');


        if ($id <= 0 || $nome === '') {
            echo "
                <script>
                    alert('Dados inválidos.');
                    window.history.back();
                </script>
            ";

            return;
        }


        // Valida o e-mail somente se ele for informado
        if (
            $email !== '' &&
            !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            echo "
                <script>
                    alert('Informe um e-mail válido.');
                    window.history.back();
                </script>
            ";

            return;
        }


        try {

            $this->ubs->atualizar(
                $id,
                $nome,
                $telefone,
                $email,
                $responsavel,
                $cidade
            );

            echo "
                <script>
                    alert('UBS atualizada com sucesso!');
                    window.location.href='index.php?rota=ubs';
                </script>
            ";

        } catch (PDOException $e) {

            http_response_code(500);

            echo "
                <script>
                    alert('Erro ao editar UBS.');
                    window.history.back();
                </script>
            ";
        }
    }


    // =========================
    // EXCLUSÃO
    // =========================

    public function delete(int $id): void
    {
        if ($id <= 0) {
            echo "
                <script>
                    alert('ID inválido.');
                    window.location.href='index.php?rota=ubs';
                </script>
            ";

            return;
        }

        try {

            if ($this->ubs->possuiVinculos($id)) {

                echo "
                    <script>
                        alert('Não é possível excluir esta UBS, pois ela já está vinculada a doações ou retiradas.');
                        window.location.href='index.php?rota=ubs';
                    </script>
                ";

                return;
            }

            $this->ubs->excluir($id);

            echo "
                <script>
                    alert('UBS excluída com sucesso!');
                    window.location.href='index.php?rota=ubs';
                </script>
            ";

        } catch (PDOException $e) {

            http_response_code(500);

            echo "
                <script>
                    alert('Erro ao excluir UBS.');
                    window.location.href='index.php?rota=ubs';
                </script>
            ";
        }
    }


    // =========================
    // LISTAGEM
    // =========================

    public function index(): void
    {
        $ubs = $this->ubs->listarTodas();

        $this->view('ubs/index', [
            'ubs' => $ubs
        ]);
    }
}
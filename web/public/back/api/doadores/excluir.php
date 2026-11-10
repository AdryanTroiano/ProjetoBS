
<?php

header('Content-Type: application/json; charset=utf-8');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Método não permitido.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

require_once __DIR__ . '/../../../web/app/core/autoload.php';

$conteudo = file_get_contents('php://input');
$dados = json_decode($conteudo, true);

if (!is_array($dados) || empty($dados['id'])) {
    http_response_code(400);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'ID do doador não informado.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

$id = filter_var($dados['id'], FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    http_response_code(400);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'ID inválido.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

try {
    $model = new Doador();

    $doador = $model->buscarPorId($id);

    if (!$doador) {
        http_response_code(404);

        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Doador não encontrado.'
        ], JSON_UNESCAPED_UNICODE);

        exit;
    }

    $excluido = $model->excluir($id);

    if (!$excluido) {
        throw new Exception('Não foi possível excluir o doador.');
    }

    http_response_code(200);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Doador excluído com sucesso.'
    ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
    http_response_code(500);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro ao excluir o doador.'
    ], JSON_UNESCAPED_UNICODE);
}

exit;

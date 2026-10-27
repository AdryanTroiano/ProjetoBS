<?php

if (!isset($usuario) || empty($usuario)) {
    echo '<p style="text-align:center;">Funcionário não encontrado.</p>';
    return;
}

?>

<link
    rel="stylesheet"
    href="./css/usuarios.css"
>


<div class="usuarios-detalhes">

    <div class="usuarios-detalhes-topo">

        <div>

            <h2>
                Detalhes do Funcionário
            </h2>

            <p>
                Informações do usuário cadastrado no sistema.
            </p>

        </div>

    </div>


    <div class="usuarios-detalhes-conteudo">


        <!-- ID -->
        <div class="usuarios-detalhes-campo">

            <label for="usuarioId">
                ID
            </label>

            <input
                type="text"
                id="usuarioId"
                value="<?= (int) $usuario['id']; ?>"
                readonly
            >

        </div>


        <!-- NOME -->
        <div class="usuarios-detalhes-campo">

            <label for="usuarioNome">
                Nome
            </label>

            <input
                type="text"
                id="usuarioNome"
                value="<?= htmlspecialchars(
                    $usuario['usuario'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                readonly
            >

        </div>


        <!-- E-MAIL -->
        <div class="usuarios-detalhes-campo">

            <label for="usuarioEmail">
                E-mail
            </label>

            <input
                type="email"
                id="usuarioEmail"
                value="<?= htmlspecialchars(
                    $usuario['email'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                readonly
            >

        </div>


        <!-- NÍVEL -->
        <div class="usuarios-detalhes-campo">

            <label for="usuarioNivel">
                Nível de Acesso
            </label>

            <input
                type="text"
                id="usuarioNivel"
                value="<?= $usuario['nivel'] === 'admin'
                    ? 'Admin'
                    : 'Usuário'; ?>"
                readonly
            >

        </div>

    </div>


    <!-- AÇÕES -->
    <div
        class="usuarios-detalhes-acoes"
        style="
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
        "
    >

        <!-- VOLTAR -->
        <a
            href="index.php?rota=usuarios"
            class="btn-voltar-detalhes"
        >
            <i class="fas fa-arrow-left"></i>

            Voltar
        </a>


        <!-- EDITAR -->
        <a
            href="index.php?rota=editar-usuario&id=<?= (int) $usuario['id']; ?>"
            class="btn-editar-detalhes"
        >
            <i class="fas fa-pen"></i>

            Editar Funcionário
        </a>

    </div>

</div>
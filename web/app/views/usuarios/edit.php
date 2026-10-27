<?php
/** @var array $usuario */
/** @var string|null $erro */
?>

<link
    rel="stylesheet"
    href="./css/usuarios.css"
>

<div class="usuarios-page">

    <div class="usuarios-container">

        <h2>Editar Usuário</h2>

        <?php if (!empty($erro)): ?>

            <p class="usuarios-erro">
                <?= htmlspecialchars($erro) ?>
            </p>

        <?php endif; ?>


        <?php

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['mensagem'])):

        ?>

            <p class="usuarios-sucesso">
                <?= htmlspecialchars($_SESSION['mensagem']) ?>
            </p>

            <?php unset($_SESSION['mensagem']); ?>

        <?php endif; ?>


        <form
            action="index.php?rota=atualizar-usuario"
            method="POST"
            id="formEdicao"
        >

            <input
                type="hidden"
                name="id"
                value="<?= (int) $usuario['id'] ?>"
            >


            <!-- NOME -->
            <div class="usuarios-campo">

                <label for="nome">
                    Nome Completo:
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars(
                        $usuario['usuario'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >

            </div>


            <!-- E-MAIL -->
            <div class="usuarios-campo">

                <label for="email">
                    E-mail:
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars(
                        $usuario['email'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >

            </div>


            <!-- NOVA SENHA -->
            <div class="usuarios-campo">

                <label for="senha">
                    Nova Senha (deixe em branco para não alterar):
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                >

            </div>


            <!-- CONFIRMAR SENHA -->
            <div class="usuarios-campo">

                <label for="confirmar_senha">
                    Confirmar Senha:
                </label>

                <input
                    type="password"
                    id="confirmar_senha"
                    name="confirmar_senha"
                >

            </div>


            <!-- BOTÕES -->
            <div class="botoes-edicao">

                <a
                    href="index.php?rota=usuario-detalhes&id=<?= (int) $usuario['id'] ?>"
                    class="btn-cancelar-edicao"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn-salvar-edicao"
                >
                    Salvar
                </button>

            </div>

        </form>


        <p
            id="erroSenha"
            class="usuarios-erro"
            style="display: none;"
        >
            As senhas não coincidem. Tente novamente.
        </p>

    </div>

</div>


<script>

const form = document.getElementById('formEdicao');

form.addEventListener('submit', function (event) {

    const senha =
        document.getElementById('senha').value;

    const confirmarSenha =
        document.getElementById('confirmar_senha').value;

    const erro =
        document.getElementById('erroSenha');


    if (senha || confirmarSenha) {

        if (senha !== confirmarSenha) {

            event.preventDefault();

            erro.style.display = 'block';

            return;
        }
    }


    erro.style.display = 'none';

});

</script>
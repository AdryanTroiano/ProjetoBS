<link
    rel="stylesheet"
    href="./css/usuarios.css"
>

<div class="usuarios-page">

    <div class="usuarios-container">

        <h2>Cadastro de Usuário</h2>


        <?php if (!empty($erro)): ?>

            <p class="usuarios-erro">
                <?= htmlspecialchars(
                    $erro,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

        <?php endif; ?>


        <?php

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['mensagem'])):

        ?>

            <p class="usuarios-sucesso">
                <?= htmlspecialchars(
                    $_SESSION['mensagem'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

            <?php unset($_SESSION['mensagem']); ?>

        <?php endif; ?>


        <form
            action="index.php?rota=cadastrar-usuario"
            method="POST"
            id="formCadastro"
        >

            <!-- NOME -->
            <div class="usuarios-campo">

                <label for="nome">
                    Nome Completo:
                </label>

                <input
                    type="text"
                    name="nome"
                    id="nome"
                    placeholder="Nome Completo"
                    value="<?= htmlspecialchars(
                        $_POST['nome'] ?? '',
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
                    name="email"
                    id="email"
                    placeholder="E-mail"
                    value="<?= htmlspecialchars(
                        $_POST['email'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    required
                >

            </div>


            <!-- SENHA -->
            <div class="usuarios-campo">

                <label for="senha">
                    Senha:
                </label>

                <input
                    type="password"
                    name="senha"
                    id="senha"
                    placeholder="Senha"
                    required
                >

            </div>


            <!-- CONFIRMAR SENHA -->
            <div class="usuarios-campo">

                <label for="confirmar_senha">
                    Confirmar Senha:
                </label>

                <input
                    type="password"
                    name="confirmar_senha"
                    id="confirmar_senha"
                    placeholder="Confirmar Senha"
                    required
                >

            </div>


            <!-- NÍVEL DE ACESSO -->
            <div class="usuarios-campo">

                <label for="nivel">
                    Nível de Acesso:
                </label>

                <select
                    name="nivel"
                    id="nivel"
                    required
                >

                    <option
                        value="padrao"
                        <?= ($_POST['nivel'] ?? 'padrao') === 'padrao'
                            ? 'selected'
                            : '' ?>
                    >
                        Usuário
                    </option>

                    <option
                        value="admin"
                        <?= ($_POST['nivel'] ?? '') === 'admin'
                            ? 'selected'
                            : '' ?>
                    >
                        Admin
                    </option>

                </select>

            </div>


            <!-- BOTÕES -->
            <div class="botoes-edicao">

                <a
                    href="index.php?rota=usuarios"
                    class="btn-cancelar-edicao"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn-salvar-edicao"
                >
                    Cadastrar
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

document
    .getElementById('formCadastro')
    .addEventListener('submit', function (event) {

        const senha =
            document.getElementById('senha').value;

        const confirmarSenha =
            document.getElementById('confirmar_senha').value;

        const erro =
            document.getElementById('erroSenha');


        if (senha !== confirmarSenha) {

            event.preventDefault();

            erro.style.display = 'block';

            return;
        }


        erro.style.display = 'none';

    });

</script>
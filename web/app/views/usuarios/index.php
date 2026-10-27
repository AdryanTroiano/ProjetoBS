<link
    rel="stylesheet"
    href="./css/usuarios.css"
>

<div class="usuarios-listagem">

    <div class="usuarios-listagem-topo">

        <div>
            <h2>Funcionários</h2>

            <p>
                Gerencie os usuários cadastrados no sistema.
            </p>
        </div>


        <!-- ADICIONAR NOVO FUNCIONÁRIO -->
        <a
            href="index.php?rota=novo-usuario"
            class="usuarios-btn-adicionar"
            title="Cadastrar novo funcionário"
            aria-label="Cadastrar novo funcionário"
        >
            <i class="fas fa-plus"></i>
        </a>

    </div>


    <?php if (empty($usuarios)): ?>

        <div class="usuarios-vazio">
            Nenhum usuário cadastrado.
        </div>

    <?php else: ?>

        <div class="usuarios-tabela-container">

            <table class="usuarios-tabela">

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Nome
                        </th>

                        <th>
                            E-mail
                        </th>

                        <th>
                            Nível de Acesso
                        </th>

                        <th>
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($usuarios as $usuario): ?>

                        <tr>

                            <td>

                                <?= htmlspecialchars(
                                    $usuario['id'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $usuario['usuario'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>


                            <td>

                                <?= htmlspecialchars(
                                    $usuario['email'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </td>


                            <td>

                                <?php if ($usuario['nivel'] === 'admin'): ?>

                                    <span class="usuarios-nivel admin">
                                        Admin
                                    </span>

                                <?php else: ?>

                                    <span class="usuarios-nivel padrao">
                                        Usuário
                                    </span>

                                <?php endif; ?>

                            </td>


                            <td>

                                <div class="acoes-tabela">

                                    <!-- VISUALIZAR -->
                                    <a
                                        href="index.php?rota=usuario-detalhes&id=<?= (int) $usuario['id'] ?>"
                                        class="btn-acao btn-visualizar"
                                        title="Visualizar funcionário"
                                        aria-label="Visualizar funcionário"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <!-- EXCLUIR -->
                                    <button
                                        type="button"
                                        class="btn-acao btn-excluir"
                                        title="Excluir funcionário"
                                        aria-label="Excluir funcionário"
                                        onclick="
                                            if (
                                                confirm(
                                                    'Tem certeza que deseja excluir este funcionário?'
                                                )
                                            ) {
                                                location.href =
                                                    'index.php?rota=excluir-usuario&id=<?= (int) $usuario['id'] ?>';
                                            }
                                        "
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

<link rel="stylesheet" href="./css/usuarios.css">

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

        <!-- PESQUISA DE FUNCIONÁRIOS -->
        <div class="usuarios-pesquisa">

            <label for="searchInput">
                Pesquise por Código, nome, e-mail ou nível de acesso:
            </label>

            <div class="search-container">

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Buscar funcionário"
                    class="form-control"
                >

                <button
                    type="button"
                    onclick="filterTable()"
                    class="btn-pesquisar"
                >
                    <i class="fas fa-search"></i>
                </button>

                <button
                    type="button"
                    id="btnLimparPesquisa"
                    onclick="clearSearch()"
                    class="btnlimp"
                    title="Limpar pesquisa"
                    aria-label="Limpar pesquisa"
                    style="display: none;"
                >
                    <i class="fas fa-trash-alt"></i>
                </button>

            </div>

        </div>

        <!-- TABELA DE FUNCIONÁRIOS -->
        <div class="usuarios-tabela-container">

            <table class="usuarios-tabela" id="dataTable">

                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Nível de Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($usuarios as $usuario): ?>

                        <tr data-usuario>

                            <td>
                                <?= htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($usuario['usuario'], ENT_QUOTES, 'UTF-8') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8') ?>
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
                                        onclick="if (confirm('Tem certeza que deseja excluir este funcionário?')) { location.href = 'index.php?rota=excluir-usuario&id=<?= (int) $usuario['id'] ?>'; }"
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

        <!-- SCRIPT DE PESQUISA -->
        <script>

            function filterTable() {

                const input = document.getElementById('searchInput');

                const filter = input.value.trim().toLowerCase();

                const tbody = document.querySelector('#dataTable tbody');

                const linhas = tbody.querySelectorAll('tr[data-usuario]');

                let encontrados = 0;

                // Remove mensagem anterior
                const mensagemAnterior = document.getElementById('nenhumResultadoPesquisa');

                if (mensagemAnterior) {
                    mensagemAnterior.remove();
                }

                // Pesquisa nas linhas
                linhas.forEach(linha => {

                    const texto = linha.textContent.toLowerCase();

                    if (texto.includes(filter)) {

                        linha.style.display = '';
                        encontrados++;

                    } else {

                        linha.style.display = 'none';

                    }

                });

                // Exibe mensagem caso não encontre
                if (encontrados === 0) {

                    const mensagem = document.createElement('tr');

                    mensagem.id = 'nenhumResultadoPesquisa';

                    mensagem.innerHTML = `
                        <td colspan="5">
                            Usuário não encontrado!
                        </td>
                    `;

                    tbody.appendChild(mensagem);

                }

            }


            // Limpar pesquisa
            function clearSearch() {

                const input = document.getElementById('searchInput');

                input.value = '';

                document.getElementById('btnLimparPesquisa').style.display = 'none';

                const tbody = document.querySelector('#dataTable tbody');

                // Exibe novamente todos os funcionários
                tbody.querySelectorAll('tr[data-usuario]').forEach(linha => {
                    linha.style.display = '';
                });

                // Remove mensagem de não encontrado
                const mensagem = document.getElementById('nenhumResultadoPesquisa');

                if (mensagem) {
                    mensagem.remove();
                }

                input.focus();

            }


            // Pesquisar ao pressionar Enter
            document.getElementById('searchInput').addEventListener('keydown', function(event) {

                if (event.key === 'Enter') {

                    event.preventDefault();

                    filterTable();

                }

            });


            // Exibir botão de limpar somente quando houver texto
            document.getElementById('searchInput').addEventListener('input', function() {

                document.getElementById('btnLimparPesquisa').style.display =
                    this.value.length > 0 ? 'inline-flex' : 'none';

            });

        </script>

    <?php endif; ?>

</div>

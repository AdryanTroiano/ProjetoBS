
<div style="
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
    text-align: center;
">

    <h1 id="path2">
        Lista de UBS
    </h1>

    <a
        href="index.php?rota=nova-ubs"
        title="Cadastrar nova UBS"
        aria-label="Cadastrar nova UBS"
        style="
            position: absolute;
            right: 6.5rem;
            top: 0;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
            transition: 0.2s;
        "
        onmouseover="this.style.backgroundColor='#218838'"
        onmouseout="this.style.backgroundColor='#28a745'"
    >
        <i class="fas fa-plus"></i>
    </a>

</div>

<br>

<div style="display: flex; flex-direction: column; align-items: center;">

    <label for="searchInput" style="margin-bottom: 6px;">
        Digite o nome da UBS que deseja localizar:
    </label>

    <div
        class="search-container"
        style="
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        "
    >

        <input
            type="text"
            id="searchInput"
            placeholder="Buscar por UBS"
            class="form-control"
            style="width: 300px;"
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

<script>

function filterTable() {

    const input = document.getElementById('searchInput');
    const filter = input.value.trim().toLowerCase();

    const table = document.getElementById('dataTable');
    const tbody = table.querySelector('tbody');

    const linhas = tbody.querySelectorAll('tr[data-ubs]');

    let encontrados = 0;

    const mensagemAnterior = document.getElementById('nenhumResultadoPesquisa');

    if (mensagemAnterior) {
        mensagemAnterior.remove();
    }

    linhas.forEach(linha => {

        const nome = linha.cells[0].textContent.toLowerCase().trim();

        if (nome.includes(filter)) {

            linha.style.display = '';
            encontrados++;

        } else {

            linha.style.display = 'none';

        }

    });

    if (linhas.length > 0 && encontrados === 0) {

        const mensagem = document.createElement('tr');

        mensagem.id = 'nenhumResultadoPesquisa';

        mensagem.innerHTML = `
            <td colspan="2" class="text-center alert alert-danger">
                Nenhuma UBS encontrada!
            </td>
        `;

        tbody.appendChild(mensagem);

    }

}

function clearSearch() {

    const input = document.getElementById('searchInput');

    input.value = '';

    document.getElementById('btnLimparPesquisa').style.display = 'none';

    const table = document.getElementById('dataTable');

    table.querySelectorAll('tbody tr[data-ubs]').forEach(linha => {
        linha.style.display = '';
    });

    const mensagem = document.getElementById('nenhumResultadoPesquisa');

    if (mensagem) {
        mensagem.remove();
    }

}

document.getElementById('searchInput').addEventListener('keydown', function(event) {

    if (event.key === 'Enter') {

        event.preventDefault();

        filterTable();

    }

});

document.getElementById('searchInput').addEventListener('input', function() {

    document.getElementById('btnLimparPesquisa').style.display =
        this.value.length > 0 ? 'inline-flex' : 'none';

});

</script>

<br>

<div style="display:flex; justify-content:center;">

    <table
        class="table"
        id="dataTable"
        style="width:80%; max-width:800px;"
    >

        <thead>

            <tr>

                <th style="text-align:center;">
                    Nome
                </th>

                <th
                    style="
                        text-align:center;
                        width:140px;
                    "
                >
                    Ações
                </th>

            </tr>

        </thead>

        <tbody>

            <?php if (!empty($ubs)): ?>

                <?php foreach ($ubs as $unidade): ?>

                    <tr data-ubs>

                        <td style="text-align:center;">

                            <?= htmlspecialchars(
                                $unidade['nome'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>

                        </td>

                        <td style="text-align:center;">

                            <div class="acoes-tabela">

                                <!-- VISUALIZAR -->
                                <a
                                    href="index.php?rota=ubs-detalhes&id=<?= (int) $unidade['id']; ?>"
                                    class="btn-acao btn-visualizar"
                                    title="Visualizar UBS"
                                    aria-label="Visualizar UBS"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- EXCLUIR -->
                                <button
                                    type="button"
                                    class="btn-acao btn-excluir"
                                    title="Excluir UBS"
                                    aria-label="Excluir UBS"
                                    onclick="
                                        if (
                                            confirm(
                                                'Tem certeza que deseja excluir esta UBS?'
                                            )
                                        ) {
                                            location.href =
                                                'index.php?rota=excluir-ubs&id=<?= (int) $unidade['id']; ?>';
                                        }
                                    "
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="2"
                        style="text-align:center;"
                    >
                        Nenhuma UBS cadastrada.
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

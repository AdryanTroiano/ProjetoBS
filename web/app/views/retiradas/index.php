
<div style="
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
    text-align: center;
">

    <h1 id="path2">
        Lista de retiradas
    </h1>

    <a
        href="index.php?rota=nova-retirada"
        title="Cadastrar nova retirada"
        aria-label="Cadastrar nova retirada"
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
        Pesquise pelo nome da UBS ou pela data da retirada ex: (11/26 ou 10/11/2026)
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
            placeholder="Buscar por UBS ou data"
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

    const linhas = tbody.querySelectorAll('tr[data-retirada]');

    let encontrados = 0;

    const mensagemAnterior = document.getElementById('nenhumResultadoPesquisa');

    if (mensagemAnterior) {
        mensagemAnterior.remove();
    }

    linhas.forEach(linha => {

        // Coluna UBS: índice 2
        const ubs = linha.cells[2].textContent.toLowerCase().trim();

        // Coluna Data: índice 3
        const data = linha.cells[3].textContent.toLowerCase().trim();

        const corresponde =
            ubs.includes(filter) ||
            data.includes(filter);

        if (corresponde) {

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
            <td colspan="5" class="text-center alert alert-danger">
                Nenhuma retirada encontrada!
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

    table.querySelectorAll('tbody tr[data-retirada]').forEach(linha => {
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

<div style="display: flex; justify-content: center;">

    <table
        class="table"
        id="dataTable"
        style="width: 90%; max-width: 1000px;"
    >

        <thead>

            <tr>

                <th style="text-align:center;">
                    Tipo Sanguíneo
                </th>

                <th style="text-align:center;">
                    Quantidade (ml)
                </th>

                <th style="text-align:center;">
                    UBS
                </th>

                <th style="text-align:center;">
                    Data
                </th>

                <th style="text-align:center;">
                    Observação
                </th>

            </tr>

        </thead>

        <tbody>

        <?php if (!empty($retiradas)): ?>

            <?php foreach ($retiradas as $retirada): ?>

                <tr data-retirada>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $retirada['tipo_sangue']
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $retirada['quantidade_ml']
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $retirada['ubs']
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= date(
                            'd/m/Y',
                            strtotime(
                                $retirada['data_retirada']
                            )
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $retirada['observacao'] ?? ''
                        ); ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td
                    colspan="5"
                    class="text-center alert alert-danger"
                >

                    Não há retiradas registradas!

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

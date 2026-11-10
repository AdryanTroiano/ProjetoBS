<div style="
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
    text-align: center;
">

    <h1 id="path2">
        Lista de Doações
    </h1>

    <a
        href="index.php?rota=nova-doacao"
        title="Cadastrar nova doação"
        aria-label="Cadastrar nova doação"
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

<div class="search-container" style="display: flex; justify-content: center;">

    <input
        type="text"
        id="searchInput"
        placeholder="Buscar por doador"
        class="form-control"
        onkeyup="filterTable()"
        style="width: 300px;"
    >

    <button onclick="clearSearch()" class="btnlimp">
        Limpar
    </button>

</div>

<script>

function filterTable() {

    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('dataTable');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {

        const td = tr[i].getElementsByTagName('td')[0];

        if (td) {

            const txtValue = td.textContent || td.innerText;

            tr[i].style.display =
                txtValue.toLowerCase().indexOf(filter) > -1
                    ? ""
                    : "none";
        }
    }
}

function clearSearch() {

    document.getElementById('searchInput').value = '';

    filterTable();
}

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
                    Doador
                </th>

                <th style="text-align:center;">
                    UBS
                </th>

                <th style="text-align:center;">
                    Data
                </th>

                <th style="text-align:center;">
                    Quantidade (ml)
                </th>

            </tr>

        </thead>

        <tbody>

        <?php if (!empty($doacoes)): ?>

            <?php foreach ($doacoes as $doacao): ?>

                <tr>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $doacao['doador'] ?? ''
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $doacao['ubs'] ?? ''
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= date(
                            'd/m/Y',
                            strtotime($doacao['data_doacao'])
                        ); ?>

                    </td>

                    <td style="text-align:center;">

                        <?= htmlspecialchars(
                            $doacao['quantidade_ml']
                        ); ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td
                    colspan="4"
                    class="text-center alert alert-danger"
                >

                    Não há doações registradas!

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>
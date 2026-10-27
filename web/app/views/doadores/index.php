<?php

if (!isset($doadores)) {
    $doadores = [];
}

?>

<h1 id="path2" style="text-align: center;">
    Listar Doadores
</h1>

<br>

<div
    class="search-container"
    style="display: flex; justify-content: center;"
>

    <input
        type="text"
        id="searchInput"
        placeholder="Buscar por nome"
        class="form-control"
        onkeyup="filterTable()"
        style="width: 300px;"
    >

    <button
        type="button"
        onclick="clearSearch()"
        class="btnlimp"
    >
        Limpar
    </button>

</div>


<script>

function filterTable() {

    const input =
        document.getElementById('searchInput');

    const filter =
        input.value.toLowerCase();

    const table =
        document.getElementById('dataTable');

    const tr =
        table.getElementsByTagName('tr');


    for (let i = 1; i < tr.length; i++) {

        const td =
            tr[i].getElementsByTagName('td')[0];

        if (td) {

            const txtValue =
                td.textContent || td.innerText;

            tr[i].style.display =
                txtValue
                    .toLowerCase()
                    .indexOf(filter) > -1
                    ? ""
                    : "none";
        }
    }
}


function clearSearch() {

    document.getElementById(
        'searchInput'
    ).value = '';

    filterTable();
}

</script>


<br>


<div style="display: flex; justify-content: center;">

    <table
        class="table"
        id="dataTable"
        style="width: 80%; max-width: 800px;"
    >

        <thead>

            <tr>

                <th style="text-align: center;">
                    Nome
                </th>

                <th
                    style="
                        text-align: center;
                        width: 160px;
                    "
                >
                    Status
                </th>

                <th
                    style="
                        text-align: center;
                        width: 130px;
                    "
                >
                    Ações
                </th>

            </tr>

        </thead>


        <tbody>

            <?php

            $qtd = count($doadores);

            if ($qtd > 0):

                foreach ($doadores as $row):

                    /*
                     * Verifica se o doador
                     * já pode doar novamente.
                     */
                    $mostrarAviso = false;

                    if (!empty($row['datedonation'])) {

                        $ultimaDoacao =
                            new DateTime(
                                $row['datedonation']
                            );

                        $hoje =
                            new DateTime();

                        $diff =
                            $hoje->diff(
                                $ultimaDoacao
                            );

                        $mesesPassados =
                            ($diff->y * 12)
                            + $diff->m;


                        if (
                            (
                                $row['sexo'] === 'M'
                                &&
                                $mesesPassados >= 2
                            )
                            ||
                            (
                                $row['sexo'] === 'F'
                                &&
                                $mesesPassados >= 3
                            )
                        ) {
                            $mostrarAviso = true;
                        }
                    }


                    $icone = $mostrarAviso
                        ? "
                            <span class='tooltip'>

                                <span
                                    style='color: red;'
                                >
                                    &#10067;
                                </span>

                                <span
                                    class='tooltiptext'
                                >
                                    Doador já pode doar novamente
                                </span>

                            </span>
                        "
                        : "";


                    /*
                     * Status de validação.
                     */
                    $validado =
                        (int) ($row['validado'] ?? 0);

            ?>

                    <tr>

                        <!-- NOME -->
                        <td
                            style="
                                text-align: left;
                                width: 200px;
                            "
                        >

                            <?= htmlspecialchars(
                                $row['nome'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                            <?= $icone ?>

                        </td>


                        <!-- STATUS -->
                        <td
                            class="coluna-status"
                            style="text-align: center;"
                        >

                            <?php if ($validado === 1): ?>

                                <span class="status-validado">

                                    <i
                                        class="fas fa-check-circle"
                                    ></i>

                                    Validado

                                </span>

                            <?php else: ?>

                                <form
                                    action="index.php?rota=validar-doador"
                                    method="POST"
                                    class="form-validar"
                                    onsubmit="
                                        return confirm(
                                            'Deseja validar este doador?'
                                        );
                                    "
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int) $row['id'] ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="btn-validar-doador"
                                        title="Validar doador"
                                    >

                                        <i
                                            class="fas fa-check"
                                        ></i>

                                        Validar

                                    </button>

                                </form>

                            <?php endif; ?>

                        </td>


                        <!-- AÇÕES -->
                        <td style="text-align: center;">

                            <div class="acoes-tabela">

                                <!-- VISUALIZAR -->
                                <a
                                    href="?rota=doador&id=<?= (int) $row['id'] ?>"
                                    class="btn-acao btn-visualizar"
                                    title="Visualizar doador"
                                    aria-label="Visualizar doador"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>


                                <!-- EXCLUIR -->
                                <button
                                    type="button"
                                    class="btn-acao btn-excluir"
                                    title="Excluir doador"
                                    aria-label="Excluir doador"
                                    onclick="
                                        if (
                                            confirm(
                                                'Tem certeza que deseja excluir este doador?'
                                            )
                                        ) {
                                            location.href =
                                                '?rota=excluir&id=<?= (int) $row['id'] ?>';
                                        }
                                    "
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

            <?php

                endforeach;

            else:

            ?>

                <tr>

                    <td
                        colspan="3"
                        class="text-center alert alert-danger"
                        style="text-align: center;"
                    >
                        Não há cadastros disponíveis!
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>
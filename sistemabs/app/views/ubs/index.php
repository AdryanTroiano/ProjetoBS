<h1 id="path2" style="text-align:center;">
    Listar UBS
</h1>

<br>

<div style="display:flex; justify-content:center;">

    <table
        class="table"
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

                    <tr>

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
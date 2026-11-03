<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Doação</title>

    <!-- Tom Select -->
    <link
        href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css"
        rel="stylesheet"
    >

    <style>
        /* Campo de pesquisa de doadores */
        #selectDoador + .ts-wrapper {
            width: 100%;
            max-width: 100%;
        }

        #selectDoador + .ts-wrapper .ts-control {
            min-height: 38px;
            padding: 8px 12px;
            font-size: 14px;
        }

        #selectDoador + .ts-wrapper .ts-dropdown {
            font-size: 14px;
        }
    </style>

</head>

<body>

<div class="container">

    <h1 id="path2">Cadastrar Doação</h1>

    <form action="index.php?rota=cadastrar-doacao" method="POST">

        <div class="contentform">
            <div class="form-container">

                <!-- DOADOR -->
                <div class="row">
                    <div class="column">

                        <label for="selectDoador">
                            Doador:<span class="required">*</span>
                        </label>

                        <select
                            name="doador_id"
                            id="selectDoador"
                            placeholder="Digite o nome do doador..."
                            required
                        >

                            <option value="">Selecione o doador</option>

                            <?php foreach ($doadores as $doador): ?>

                                <?php
                                    $validado = (int) ($doador['validado'] ?? 0);
                                ?>

                                <?php if ($validado === 1): ?>

                                    <option value="<?= (int) $doador['id']; ?>">
                                        <?= htmlspecialchars(
                                            $doador['nome'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?>
                                    </option>

                                <?php else: ?>

                                    <option
                                        value="pendente_<?= (int) $doador['id']; ?>"
                                        disabled
                                    >
                                        <?= htmlspecialchars(
                                            $doador['nome'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?>
                                        — Pendente de validação
                                    </option>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>

                    </div>
                </div>

                <!-- AVISO DE VALIDAÇÃO -->
                <div
                    id="avisoValidacao"
                    style="
                        display: none;
                        margin-top: 5px;
                        margin-bottom: 15px;
                        padding: 10px;
                        border-radius: 5px;
                        background-color: #fff3cd;
                        color: #856404;
                    "
                >
                    Doadores pendentes precisam ser validados pelo
                    aplicativo antes de realizar uma doação.
                </div>

                <!-- UBS -->
                <div class="row">
                    <div class="column">

                        <label for="ubs_id">
                            UBS:<span class="required">*</span>
                        </label>

                        <select name="ubs_id" id="ubs_id" required>

                            <option value="" disabled selected>
                                Selecione a UBS
                            </option>

                            <?php foreach ($ubs as $unidade): ?>

                                <option value="<?= (int) $unidade['id']; ?>">
                                    <?= htmlspecialchars(
                                        $unidade['nome'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>
                </div>

                <!-- DATA DA DOAÇÃO -->
                <div class="row">
                    <div class="column">

                        <label for="data_doacao">
                            Data da Doação:<span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="data_doacao"
                            id="data_doacao"
                            value="<?= date('Y-m-d'); ?>"
                            required
                        >

                    </div>
                </div>

                <!-- QUANTIDADE -->
                <div class="row">
                    <div class="column">

                        <label for="quantidade_ml">
                            Quantidade (ml):<span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="quantidade_ml"
                            id="quantidade_ml"
                            min="1"
                            required
                        >

                    </div>
                </div>

                <!-- BOTÕES -->
                <div class="row">
                    <div class="column button-column">

                        <div class="botoes-edicao">

                            <a
                                href="index.php?rota=doacoes"
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

                    </div>
                </div>

            </div>
        </div>

    </form>

</div>

<!-- Biblioteca Tom Select -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const avisoValidacao = document.getElementById("avisoValidacao");

    const selectDoador = new TomSelect("#selectDoador", {

        create: false,

        placeholder: "Digite o nome do doador...",

        searchField: ["text"],

        onChange: function () {
            avisoValidacao.style.display = "none";
        },

        render: {
            option: function (data, escape) {

                if (data.pendente) {
                    return `
                        <div style="color: #856404;">
                            ${escape(data.text)}
                        </div>
                    `;
                }

                return `<div>${escape(data.text)}</div>`;
            }
        }

    });

    // Doadores pendentes
    const doadoresPendentes = [

        <?php foreach ($doadores as $doador): ?>

            <?php if ((int) ($doador['validado'] ?? 0) !== 1): ?>

                {
                    id: "pendente_<?= (int) $doador['id']; ?>",

                    nome: <?= json_encode(
                        $doador['nome'] . ' — Pendente de validação',
                        JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                    ); ?>
                },

            <?php endif; ?>

        <?php endforeach; ?>

    ];

    // Adiciona os pendentes à pesquisa
    doadoresPendentes.forEach(function (doador) {

        selectDoador.addOption({
            value: doador.id,
            text: doador.nome,
            pendente: true
        });

    });

    // Impede a seleção de doadores pendentes
    selectDoador.on("item_add", function (value) {

        if (String(value).startsWith("pendente_")) {

            selectDoador.removeItem(value, true);

            avisoValidacao.style.display = "block";

        }

    });

    selectDoador.refreshOptions(false);

});

</script>

</body>
</html>
<style>

.retirada-container {
    max-width: 800px;
    margin: 10px auto;
    padding: 30px;
    border-radius: 8px;
}

.retirada-container .row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.retirada-container .column {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.retirada-container label {
    margin-bottom: 6px;
    font-weight: 600;
}

.retirada-container input,
.retirada-container textarea,
.retirada-container select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.retirada-container textarea {
    min-height: 80px;
}

.retirada-container .button-column {
    width: 100%;
}


/* =========================================
   BOTÕES
   ========================================= */

.retirada-container .botoes-edicao {
    width: 100%;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    margin-top: 10px;
}


/* CANCELAR */

.retirada-container .btn-cancelar-edicao {
    width: 150px;
    height: 42px;

    padding: 0;
    margin: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background-color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 6px;

    color: #ffffff;

    font-size: 14px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    box-sizing: border-box;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.retirada-container .btn-cancelar-edicao:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;

    color: #ffffff;
    text-decoration: none;

    transform: none;
}

.retirada-container .btn-cancelar-edicao:active {
    background-color: #b02a37;

    transform: none;
}


/* REGISTRAR */

.retirada-container .btn-salvar-edicao {
    width: 170px;
    height: 42px;

    padding: 0;
    margin: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background-color: #0d6efd;
    border: 1px solid #0d6efd;
    border-radius: 6px;

    color: #ffffff;

    font-family: inherit;
    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    box-sizing: border-box;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.retirada-container .btn-salvar-edicao:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;

    transform: none;
}

.retirada-container .btn-salvar-edicao:active {
    background-color: #0a58ca;

    transform: none;
}


/* TÍTULO */

#path7 {
    text-decoration-line: underline;

    margin: 0 10%;
    margin-bottom: 1rem;

    padding-top: 2rem;

    width: auto;

    box-sizing: border-box;

    text-align: center;
}


/* RESPONSIVO */

@media (max-width: 600px) {

    .retirada-container {
        padding: 20px 10px;
    }

    .retirada-container .row {
        flex-direction: column;
        gap: 15px;
    }

    .retirada-container .botoes-edicao {
        flex-direction: row;
        gap: 10px;
    }

    .retirada-container .btn-cancelar-edicao,
    .retirada-container .btn-salvar-edicao {
        width: auto;
        flex: 1;
    }
}

</style>


<div class="retirada-container">

    <form
        action="index.php?rota=cadastrar-retirada"
        method="POST"
    >

        <h1 id="path7">
            Cadastrar Retirada
        </h1>


        <!-- TIPO SANGUÍNEO -->
        <div class="row">

            <div class="column">

                <label for="tipo_sangue_id">
                    Tipo sanguíneo:<span class="required">*</span>
                </label>

                <select
                    name="tipo_sangue_id"
                    id="tipo_sangue_id"
                    required
                >

                    <option value="">
                        Selecione
                    </option>

                    <?php foreach ($tipos as $tipo): ?>

                        <option
                            value="<?= (int) $tipo['id']; ?>"
                        >
                            <?= htmlspecialchars(
                                $tipo['tipo'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>


        <!-- QUANTIDADE / DATA -->
        <div class="row">

            <div class="column">

                <label for="quantidade">
                    Quantidade (ml):<span class="required">*</span>
                </label>

                <input
                    type="number"
                    name="quantidade"
                    id="quantidade"
                    min="1"
                    required
                >

            </div>


            <div class="column">

                <label for="data">
                    Data:<span class="required">*</span>
                </label>
<input
    type="date"
    name="data"
    id="data"
    value="<?= date('Y-m-d'); ?>"
    required
>

            </div>

        </div>


        <!-- UBS DESTINO -->
        <div class="row">

            <div class="column">

                <label for="ubs_id">
                    UBS Destino:<span class="required">*</span>
                </label>

                <select
                    name="ubs_id"
                    id="ubs_id"
                    required
                >

                    <option value="">
                        Selecione
                    </option>

                    <?php foreach ($ubs as $u): ?>

                        <option
                            value="<?= (int) $u['id']; ?>"
                        >
                            <?= htmlspecialchars(
                                $u['nome'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>


        <!-- OBSERVAÇÃO -->
        <div class="row">

            <div class="column">

                <label for="observacao">
                    Observação:
                </label>

                <textarea
                    name="observacao"
                    id="observacao"
                ></textarea>

            </div>

        </div>


        <!-- BOTÕES -->
        <div class="row">

            <div class="column button-column">

                <div class="botoes-edicao">

                    <a
                        href="index.php?rota=retiradas"
                        class="btn-cancelar-edicao"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn-salvar-edicao"
                    >
                        Registrar
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>
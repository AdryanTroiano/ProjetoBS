<?php
/** @var array $ubs */

if (!isset($ubs)) {
    echo '<div>UBS não encontrada!</div>';
    exit;
}
?>

<h1 id="path2" style="text-align: center;">
    Editar UBS
</h1>

<div class="container">

    <form
        action="index.php?rota=atualizar-ubs"
        method="POST"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $ubs['id']; ?>"
        >

        <div class="contentform">

            <div
                class="form-container"
                style="
                    width: 100%;
                    max-width: 800px;
                    margin: 0 auto;
                "
            >

                <!-- LINHA 1: NOME DA UBS -->
                <div
                    class="row"
                    style="
                        margin-bottom: 20px;
                        width: 100%;
                    "
                >

                    <div
                        class="column"
                        style="width: 100%;"
                    >

                        <label
                            for="nome"
                            style="
                                display: block;
                                margin-bottom: 5px;
                            "
                        >
                            Nome da UBS:<span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            value="<?= htmlspecialchars(
                                $ubs['nome'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Ex: UBS Central"
                            required
                            style="
                                width: 100% !important;
                                box-sizing: border-box;
                            "
                        >

                    </div>

                </div>


                <!-- LINHA 2: TELEFONE E E-MAIL -->
                <div
                    class="row"
                    style="
                        display: flex;
                        gap: 4%;
                        margin-bottom: 20px;
                        width: 100%;
                    "
                >

                    <div
                        class="column"
                        style="width: 48%;"
                    >

                        <label
                            for="telefone"
                            style="
                                display: block;
                                margin-bottom: 5px;
                            "
                        >
                            Número do Telefone:
                        </label>

                        <input
                            type="tel"
                            name="telefone"
                            id="telefone"
                            value="<?= htmlspecialchars(
                                $ubs['telefone'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Ex: (16) 99999-9999"
                            style="
                                width: 100% !important;
                                box-sizing: border-box;
                            "
                        >

                    </div>


                    <div
                        class="column"
                        style="width: 48%;"
                    >

                        <label
                            for="email"
                            style="
                                display: block;
                                margin-bottom: 5px;
                            "
                        >
                            E-mail:
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="<?= htmlspecialchars(
                                $ubs['email'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Ex: ubs@email.com"
                            style="
                                width: 100% !important;
                                box-sizing: border-box;
                            "
                        >

                    </div>

                </div>


                <!-- LINHA 3: RESPONSÁVEL E CIDADE -->
                <div
                    class="row"
                    style="
                        display: flex;
                        gap: 4%;
                        margin-bottom: 20px;
                        width: 100%;
                    "
                >

                    <div
                        class="column"
                        style="width: 48%;"
                    >

                        <label
                            for="responsavel"
                            style="
                                display: block;
                                margin-bottom: 5px;
                            "
                        >
                            Responsável pela Unidade:
                        </label>

                        <input
                            type="text"
                            name="responsavel"
                            id="responsavel"
                            value="<?= htmlspecialchars(
                                $ubs['responsavel'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Ex: Dr. Carlos Silva"
                            style="
                                width: 100% !important;
                                box-sizing: border-box;
                            "
                        >

                    </div>


                    <div
                        class="column"
                        style="width: 48%;"
                    >

                        <label
                            for="cidade"
                            style="
                                display: block;
                                margin-bottom: 5px;
                            "
                        >
                            Cidade:
                        </label>

                        <input
                            type="text"
                            name="cidade"
                            id="cidade"
                            value="<?= htmlspecialchars(
                                $ubs['cidade'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Ex: Taquaritinga"
                            style="
                                width: 100% !important;
                                box-sizing: border-box;
                            "
                        >

                    </div>

                </div>


                <!-- LINHA 4: BOTÕES -->
                <div
                    class="row"
                    style="
                        margin-top: 30px;
                        width: 100%;
                    "
                >

                    <div
                        class="column button-column"
                        style="width: 100%;"
                    >

                        <div
                            class="botoes-edicao"
                            style="
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                width: 100%;
                            "
                        >

                            <!-- CANCELAR -->
                            <a
                                href="index.php?rota=ubs"
                                class="btn-cancelar-edicao"
                            >
                                Cancelar
                            </a>


                            <!-- SALVAR -->
                            <button
                                type="submit"
                                class="btn-salvar-edicao"
                                style="border: none !important;"
                            >
                                Salvar
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
<?php

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

            <div class="form-container">

                <!-- NOME DA UBS -->
                <div class="row">

                    <div class="column">

                        <label for="nome">
                            Nome da UBS:<span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            value="<?= htmlspecialchars(
                                $ubs['nome'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            placeholder="Digite o nome da UBS"
                            required
                        >

                    </div>

                </div>


                <!-- BOTÕES -->
                <div class="row">

                    <div class="column button-column">

                        <div class="botoes-edicao">

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
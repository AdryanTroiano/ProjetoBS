<?php

if (!isset($ubs) || empty($ubs)) {
    echo '<p style="text-align:center;">UBS não encontrada.</p>';
    return;
}

?>

<h1 id="path2" style="text-align:center;">
    Detalhes da UBS
</h1>

<br>

<div
    class="ubs-detalhes-container"
    style="
        max-width: 700px;
        margin: 20px auto;
    "
>

    <div class="row">

        <div class="column">

            <label for="nomeUbs">
                Nome da UBS
            </label>

            <input
                type="text"
                id="nomeUbs"
                value="<?= htmlspecialchars(
                    $ubs['nome'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                readonly
            >

        </div>

    </div>


    <div
        class="acoes-detalhes"
        style="
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
        "
    >

        <!-- VOLTAR -->
        <a
            href="index.php?rota=ubs"
            class="btn-voltar-detalhes"
        >
            <i class="fas fa-arrow-left"></i>

            Voltar
        </a>


        <!-- EDITAR -->
        <a
            href="index.php?rota=editar-ubs&id=<?= (int) $ubs['id']; ?>"
            class="btn-editar-detalhes"
        >
            <i class="fas fa-pen"></i>

            Editar UBS
        </a>

    </div>

</div>
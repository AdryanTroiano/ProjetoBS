<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar UBS</title>
</head>
<body>

<h1 id="path2" style="text-align: center;">
    Cadastrar UBS
</h1>

<div class="container">
    <form action="index.php?rota=cadastrar-ubs" method="POST">
        <div class="contentform">
            <div class="form-container" style="width: 100%; max-width: 800px; margin: 0 auto;">

                <!-- LINHA 1: NOME DA UBS -->
                <div class="row" style="margin-bottom: 20px; width: 100%;">
                    <div class="column" style="width: 100%;">
                        <label for="nome" style="display: block; margin-bottom: 5px;">
                            Nome da UBS:<span class="required">*</span>
                        </label>
                        <input type="text" name="nome" id="nome" placeholder="Ex: UBS Central" required style="width: 100% !important; box-sizing: border-box;">
                    </div>
                </div>

                <!-- LINHA 2: TELEFONE E EMAIL -->
                <div class="row" style="display: flex; gap: 4%; margin-bottom: 20px; width: 100%;">
                    <div class="column" style="width: 48%;">
                        <label for="telefone" style="display: block; margin-bottom: 5px;">
                            Número do Telefone:
                        </label>
                        <input type="tel" name="telefone" id="telefone" placeholder="Ex: (16) 99999-9999" style="width: 100% !important; box-sizing: border-box;">
                    </div>
                    <div class="column" style="width: 48%;">
                        <label for="email" style="display: block; margin-bottom: 5px;">
                            E-mail:
                        </label>
                        <input type="email" name="email" id="email" placeholder="Ex: ubs@email.com" style="width: 100% !important; box-sizing: border-box;">
                    </div>
                </div>

                <!-- LINHA 3: RESPONSÁVEL E CIDADE -->
                <div class="row" style="display: flex; gap: 4%; margin-bottom: 20px; width: 100%;">
                    <div class="column" style="width: 48%;">
                        <label for="responsavel" style="display: block; margin-bottom: 5px;">
                            Responsável pela Unidade:
                        </label>
                        <input type="text" name="responsavel" id="responsavel" placeholder="Ex: Dr. Carlos Silva" style="width: 100% !important; box-sizing: border-box;">
                    </div>
                    <div class="column" style="width: 48%;">
                        <label for="cidade" style="display: block; margin-bottom: 5px;">
                            Cidade:
                        </label>
                        <input type="text" name="cidade" id="cidade" placeholder="Ex: Taquaritinga" style="width: 100% !important; box-sizing: border-box;">
                    </div>
                </div>

                <!-- LINHA 4: BOTÕES -->
                <div class="row" style="margin-top: 30px; width: 100%;">
                    <div class="column button-column" style="width: 100%;">
                        <div class="botoes-edicao" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            
                            <!-- CANCELAR -->
                            <a href="index.php?rota=ubs" class="btn-cancelar-edicao">
                                Cancelar
                            </a>

                            <!-- CADASTRAR -->
                            <!-- 🟢 MODIFICADO: Incluído inline style para forçar a remoção da borda preta -->
                            <button type="submit" class="btn-enviar-cadastro btn-salvar-edicao" style="border: none !important;">
                                Cadastrar
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

</body>
</html>

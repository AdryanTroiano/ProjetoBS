
<?php

if (isset($erro)) {
    echo "<p class='doador-detalhes-erro'>" . htmlspecialchars($erro) . "</p>";
    exit;
}

if (!isset($doador)) {
    echo "<p class='doador-detalhes-erro'>Doador não encontrado.</p>";
    exit;
}

$formatar = function ($valor) {
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
};

$cpfNumeros = preg_replace('/\D/', '', (string) ($doador['cpf'] ?? ''));
$cepNumeros = preg_replace('/\D/', '', (string) ($doador['cep'] ?? ''));

$formatarCPF = function ($cpf) {
    $cpf = preg_replace('/\D/', '', (string) $cpf);

    if (strlen($cpf) === 11) {
        return substr($cpf, 0, 3) . '.' .
               substr($cpf, 3, 3) . '.' .
               substr($cpf, 6, 3) . '-' .
               substr($cpf, 9, 2);
    }

    return $cpf;
};

$formatarCEP = function ($cep) {
    $cep = preg_replace('/\D/', '', (string) $cep);

    if (strlen($cep) === 8) {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    return $cep;
};

?>

<div class="doador-detalhes-container">

    <h1 class="doador-detalhes-titulo">Detalhes do Doador</h1>

    <form
        id="formDoador"
        action="index.php?rota=atualizar-doador"
        method="POST"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $doador['id']; ?>"
        >

        <div class="doador-detalhes-tabela-container">

            <table class="doador-detalhes-tabela" id="printTable">

                <tr>
                    <th>ID</th>
                    <td><?= (int) $doador['id']; ?></td>
                </tr>

                <tr>
                    <th>Nome</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['nome']); ?></span>
                        <input class="campo-edicao" type="text" name="nome" value="<?= $formatar($doador['nome']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>Sexo</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['sexo']); ?></span>
                        <select class="campo-edicao" name="sexo" required>
                            <option value="M" <?= ($doador['sexo'] ?? '') === 'M' ? 'selected' : ''; ?>>Masculino</option>
                            <option value="F" <?= ($doador['sexo'] ?? '') === 'F' ? 'selected' : ''; ?>>Feminino</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>CPF</th>
                    <td>
                        <input
                            type="password"
                            id="cpfField"
                            class="valor"
                            value="<?= $formatar($formatarCPF($cpfNumeros)); ?>"
                            readonly
                        >

                        <input
                            type="text"
                            id="cpfEdit"
                            class="campo-edicao"
                            name="cpf"
                            value="<?= $formatar($formatarCPF($cpfNumeros)); ?>"
                            maxlength="14"
                            placeholder="000.000.000-00"
                            inputmode="numeric"
                            autocomplete="off"
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <th>Telefone</th>
                    <td>
                        <span class="valor" id="telefoneField">
                            <?= $formatar($doador['telefone']); ?>
                        </span>

                        <input
                            class="campo-edicao"
                            type="tel"
                            id="telefoneEdit"
                            name="telefone"
                            value="<?= $formatar($doador['telefone']); ?>"
                            maxlength="15"
                            placeholder="(00) 00000-0000"
                            inputmode="numeric"
                            autocomplete="tel"
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['email']); ?></span>
                        <input class="campo-edicao" type="email" name="email" value="<?= $formatar($doador['email']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>Endereço</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['endereco']); ?></span>
                        <input class="campo-edicao" type="text" name="endereco" value="<?= $formatar($doador['endereco']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>Número</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['numero']); ?></span>
                        <input class="campo-edicao" type="text" name="numero" value="<?= $formatar($doador['numero']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>CEP</th>
                    <td>
                        <span class="valor"><?= $formatar($formatarCEP($cepNumeros)); ?></span>

                        <input
                            class="campo-edicao"
                            type="text"
                            id="cepEdit"
                            name="cep"
                            value="<?= $formatar($formatarCEP($cepNumeros)); ?>"
                            maxlength="9"
                            placeholder="00000-000"
                            inputmode="numeric"
                            autocomplete="postal-code"
                            required
                        >

                        <small id="cepStatus" class="cep-status"></small>
                    </td>
                </tr>

                <tr>
                    <th>Complemento</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['complemento']); ?></span>
                        <input class="campo-edicao" type="text" name="complemento" value="<?= $formatar($doador['complemento']); ?>">
                    </td>
                </tr>

                <tr>
                    <th>Bairro</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['bairro']); ?></span>
                        <input class="campo-edicao" type="text" name="bairro" value="<?= $formatar($doador['bairro']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <th>Nascimento</th>
                    <td>
                        <span class="valor">
                            <?= !empty($doador['nasc']) ? (new DateTime($doador['nasc']))->format('d/m/Y') : ''; ?>
                        </span>
                        <input
                            class="campo-edicao"
                            type="date"
                            name="nasc"
                            value="<?= $formatar($doador['nasc']); ?>"
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <th>Tipo Sanguíneo</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['tipo_sangue'] ?? ''); ?></span>

                        <select class="campo-edicao" name="tipo_sangue_id" required>
                            <?php foreach ($tiposSangue as $tipo): ?>
                                <option
                                    value="<?= (int) $tipo['id']; ?>"
                                    <?= (int) $tipo['id'] === (int) $doador['tipo_sangue_id'] ? 'selected' : ''; ?>
                                >
                                    <?= $formatar($tipo['tipo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>Peso</th>
                    <td>
                        <span class="valor"><?= $formatar($doador['peso']); ?></span>
                        <input
                            class="campo-edicao"
                            type="number"
                            name="peso"
                            min="1"
                            step="0.1"
                            value="<?= $formatar($doador['peso']); ?>"
                            required
                        >
                    </td>
                </tr>

            </table>

        </div>

        <div class="doador-detalhes-voltar">

            <a href="?rota=doadores" class="doador-detalhes-btn">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>

            <button
                type="button"
                id="btnHabilitarEdicao"
                class="doador-detalhes-btn"
                onclick="habilitarEdicao()"
            >
                <i class="fas fa-edit"></i> Habilitar edição
            </button>

            <button
                type="submit"
                id="btnSalvar"
                class="doador-detalhes-btn btn-salvar"
            >
                <i class="fas fa-save"></i> Salvar alterações
            </button>

            <button
                type="button"
                id="btnCancelarEdicao"
                class="doador-detalhes-btn btn-cancelar"
                onclick="cancelarEdicao()"
            >
                <i class="fas fa-times"></i> Cancelar
            </button>

            <a
                href="?rota=excluir&id=<?= (int) $doador['id']; ?>"
                class="doador-detalhes-btn btn-excluir"
                onclick="return confirm('Tem certeza que deseja excluir este doador?');"
            >
                <i class="fas fa-trash-alt"></i> Excluir
            </a>

            <button
                type="button"
                class="doador-detalhes-btn imprimir-btn"
                onclick="printTable()"
            >
                <i class="fas fa-print"></i> Imprimir
            </button>

            <button
                type="button"
                class="doador-detalhes-btn btn-exibir-cpf"
                onclick="toggleCpfVisibility(this)"
            >
                <i class="fas fa-eye"></i> Mostrar CPF
            </button>

        </div>

    </form>

</div>

<script>
(function () {
    const container = document.querySelector('.doador-detalhes-container');
    const formulario = document.getElementById('formDoador');

    const campoCPF = document.getElementById('cpfEdit');
    const cpfField = document.getElementById('cpfField');
    const campoCEP = document.getElementById('cepEdit');
    const campoTelefone = document.getElementById('telefoneEdit');
    const cepStatus = document.getElementById('cepStatus');

    if (
        !container ||
        !formulario ||
        !campoCPF ||
        !campoCEP ||
        !campoTelefone
    ) {
        console.error('Não foi possível localizar os campos do formulário do doador.');
        return;
    }

    function somenteNumeros(valor) {
        return valor.replace(/\D/g, '');
    }

    function aplicarMascaraCPF(valor) {
        const numeros = somenteNumeros(valor).slice(0, 11);

        return numeros
            .replace(/^(\d{3})(\d)/, '$1.$2')
            .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
            .replace(/\.(\d{3})(\d)/, '.$1-$2');
    }

    function aplicarMascaraCEP(valor) {
        const numeros = somenteNumeros(valor).slice(0, 8);

        if (numeros.length > 5) {
            return numeros.slice(0, 5) + '-' + numeros.slice(5);
        }

        return numeros;
    }

    function aplicarMascaraTelefone(valor) {
        const numeros = somenteNumeros(valor).slice(0, 11);

        if (numeros.length === 0) {
            return '';
        }

        if (numeros.length <= 2) {
            return '(' + numeros;
        }

        if (numeros.length <= 6) {
            return '(' + numeros.slice(0, 2) + ') ' + numeros.slice(2);
        }

        if (numeros.length <= 10) {
            return '(' + numeros.slice(0, 2) + ') ' +
                numeros.slice(2, 6) + '-' +
                numeros.slice(6);
        }

        return '(' + numeros.slice(0, 2) + ') ' +
            numeros.slice(2, 7) + '-' +
            numeros.slice(7);
    }

    function validarCPF(valor) {
        const cpf = somenteNumeros(valor);

        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let soma = 0;

        for (let i = 0; i < 9; i++) {
            soma += Number(cpf[i]) * (10 - i);
        }

        let resto = (soma * 10) % 11;
        let digito1 = resto === 10 ? 0 : resto;

        if (digito1 !== Number(cpf[9])) {
            return false;
        }

        soma = 0;

        for (let i = 0; i < 10; i++) {
            soma += Number(cpf[i]) * (11 - i);
        }

        resto = (soma * 10) % 11;
        let digito2 = resto === 10 ? 0 : resto;

        return digito2 === Number(cpf[10]);
    }

    function aplicarMascarasIniciais() {
        campoCPF.value = aplicarMascaraCPF(campoCPF.value);
        campoCEP.value = aplicarMascaraCEP(campoCEP.value);
        campoTelefone.value = aplicarMascaraTelefone(campoTelefone.value);

        if (cpfField) {
            cpfField.value = aplicarMascaraCPF(cpfField.value);
        }
    }

    window.habilitarEdicao = function () {
        container.classList.add('modo-edicao');
        aplicarMascarasIniciais();
    };

    window.cancelarEdicao = function () {
        formulario.reset();
        aplicarMascarasIniciais();

        container.classList.remove('modo-edicao');

        if (cepStatus) {
            cepStatus.textContent = '';
        }
    };

    window.toggleCpfVisibility = function (buttonElement) {
        if (!cpfField) {
            return;
        }

        if (cpfField.type === 'password') {
            cpfField.type = 'text';

            buttonElement.innerHTML =
                '<i class="fas fa-eye-slash"></i> Esconder CPF';
        } else {
            cpfField.type = 'password';

            buttonElement.innerHTML =
                '<i class="fas fa-eye"></i> Mostrar CPF';
        }
    };

    campoCPF.addEventListener('input', function () {
        this.value = aplicarMascaraCPF(this.value);
    });

    campoCEP.addEventListener('input', function () {
        this.value = aplicarMascaraCEP(this.value);

        if (cepStatus) {
            cepStatus.textContent = '';
        }

        if (somenteNumeros(this.value).length === 8) {
            buscarCEP();
        }
    });

    campoTelefone.addEventListener('input', function () {
        this.value = aplicarMascaraTelefone(this.value);
    });

    let consultaEmAndamento = false;
    let ultimoCEPConsultado = '';

    async function buscarCEP() {
        const cep = somenteNumeros(campoCEP.value);

        if (
            cep.length !== 8 ||
            consultaEmAndamento ||
            cep === ultimoCEPConsultado
        ) {
            return;
        }

        consultaEmAndamento = true;
        ultimoCEPConsultado = cep;

        if (cepStatus) {
            cepStatus.textContent = 'Consultando CEP...';
        }

        try {
            const resposta = await fetch(
                'https://viacep.com.br/ws/' + cep + '/json/'
            );

            if (!resposta.ok) {
                throw new Error('Falha na consulta do CEP.');
            }

            const dados = await resposta.json();

            if (somenteNumeros(campoCEP.value) !== cep) {
                return;
            }

            if (dados.erro) {
                if (cepStatus) {
                    cepStatus.textContent = 'CEP não encontrado.';
                }

                ultimoCEPConsultado = '';
                return;
            }

            formulario.querySelector('[name="endereco"]').value =
                dados.logradouro || '';

            formulario.querySelector('[name="bairro"]').value =
                dados.bairro || '';

            if (dados.complemento) {
                formulario.querySelector('[name="complemento"]').value =
                    dados.complemento;
            }

            if (cepStatus) {
                cepStatus.textContent = 'Endereço localizado com sucesso.';
            }

        } catch (erro) {
            console.error('Erro ao consultar ViaCEP:', erro);

            if (cepStatus) {
                cepStatus.textContent =
                    'Não foi possível consultar o CEP. Verifique sua conexão.';
            }

            ultimoCEPConsultado = '';

        } finally {
            consultaEmAndamento = false;
        }
    }

    campoCEP.addEventListener('blur', buscarCEP);

    formulario.addEventListener('submit', function (event) {
        if (!validarCPF(campoCPF.value)) {
            event.preventDefault();

            alert('CPF inválido. Confira os números informados.');

            campoCPF.focus();
            return;
        }

        const cep = somenteNumeros(campoCEP.value);

        if (cep.length !== 8) {
            event.preventDefault();

            alert('Informe um CEP válido com 8 números.');

            campoCEP.focus();
            return;
        }

        const telefone = somenteNumeros(campoTelefone.value);

        if (telefone.length !== 10 && telefone.length !== 11) {
            event.preventDefault();

            alert('Informe um telefone válido com DDD.');

            campoTelefone.focus();
            return;
        }

        campoCPF.value = somenteNumeros(campoCPF.value);
        campoCEP.value = cep;
        campoTelefone.value = telefone;
    });

    aplicarMascarasIniciais();

    window.printTable = function () {
        const printContent =
            document.getElementById('printTable').outerHTML;

        const janela = window.open('', '', 'width=900,height=700');

        if (!janela) {
            alert('Não foi possível abrir a janela de impressão.');
            return;
        }

        janela.document.write(`
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <title>Detalhes do Doador</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th, td {
                        border: 1px solid #ccc;
                        padding: 10px;
                        text-align: left;
                    }

                    th {
                        background: #eaeaea;
                        width: 30%;
                    }
                </style>
            </head>
            <body>
                <h2 style="text-align:center;">Detalhes do Doador</h2>
                ${printContent}
            </body>
            </html>
        `);

        janela.document.close();
        janela.focus();
        janela.print();
        janela.close();
    };
})();
</script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
>

<style>

.doador-detalhes-container {
    max-width: 100%;
    margin: 30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
}

.doador-detalhes-titulo {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-size: 26px;
}

.doador-detalhes-tabela-container {
    width: 100%;
    overflow: hidden;
}

.doador-detalhes-tabela {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    table-layout: fixed;
}

.doador-detalhes-tabela th,
.doador-detalhes-tabela td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
    vertical-align: middle;
    overflow-wrap: break-word;
    box-sizing: border-box;
}

.doador-detalhes-tabela th {
    background-color: #eaeaea;
    color: #333;
    width: 30%;
}

.doador-detalhes-tabela td {
    height: 43px;
}

.doador-detalhes-tabela input,
.doador-detalhes-tabela select {
    width: 100%;
    max-width: 100%;
    height: 32px;
    padding: 5px 7px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-family: inherit;
    font-size: inherit;
}

.campo-edicao {
    display: none;
    margin: 0;
}

.modo-edicao .valor {
    display: none;
}

.modo-edicao .campo-edicao {
    display: block;
}

.cep-status {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #555;
}

.doador-detalhes-voltar {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 25px;
}

.doador-detalhes-voltar .doador-detalhes-btn {
    display: inline-flex;
    flex: 0 0 auto;
    width: auto;
    min-width: 150px;
    height: 45px;
    margin: 0;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
}

.doador-detalhes-btn {
    background-color: #007BFF;
    cursor: pointer;
    color: white;
    padding: 10px 25px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.2s ease;
    line-height: 1;
    font-size: 14px;
}

.doador-detalhes-btn:hover {
    background-color: #0056b3;
}

.btn-exibir-cpf,
.btn-excluir,
.btn-cancelar {
    background-color: #dc3545;
}

.btn-exibir-cpf:hover,
.btn-excluir:hover,
.btn-cancelar:hover {
    background-color: #a71d2a;
}

.btn-salvar {
    background-color: #28a745;
}

.btn-salvar:hover {
    background-color: #218838;
}

.doador-detalhes-btn.imprimir-btn {
    background-color: #28a745;
}

.doador-detalhes-btn.imprimir-btn:hover {
    background-color: #218838;
}

.doador-detalhes-btn i {
    margin-right: 8px;
}

.doador-detalhes-erro {
    text-align: center;
    color: red;
    font-weight: bold;
    margin-top: 30px;
}

.doador-detalhes-container button,
.doador-detalhes-container a,
.doador-detalhes-container [role="button"] {
    cursor: pointer;
}

#btnHabilitarEdicao {
    display: inline-flex;
}

#btnSalvar,
#btnCancelarEdicao {
    display: none;
}

.modo-edicao #btnHabilitarEdicao {
    display: none;
}

.modo-edicao #btnSalvar,
.modo-edicao #btnCancelarEdicao {
    display: inline-flex;
}

@media (max-width: 600px) {

    .doador-detalhes-titulo {
        font-size: 22px;
    }

    .doador-detalhes-tabela {
        font-size: 12px;
    }

    .doador-detalhes-tabela th,
    .doador-detalhes-tabela td {
        padding: 8px;
    }

    .doador-detalhes-btn {
        padding: 8px 20px;
        font-size: 14px;
    }
}

@media (max-width: 1000px) {

    .doador-detalhes-voltar {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    .doador-detalhes-voltar .doador-detalhes-btn {
        width: auto;
    }
}

@media (max-width: 315px) {

    .doador-detalhes-container {
        padding: 10px;
    }

    .doador-detalhes-titulo {
        font-size: 20px;
    }

    .doador-detalhes-tabela {
        font-size: 10px;
    }

    .doador-detalhes-tabela th,
    .doador-detalhes-tabela td {
        padding: 6px;
    }

    .doador-detalhes-btn {
        padding: 6px 15px;
        font-size: 12px;
    }
}

@media print {

    .campo-edicao,
    .doador-detalhes-voltar,
    .cep-status {
        display: none !important;
    }
}

</style>

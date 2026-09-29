# SCBST - Sistema de Controle de Banco de Sangue Interno

O **SCBST** é uma aplicação web desenvolvida para otimizar o gerenciamento interno de doadores, registros de doações e movimentações de estoque (entradas e retiradas) destinadas a Unidades Básicas de Saúde (UBS). 

O sistema conta com uma interface polida, utilizando conceitos contemporâneos de design de componentes, tipografia limpa, tabelas em formato de cards com sombreamento e botões padronizados para garantir uma excelente experiência de uso.

---

## Tecnologias Utilizadas

O projeto foi construído seguindo o padrão de arquitetura **MVC (Model-View-Controller)**, utilizando tecnologias puras para melhor performance e controle de código:

- **PHP 8 (Puro):** Responsável por toda a lógica de negócios, rotas do sistema, autenticação e gerenciamento de sessões no servidor.
- **JavaScript (ES6):** Utilizado para validações em tempo real, manipulação de efeitos (como transições de tela) e interações dinâmicas.
- **Bootstrap 5:** Framework utilizado como base estrutural para acelerar a responsividade e a malha de layout.
- **HTML5 & CSS3:** Customização profunda da identidade visual do sistema (incluindo o painel de login, menus flutuantes dinâmicos e tipografia baseada no ecossistema moderno Segoe UI/Roboto).
- **XAMPP:** Ambiente de desenvolvimento local contendo o servidor Apache e o banco de dados MySQL integrados.

---

## Funcionalidades Principais

### Autenticação & Segurança
- Tela de login segura com controle de sessões e níveis de acesso para administradores na visualização de funcionários.
- Design minimalista com identificação em etiqueta no canto superior do painel.

### Gerenciamento de Doadores
- Cadastro completo de doadores com validação de dados.
- Listagem de doadores em formato de cards flutuantes com sistema de busca dinâmica.
- Alertas visuais integrados para doadores que já cumpriram o intervalo regulamentar e estão aptos para uma nova doação.

### Estoque & Movimentações
- **Painel de Dashboard:** Gráficos e indicadores indicando a situação de cada tipo sanguíneo em tempo real.
- **Registrar Doação:** Entrada de bolsas de sangue associando o doador.
- **Registrar Retirada:** Saída controlada de bolsas de sangue destinadas a UBS solicitantes, com campo para observações.

---

## Como Executar o Projeto Localmente

Para rodar este sistema na sua máquina, você precisará do **XAMPP** (ou qualquer servidor local Apache + MySQL que suporte PHP 8).

### 1. Clonar ou Copiar o Projeto
Baixe os arquivos do projeto e coloque-os dentro do diretório de aplicações do XAMPP:
- No Windows: `C:\xampp\htdocs\SistemaBS`

### 2. Configurar o Banco de Dados
1. Abra o XAMPP Control Panel e ative os módulos Apache e MySQL.
2. Acesse o painel de gerenciamento no navegador: `http://localhost/phpmyadmin/`.
3. Crie um novo banco de dados (ex: `sistema_bs`).
4. Importe o arquivo `.sql` do banco de dados (localizado na pasta `/Database` ou raiz do projeto).

### 3. Ajustar Configurações de Conexão
Se necessário, altere as credenciais de banco de dados no arquivo de configuração do sistema (como `config.php` ou classe de conexão da sua pasta `Models`).

### 4. Acessar o Sistema
Abra o navegador de sua preferência e digite o endereço:
```text
http://localhost/SistemaBS/public/index.php
```
*Nota: Certifique-se de que a URL corresponde à pasta exata do seu projeto.*

---

## Padrões Visuais Implementados
- **Tipografia:** Uso universal da família de fontes 'Segoe UI', trazendo legibilidade corporativa.
- **Componentização:** Botões com cantos ligeiramente arredondados (5px), texto em caixa alta e bordas pretas finas de 1px para um visual moderno e limpo.
- **Menus Inteligentes:** Submenus (dropdowns) responsivos, com efeito de sombreamento projetado que evita a quebra de linhas em telas menores.

---
Desenvolvido para gestão e controle interno de saúde.

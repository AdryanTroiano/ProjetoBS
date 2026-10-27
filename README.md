# SCBST — Sistema de Controle de Banco de Sangue Interno

O **SCBST (Sistema de Controle de Banco de Sangue Interno)** é um sistema desenvolvido para auxiliar no gerenciamento interno de um banco de sangue.

O projeto é composto por uma **aplicação web** e uma **aplicação mobile**, organizadas dentro do mesmo projeto. O sistema permite realizar o gerenciamento de doadores, doações, retiradas, estoque sanguíneo, Unidades Básicas de Saúde (UBS) e usuários.

A aplicação web utiliza a arquitetura **MVC (Model-View-Controller)**, separando as responsabilidades entre Models, Views e Controllers, facilitando a organização, manutenção e evolução do código.

---

# Tecnologias utilizadas

## Aplicação Web

- **PHP 8.2.12** — backend, regras de negócio, autenticação, sessões, Controllers e comunicação com o banco de dados.
- **MySQL** — banco de dados relacional utilizado pelo sistema.
- **PDO (PHP Data Objects)** — comunicação entre PHP e MySQL utilizando Prepared Statements.
- **HTML5** — estrutura das páginas.
- **CSS3** — estilização e responsividade da interface.
- **JavaScript (ES6)** — validações, máscaras e interações no frontend.
- **Bootstrap 5** — apoio à estrutura e responsividade da interface.
- **Apache 2.4.58** — servidor HTTP utilizado no ambiente local.
- **XAMPP** — ambiente de desenvolvimento contendo Apache, PHP e MySQL.
- **phpMyAdmin** — administração do banco de dados durante o desenvolvimento.

## Aplicação Mobile

A aplicação mobile utiliza tecnologias baseadas em:

- **React Native**
- **Expo**
- **Expo Router**
- **TypeScript**
- **Node.js**
- **Express**
- **MySQL**

O backend mobile é responsável pela disponibilização de endpoints utilizados na comunicação entre o aplicativo e os dados do sistema.

---

# Estrutura do projeto

A estrutura principal do projeto está organizada da seguinte maneira:

```text
ProjetoBS/
│
├── mobile/
│   │
│   ├── backend/
│   ├── projetovalidacao/
│   ├── .gitignore
│   ├── bstq.sql
│   ├── package-lock.json
│   └── package.json
│
├── web/
│   │
│   ├── api/
│   │
│   ├── app/
│   │   ├── controllers/
│   │   ├── core/
│   │   ├── middleware/
│   │   ├── models/
│   │   └── views/
│   │       ├── auth/
│   │       ├── doadores/
│   │       ├── doacoes/
│   │       ├── retiradas/
│   │       ├── ubs/
│   │       ├── usuarios/
│   │       └── layouts/
│   │
│   ├── config/
│   ├── public/
│   │   ├── css/
│   │   ├── images/
│   │   ├── js/
│   │   └── index.php
│   │
│   ├── routes/
│   └── README.md
```

---

# Aplicação Web

A aplicação web está localizada em:

```text
ProjetoBS/web/
```

Considerando o projeto dentro do diretório `htdocs` do XAMPP:

```text
C:\xampp\htdocs\ProjetoBS\web\
```

A aplicação utiliza a arquitetura **MVC (Model-View-Controller)**.

---

# Arquitetura MVC

## Controllers

Os Controllers são responsáveis por receber as requisições e realizar a comunicação entre as regras da aplicação, Models e Views.

Caminho relativo:

```text
web/app/controllers/
```

Caminho local:

```text
C:\xampp\htdocs\ProjetoBS\web\app\controllers\
```

Entre os principais Controllers estão:

```text
AuthController.php
DashboardController.php
DoadorController.php
DoacaoController.php
EstoqueController.php
RetiradaController.php
UbsController.php
UsuarioController.php
```

---

## Models

Os Models são responsáveis principalmente pela comunicação com o banco de dados.

Caminho relativo:

```text
web/app/models/
```

Caminho local:

```text
C:\xampp\htdocs\ProjetoBS\web\app\models\
```

Entre os Models utilizados estão:

```text
Doador.php
Doacao.php
Retirada.php
Ubs.php
Usuario.php
```

A comunicação com o MySQL é realizada através do **PDO**.

---

## Views

As Views são responsáveis pelas interfaces apresentadas aos usuários.

Caminho relativo:

```text
web/app/views/
```

Caminho local:

```text
C:\xampp\htdocs\ProjetoBS\web\app\views\
```

As Views são organizadas de acordo com os módulos da aplicação:

```text
auth/
doadores/
doacoes/
retiradas/
ubs/
usuarios/
layouts/
```

---

## Core

Os componentes centrais da arquitetura estão localizados em:

```text
web/app/core/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\app\core\
```

Entre eles está o sistema de carregamento automático de classes:

```text
web/app/core/autoload.php
```

O Autoload permite localizar automaticamente classes presentes principalmente em:

```text
app/controllers/
app/models/
app/middleware/
app/core/
```

---

## Middleware

Os Middlewares estão localizados em:

```text
web/app/middleware/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\app\middleware\
```

O controle de autenticação e autorização da aplicação é realizado principalmente através de:

```text
web/app/middleware/AuthMiddleware.php
```

---

# Entrada da aplicação

O ponto de entrada da aplicação web é:

```text
web/public/index.php
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\public\index.php
```

O `index.php` inicializa o fluxo da aplicação e carrega as rotas responsáveis pelo direcionamento das requisições.

---

# Arquivos públicos

Os arquivos que precisam ser acessíveis pelo navegador ficam dentro de:

```text
web/public/
```

A estrutura inclui:

```text
public/
├── css/
├── images/
├── js/
└── index.php
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\public\
```

A pasta `public` funciona como ponto público da aplicação web.

---

# Rotas

As rotas da aplicação estão localizadas em:

```text
web/routes/web.php
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\routes\web.php
```

O arquivo de rotas é responsável por direcionar as requisições para seus respectivos Controllers.

Entre as rotas utilizadas estão:

```text
index.php?rota=login
index.php?rota=dashboard
index.php?rota=doadores
index.php?rota=nova-doacao
index.php?rota=doacoes
index.php?rota=nova-retirada
index.php?rota=retiradas
index.php?rota=ubs
index.php?rota=usuarios
```

---

# Configuração do banco de dados

A configuração da conexão utilizada pela aplicação web está localizada em:

```text
web/config/database.php
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\config\database.php
```

A conexão com o MySQL é realizada através do **PDO**.

Durante o desenvolvimento local, o sistema utiliza:

```text
Host: localhost
Banco: BSTQ
Usuário: root
Senha: vazia
```

As credenciais devem ser alteradas quando o projeto for publicado em um ambiente de produção.

---

# Banco de dados

O banco utilizado pelo projeto é:

```text
BSTQ
```

O arquivo SQL está localizado em:

```text
ProjetoBS/mobile/bstq.sql
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\mobile\bstq.sql
```

Entre as principais tabelas utilizadas pelo sistema estão:

```text
doadores
usuarios
ubs
doacoes
retiradas
estoque_sangue
tipos_sangue
logs_estoque
```

---

# Funcionalidades

## Autenticação

O sistema possui autenticação baseada em sessão.

Após a autenticação, as informações necessárias do usuário são armazenadas na sessão e utilizadas durante a navegação pelo sistema.

O SCBST possui níveis de acesso, incluindo:

```text
admin
padrao
```

O nível de acesso determina quais funcionalidades administrativas podem ser utilizadas.

---

# Dashboard

O Dashboard apresenta uma visão geral da situação atual do banco de sangue.

Através dele é possível acompanhar informações relacionadas ao estoque dos diferentes tipos sanguíneos cadastrados no sistema.

O Dashboard utiliza os dados armazenados no banco para apresentar as condições atuais do estoque.

---

# Gerenciamento de doadores

O módulo de doadores permite realizar operações como:

- Cadastrar doadores.
- Listar doadores cadastrados.
- Pesquisar doadores.
- Visualizar informações individuais.
- Editar informações.
- Validar doadores.
- Excluir registros quando permitido.
- Consultar o tipo sanguíneo.
- Acompanhar informações relacionadas às doações.

Entre os dados utilizados pelo cadastro estão informações pessoais e dados necessários para o controle interno do banco de sangue.

---

# Registro de doações

O sistema permite registrar doações de **Sangue Total**.

Cada registro de doação pode relacionar informações como:

- Doador.
- UBS.
- Data da doação.
- Quantidade em mililitros.

Atualmente, o SCBST trabalha exclusivamente com:

```text
Sangue Total
```

Ao registrar uma nova doação, a quantidade informada é adicionada ao estoque correspondente ao tipo sanguíneo do doador.

O registro da doação também permite manter atualizada a informação referente à última doação realizada pelo doador.

---

# Tipos sanguíneos

O estoque é separado de acordo com os principais tipos sanguíneos:

```text
A+
A-
B+
B-
AB+
AB-
O+
O-
```

Cada tipo possui seu próprio controle de quantidade disponível.

---

# Controle de estoque

O módulo de estoque controla as quantidades de **Sangue Total** disponíveis para cada tipo sanguíneo.

As entradas de estoque são realizadas através do registro das doações.

O fluxo simplificado é:

```text
Doador
    ↓
Doação de Sangue Total
    ↓
Tipo sanguíneo do doador
    ↓
Entrada no estoque
```

As retiradas representam as saídas do estoque.

```text
Estoque
    ↓
Retirada
    ↓
UBS de destino
```

Dessa forma, o sistema mantém o controle das quantidades disponíveis.

---

# Registro de retiradas

O módulo de retiradas permite registrar saídas de Sangue Total do estoque.

Uma retirada contém informações como:

- Tipo sanguíneo.
- Quantidade em mililitros.
- Data.
- UBS de destino.
- Observação.

Antes de realizar uma retirada, o sistema verifica se existe quantidade suficiente disponível para o tipo sanguíneo selecionado.

Caso o estoque seja suficiente, a retirada é registrada e a quantidade correspondente é descontada.

O sistema também possui registros de movimentação para auxiliar no controle das alterações realizadas no estoque.

---

# Gerenciamento de UBS

O sistema permite administrar as Unidades Básicas de Saúde relacionadas às movimentações.

Cada UBS pode possuir:

- Nome.
- Telefone.
- E-mail.
- Responsável pela unidade.
- Cidade.

Entre as operações disponíveis estão:

- Cadastrar UBS.
- Listar UBS.
- Visualizar informações.
- Editar UBS.
- Excluir UBS quando permitido.

Uma UBS que já possua vínculos com determinadas doações ou retiradas possui proteção contra exclusão indevida.

---

# Gerenciamento de usuários

O módulo administrativo permite o gerenciamento dos usuários responsáveis pela utilização do sistema.

Entre as operações disponíveis estão:

- Cadastrar usuário.
- Listar usuários.
- Visualizar informações.
- Editar usuário.
- Alterar senha.
- Excluir usuário quando permitido.

As funcionalidades administrativas são protegidas de acordo com o nível de acesso.

---

# Fluxo da aplicação Web

O fluxo básico de uma requisição é:

```text
Navegador
    ↓
web/public/index.php
    ↓
web/routes/web.php
    ↓
Controller
    ↓
Model
    ↓
MySQL
```

Quando uma página precisa ser apresentada:

```text
Controller
    ↓
View
    ↓
Layout
    ↓
Navegador
```

Essa estrutura mantém separadas as responsabilidades de cada parte da aplicação.

---

# Aplicação Mobile

A aplicação mobile está localizada em:

```text
ProjetoBS/mobile/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\mobile\
```

A estrutura possui principalmente:

```text
mobile/
├── backend/
└── projetovalidacao/
```

---

## Backend Mobile

O backend está localizado em:

```text
ProjetoBS/mobile/backend/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\mobile\backend\
```

Ele utiliza tecnologias como:

```text
Node.js
Express
TypeScript
MySQL
```

Sua função é disponibilizar serviços utilizados pelo aplicativo para comunicação com os dados do sistema.

---

## Aplicação Mobile

A aplicação está localizada em:

```text
ProjetoBS/mobile/projetovalidacao/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\mobile\projetovalidacao\
```

A aplicação utiliza:

```text
React Native
Expo
Expo Router
TypeScript
```

---

# API

A aplicação web possui o diretório:

```text
web/api/
```

No ambiente local:

```text
C:\xampp\htdocs\ProjetoBS\web\api\
```

A API é destinada à disponibilização de endpoints para integração com outras aplicações.

A utilização de APIs permite que aplicações externas, incluindo a aplicação mobile, possam interagir com o sistema sem realizar acesso direto ao banco MySQL.

---

# Como executar o projeto localmente

## 1. Instalar o XAMPP

Instale o XAMPP contendo suporte a:

```text
Apache
PHP 8.2.12
MySQL
```

Depois abra o **XAMPP Control Panel** e inicie:

```text
Apache
MySQL
```

---

## 2. Adicionar o projeto ao XAMPP

O projeto deve estar dentro do diretório `htdocs`.

Estrutura utilizada:

```text
C:\xampp\htdocs\ProjetoBS\
```

A aplicação web estará em:

```text
C:\xampp\htdocs\ProjetoBS\web\
```

---

## 3. Criar o banco de dados

Acesse o phpMyAdmin:

```text
http://localhost/phpmyadmin/
```

Crie um banco chamado:

```text
BSTQ
```

---

## 4. Importar o banco

Importe o arquivo:

```text
C:\xampp\htdocs\ProjetoBS\mobile\bstq.sql
```

para o banco:

```text
BSTQ
```

Isso criará a estrutura necessária para utilização do sistema.

---

## 5. Configurar a conexão

Confira o arquivo:

```text
C:\xampp\htdocs\ProjetoBS\web\config\database.php
```

No ambiente padrão utilizado durante o desenvolvimento:

```text
Host: localhost
Banco: BSTQ
Usuário: root
Senha: vazia
```

Caso seu MySQL possua configurações diferentes, altere os dados de conexão.

---

## 6. Acessar a aplicação Web

O ponto público da aplicação é:

```text
web/public/
```

No ambiente local, o acesso pode ser realizado através de:

```text
http://localhost/ProjetoBS/web/public/
```

---

# Segurança e boas práticas

O projeto utiliza práticas como:

- Arquitetura MVC.
- Programação orientada a objetos.
- Autenticação baseada em sessão.
- Controle de acesso por nível de usuário.
- PDO.
- Prepared Statements.
- Validação de dados no backend.
- Escape de dados apresentados nas Views.
- Separação entre arquivos públicos e internos.
- Verificação de estoque antes de registrar retiradas.
- Controle de vínculos antes da exclusão de determinados registros.
- Organização das responsabilidades em Controllers, Models e Views.

---

# Preparação para produção

A aplicação web está organizada para utilizar:

```text
web/public/
```

como ponto público de entrada.

Em um ambiente de produção, o ideal é configurar o servidor para utilizar essa pasta como **DocumentRoot**, quando a hospedagem permitir.

Diretórios internos como:

```text
web/app/
web/config/
web/routes/
```

não devem ficar diretamente expostos através do navegador.

As credenciais locais do banco:

```text
root
senha vazia
```

também devem ser substituídas pelas credenciais fornecidas pelo servidor de hospedagem.

---

# Objetivo do projeto

O SCBST foi desenvolvido com o objetivo de aplicar conceitos de desenvolvimento de sistemas em uma solução voltada ao controle interno de banco de sangue.

O projeto envolve conceitos como:

- PHP 8.2.12.
- Arquitetura MVC.
- Programação orientada a objetos.
- Banco de dados relacional.
- CRUD.
- Autenticação e autorização.
- Controle de estoque.
- API.
- Aplicação mobile.
- Validação de dados.
- Integração entre frontend, backend e banco de dados.
- Organização de código.
- Preparação de uma aplicação para ambiente de produção.

---

# SCBST

**Sistema de Controle de Banco de Sangue Interno**

Projeto composto por aplicações **Web e Mobile**, desenvolvido para auxiliar no gerenciamento interno de:

- Doadores.
- Doações de Sangue Total.
- Estoque por tipo sanguíneo.
- Retiradas.
- Unidades Básicas de Saúde.
- Usuários e níveis de acesso.

O SCBST busca centralizar essas operações em um único sistema, facilitando o acompanhamento e o controle das movimentações realizadas no banco de sangue.
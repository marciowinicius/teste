<p align="center"><img src="http://site.federalst.com.br/fsmail.jpg"></p>


# Teste prático - Federal Soluções Técnicas

Esse é o teste prático - Federal Soluções Técnicas

# Objetivos
  - Conhecer as habilidades em:
    - Programação PHP/Laravel (Conhecimentos básicos sobre Laravel)
    - Organização (código/arquivos)
    - Controle de versão
    - Análise/Entendimento de requisitos
    - Capacidade de cumprir prazos
    - Determinação na busca novos conhecimentos

# Atenção
  - Tudo que for desenvolvido nesse teste não será comercializado ou utilizado comercialmente pela Federal ST ou algum de seus associados.
  - A única intenção é avaliar o conhecimento atual do candidato

# Aplicação
Você deverá desenvolver uma simples aplicação, com Login e nível de acesso simples.
O administrador do sistema deverá realizar a manutenção de veículos. Os dados para a tabela de veículos são:

 - Placa
 - Renavam
 - Modelo
 - Marca
 - Ano
 - Proprietário
 
- Todas as vezes que um veículo for cadastrado ou editado, deverá ser enviado um e-mail para o proprietário.
- O e-mail do proprietário deverá ser buscado na tabela de usuários.
- O CRUD do véiculo deverá ficar em uma área de administração. O proprietário não poderá ter acesso a essa área. 
- Deverá haver uma área destinada ao proprietário. O proprietário deverá ser capaz de visualizar todos os seus véiculos. Ele não pode editar, excluir ou cadastrar novos veículos... apenas visualizar.

### Usuários
Existem dois tipos diferentes de usuários na aplicação:
- Admin
- User

### Requisitos
- [ ] Usar Laravel (TEM QUE SER USADO ESSE PROJETO)
- [ ] Usar banco de dados Postgres
- [ ] Não ter regra de negócio nos Controllers
- [ ] Usar Event e Notifications para enviar os e-mail
- [ ] Deixar informações no README.MD como podemos executar sua aplicação
- [ ] Usar o github 

### Como participar ?
- Fazer o fork desse repositório
- Nos enviar o link do projeto do github

#### Dicas após baixar o projeto:
- Rode as migrations
- Rode as seeders
- Esteja atento aos usuários padrões contidos na Seeder


# Contato
- Email: suporte@federalst.com.br
- Telefone: 62 3928-5910 

Entre em contato conosco, caso você tenha alguma dúvida ou quando terminar o projeto.

# Tempo de execução
- Você tem 2 dias pra realizar esse teste prático.

## SUBMETA SEU PROJETO, MESMO QUE VOCÊ NÃO O TERMINE. NESTE CASO, NOS EXPLIQUE QUAIS FORAM AS SUAS DIFICULDADES.

# Orientações para rodar o projeto


# Oque é necessário ?
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension

# Observações para funcionamento do projeto
> 1 - Faça o clone para seu computador.

> 2 - Crie um banco de dados local com qualquer nome. Sugiro colocar `laravel-teste`

> 3 - Altere .env.example para .env e altere as configurações do banco de dados

> 4 - Aproveite e adquira as dependências do projeto com `composer update`

> 5 - Alterado o .env abra o terminal na pasta do projeto e gere uma key para a aplicação `php artisan key:generate`

> 6 - Aproveite e rode as migrations com `php artisan migrate`

> 7 - Rode também as seeds com `php artisan db:seed`

> 8 - Para rodar o projeto `php artisan serve` que por padrão para acessar a aplicação basta acessar localhost:8000

> OBS: Caso você utilize `php artisan serve` em alguns computadores pode-se ter problemas com os assets localizados na pasta public do projeto.
 Isso são assets de JS/CSS que fazer o front-end da aplicação. Caso você tenha esse problema sugiro criar um virtualhost com o apache. 
 Segue um link para você se orientar em como criar o virtualhost : https://ourcodeworld.com/articles/read/584/how-to-configure-a-virtual-host-for-a-laravel-project-in-xampp-for-windows

# Regras de negócio
> 1 - Um admin pode fazer qualquer alteração e/ou exclusão de dados.

> 2 - Um usuário só pode visualizar veículos que são de sua posse.

> 3 - Para cadastrar, alterar ou excluir um veículo precisa estar logado e ser admin. 

> 4 - Quando um veículo é criado ou alterado é disparado um email para o proprietário do veículo.

> 5 - Um usuário não admin não consegue acessar as rotas para criar, alterar, deletar um veículo.

# OBS:
> Ao rodar o projeto basta acessar a rota '/login' ou só '/' e logar.
> Usuário ADM : admin@teste.com.br/secret
> Usuário teste: samanta92@example.org/secret

> Meu repositório tem 2 branchs uma master e outra develop ... É porque sou acostumado a ter um ambiente de testes, homologação e produção. Tentei reproduzir esse costume aqui. Se a equipe for muito grande acaba que fica melhor esse tipo de coisa.
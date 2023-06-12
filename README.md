# Sistema de Bilheteria - Documentação

## Visão Geral

O Sistema de Bilheteria é uma aplicação web que permite aos usuários comprar ingressos para eventos como shows,
peças de teatro, filmes e outros.
Ele foi desenvolvido utilizando tecnologias modernas e tem como objetivo facilitar a compra de ingressos,
proporcionando uma experiência agradável aos usuários.

## Principais Funcionalidades

O sistema oferece uma variedade de funcionalidades para atender às necessidades dos usuários. 
Algumas das principais funcionalidades incluem:

## Tecnologias Utilizadas

### TailwindCSS: 
O Tailwind CSS é um framework CSS utilitário que permite a construção rápida de interfaces flexíveis e personalizáveis através de classes pré-definidas.
### AlpineJS: 
O Alpine.js é um micro-framework JavaScript que simplifica a interatividade e manipulação do DOM em projetos web.
### Laravel:
Um framework de desenvolvimento web em PHP que facilita a criação de aplicativos web robustos e escaláveis.
### Laravel-Livewire:
Livewire é uma biblioteca do Laravel que permite a criação de interfaces dinâmicas e interativas utilizando componentes de frontend sem a necessidade de escrever código JavaScript.
### PHP:
PHP é uma linguagem de programação de código aberto amplamente utilizada para desenvolvimento web do lado do servidor.
### HTML:
HTML é a linguagem de marcação utilizada para estruturar e exibir o conteúdo das páginas da web.
### MySQL:
MySQL é um sistema de gerenciamento de banco de dados relacional amplamente utilizado e de código aberto.


## Executando o Sistema Localmente
Para configurar e executar o projeto, siga as seguintes etapas:

1. Baixe as dependências do Node.js executando o comando: 
`npm install && npm run dev`
2. Execute as migrações do banco de dados com o comando: 
`php artisan migrate` depois execulte as seeds `php artisan db:seed --class=PermissionSeeder` e `php artisan db:seed`

3. Habilite a configuração de e-mail preenchendo os campos relevantes no arquivo .env.

4. Habilite as configurações do AWS preenchendo as informações necessárias no arquivo .env.

## Contribuição
<a href="https://github.com/VitorSMaia">
    <img style="border-radius: 50%; width: 150px; height: 150px;" src="https://avatars.githubusercontent.com/VitorSMaia" alt="Foto de Perfil">
</a>  

## 📞 Informações de Contato

- **Nome:** João Vitor
- **Telefone:** +55 (11) 91356-4982
- **E-mail:** vitor.smaia1@gmail.com

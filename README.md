# Pré-requisitos do sistema
Antes de começar, verifique se você tem os seguintes programas instalados na sua máquina:

    PHP (versão 7.4 ou superior)
    Composer
    MongoDB

# Clone ou Baixe o projeto 
Abrir o terminal: Abra o terminal ou prompt de comando e navegue até o diretório onde você deseja salvar o projeto.

Clonar o repositório: Execute o seguinte comando para clonar o projeto do GitHub:
```bash
    git clone https://github.com/luanalealvargas/Trabalho_TE_Back-end_II.git
```

# Configuração do Banco de Dados
Este projeto utiliza o MongoDB como banco de dados. Com o MongoDB já instalado localmente na máquina vamos colocar para rodar.

Abrindo o CMD, vamos navegar até o diretório específico, que por padrão é C:\MongoDB\bin. 
```bash
cd C:\MongoDB\bin
```
O MongoDB geralmente pode ser iniciado com o seguinte comando:
```bash
.\mongod.exe --dbpath C:\MongoDB\data\db
```
Isso fará o MongoDB começar a rodar localmente na porta padrão (27017).
Obs: Mantenha esta janela do terminal aberta para que o MongoDB continue rodando.

# Instalar as dependências
Este projeto utiliza o Composer para gerenciar as dependências.
No diretório do projeto: 
```bash
cd C:\Caminho\dorespositório\queestá\oprojeto
```
Execute o comando para instalar as dependências:
```bash
composer install
```
# Rodar o projeto
Agora que tudo está configurado, vamos rodar o projeto localmente.

Rodar o servidor PHP embutido: No terminal, no diretório do projeto, execute o seguinte comando:
```bash
php -S localhost:8080 -t public
```
# Testar a Aplicação Web
Agora que o servidor está rodando, você pode acessar a aplicação através do navegador.

Criar um novo link: Abra o navegador e acesse a URL http://localhost:8080/web/criar. Preencha o formulário com uma URL original e crie um novo link.

Listar links cadastrados: Acesse http://localhost:8080/web/listar para ver os links cadastrados.

Editar um link: Para editar um link, clique no botão de "Editar" ao lado do link na lista.

Deletar um link: Para deletar um link, clique no botão de "Deletar" ao lado do link na lista.

# Testar a Aplicação Insomnia
Agora que o servidor está rodando, você pode testar a aplicação através do insomnia.
Basta importar o arquivo "Insomnia_2024-12-22.json" dentro do insomnia e testar as requisições já prontas.
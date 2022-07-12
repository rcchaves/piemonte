# piemonte
TESTE VAGA PHP FULLSTACK
CANDIDATO: RAMON CÉSAR
DATA: 10/07/2022
GITHUB: https://github.com/rcchaves/piemonte/tree/master
Informações sobre aplicação: API REST desenvolvida em PHP com framework Laravel versão 8.5.9. Banco de dados MySql e Postman client para teste de end-point. O nome do banco de dados é PIEMONTE e o arquivo .sql vai ser enviado junto com  a api, não possui senha e usuário é root. Se quiser testar em outro banco de dados, é só alterar o bando escolhido no arquivo .env do Laravel para padrão. Para o teste deverá ser usado um cliente(postman) requisição no headers tipo json.( Accept/application/json). Utilizei o Vuejs Utilizando o motor de renderização blade do Laravel para consumir a API. Após executar o php artisan serve acessar url http://127.0.0.1:8000/.

PASSOS PARA ACESSAR A APLICAÇÃO:
1-	Após configurar os arquivos em um servidor web. Criar o banco de dados com o nome piemonte. Execute o comando php artisan migrate para criação das tabelas. (o arquivo .sql vai ser enviado).
2-	Ao acessar a rota http://127.0.0.1:8000 existe duas opções uma para cadastrar registros na aplicação e outra para pesquisar. O cadastro possui algumas validações na parte do backend. Tanto no model como no controller. Após o cadastro o registro é carregado na tabela abaixo. Usei os componentes no vue para renderizar os dados na tabela, as requisições são feitas usando axios. Para pesquisar temos as opções de cep e por logradouro seguindo as regras do teste.

3-	Os end-point são:
3-1 Busca por texto:
GET / http://127.0.0.1:8000/api/logra/{UF}/{CIDADE} /{LOGRADORO}
EXEMPLO:  http://127.0.0.1:8000/api/logra/SP/PAULO/CELS

3 -2 Busca por CEP:
GET / http://127.0.0.1:8000/api/search/{CEP} 
EXEMPLO:  http://127.0.0.1:8000/api/search/89229078

3 -3 End-point retorna todos registros do banco
GET / http://127.0.0.1:8000/api/  

3 -4 End-point retorna único registro pelo id
GET / http://127.0.0.1:8000/api/1 

3 -5 End-point para cadastrar registro. Segue imagem com os campos obrigatórios.
POST / http://127.0.0.1:8000/api/

3 -6 End-point para atualizar registro.
PUT/PATH http://127.0.0.1:8000/api/1
 
3 -7 End-point para excluir registro.
DELETE http://127.0.0.1:8000/api/1





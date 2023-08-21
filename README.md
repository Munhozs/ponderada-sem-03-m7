O repositório presente apresenta somente o código desenvolvido para resolução da atividade ponderada da semana 3, tendo presente:

- Aplicação básica SamplePage.php obtida por meio do tutorial desenvolvido pela AWS: https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateWebServer.html

A fim de deixar claro os resultados obtidos, também está presente provas do funcionamento, tanto da Instância EC2, quanto do banco de dados RDS e da aplicação funcional, assim como os dados obtidos na tabela do banco de dados e o vídeo demonstrando todo o percurso:

![ec2 Rodando](/ec2Rodando.png)
A instância EC2 permite que a aplicação WEB seja acessada por meio do DNS público, como o mostrado a seguir: ec2-44-206-80-213.compute-1.amazonaws.com

![RDS Rodando](/RDSRodando.png)
Banco RDS permite com que os dados de compra enviados sejam armazenados com segurança

![Página Web Funcional](/paginaWeb.png)
Aplicação integrada com o banco de dados, como esperado

![Banco de Compra](/bancoCompra.png)
Evidência de que o resultado escrito no input do front-end de fato veio para a tabela Compra criada para essa atividade

![Banco de Employees padrão](/bancoEmployees.png)
Evidência de que o resultado escrito no input do front-end de fato veio para a tabela Employees criada pelo tutorial e mantida


Cabe ressaltar que há 2 tabelas no banco de dados "Comeco", nome esse que foi definido ao configurar o RDS. Isso porque o tutorial da AWS evidenciado no link acima já faz com que a aplicação crie um banco denominado "EMPLOYEES". Entretanto, para fins didáticos, foi criado uma nova tabela, "COMPRAS", para colocar as novas informações nos 4 campos - sendo os 4 diferentes: varchar, int, float e double, como requisitado. 
Também é uma observação que a junção de tabelas na visualização se deu por interesse em aprender como fazer para exibir informações de diferentes tabelas de um banco de dados em uma mesma "table" do HTML, sendo um conhecimento de grande valor para trabalhos futuros.

Link do vídeo no Drive:
https://drive.google.com/file/d/10llzMksAZyxgs9bmkEN6XhKkmMQraWwZ/view?usp=sharing
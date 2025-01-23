<?php

    require_once("util/Conexao.php");
    require_once("models/ClientePF.php");
    require_once("models/ClientePJ.php");
    require_once("dao/ClienteDAO.php");

    /*
    $con = Conexao::getCon();
    print_r($con); */

    echo "\n\n----CADASTRO DE CLIENTES----\n";
    echo "1- Cadastrar Cliente PF\n";
    echo "2- Cadastrar Cliente PJ\n";
    echo "3- Listar Clientes\n";
    echo "4- Buscar Cliente\n";
    echo "5- Excluir Cliente\n";
    echo "0- Sair\n";

    $opcao = readline("Informe a opção: ");
    switch($opcao) {
        case 1:
            $cliente = new ClientePF();
            $cliente->setNome(readline("Informe o nome: "));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCpf(readline("Informe o CPF: "));
            $cliente->setEmail(readline("Informe o e-mail: "));

            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            echo "Cliente PF cadastrado com sucesso!\n\n";

            break;

        case 2:
            $cliente = new ClientePJ();
            $cliente->setRazaoSocial(readline("Informe a razão social: "));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCnpj(readline("Informe o CNPJ: "));
            $cliente->setEmail(readline("Informe o e-mail: "));

            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            echo "Cliente PJ cadastrado com sucesso!\n\n";

            break;

        case 3:

            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            foreach($clientes as $c) {
                printf("%d- %s | %s | %s | %s | %s\n", $c->getId(), $c->getTipo(), $c->getNomeSocial(),
                $c->getIdentificacao(), $c->getNroDoc(), $c->getEmail());

            }
            break;
    
        case 4:
            //BUSCAR CLIENTE PELO ID

            //1- LER O ID
            $id = 0;

            //2- CHAMAR O METODO QUE RETORNA O OBJETO CLIENTE DO BANCO DE DADOS
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->buscarPorId($id);

            //3- VERIFICAR SE O CLIENTE RETORNAR É DIFERENTE DE NULL
            //3.1- SE FOR DIFERENTE DE NULL, MOSTRAR DADOS DO CLIENTE
            //3.2- SE FOR IGUAL A NULL, MOSTRAR MENSAGEM QUE O CLIENTE NÃO FOI ENCONTRADO

            break;

        case 5:
            break;
        
        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!";
    }
while($opcao != 0);
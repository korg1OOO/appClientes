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
            echo "Buscar Cliente pelo ID\n";
            $id = readline("Informe o ID do cliente: ");

            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->buscarPorId($id);

            if ($cliente !== null) {
                echo "Cliente encontrado:\n";
                printf("%d- %s | %s | %s | %s | %s\n", 
                    $cliente->getId(), 
                    $cliente->getTipo(), 
                    $cliente->getNomeSocial(),
                    ($cliente instanceof ClientePF ? "CPF" : "CNPJ"), 
                    $cliente->getNroDoc(), 
                    $cliente->getEmail()
                );
            } else {
                echo "Cliente não encontrado!\n";
            }
            break;

        case 5:
            echo "Excluir Cliente pelo ID\n";

            $clienteDAO = new ClienteDAO();

            $clientes = $clienteDAO->listarClientes();

            foreach($clientes as $c) {
                printf("%d- %s | %s | %s | %s | %s\n", $c->getId(), $c->getTipo(), $c->getNomeSocial(),
                $c->getIdentificacao(), $c->getNroDoc(), $c->getEmail());
            }
            
            $id = readline("Informe o ID do cliente: ");

            $clienteDAO->excluirCliente($id);

            echo "Cliente excluído com sucesso!\n\n";
            break;
        
        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!";
    }
while($opcao != 0);

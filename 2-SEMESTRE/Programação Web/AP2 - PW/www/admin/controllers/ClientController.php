<?php

class ClientController{

    public function __construct(){
        if(!isset($_SESSION['user'])){
            header('Location:?controller=main&action=login');
        }
    }

    public function register(){
        require_once('views/templates/header.php');
        require_once('views/client/register.php');
        require_once('views/templates/footer.php');
    }
    public function registerView(){
        if (isset($_POST['accept'])){
            $accept = true;
            $accept = "Termo aceito.";
        }else{
            $accept = false;
            $accept = "Termo não aceito.";
        }

        $arrayClient = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'gender' => $_POST['gender'],
            'accept' => $accept,
        );

        require_once('views/templates/header.php');
        require_once('views/client/registerView.php');
        require_once('views/templates/footer.php');
    }

    public function listClients(){
        require_once('models/ClientModel.php');
        $ClientModel = new ClientModel();
        $result = $ClientModel->listClients();

        $arrayClients =  array();
        while ($line = $result->fetch_assoc()) {
            array_push($arrayClients, $line);
        }
        require_once('views/templates/header.php');
        require_once('views/client/listClients.php');
        require_once('views/templates/footer.php');
    }

    public function detailsClient($idClient){
        require_once('models/ClientModel.php');
        $ClientModel = new ClientModel();
        $result = $ClientModel->detailsClient($idClient);

        if ($arrayClient = $result->fetch_assoc()){
            require_once('views/templates/header.php');
            require_once('views/client/detailsClient.php');
            require_once('views/templates/footer.php');
        }
    }

    public function insertClient(){
        require_once('views/templates/header.php');
        require_once('views/client/insertClient.php');
        require_once('views/templates/footer.php');
    }

    public function insertClientAction(){
       $arrayClient = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
       );

       require_once('models/ClientModel.php');
        $ClientModel = new ClientModel();
        $ClientModel -> insertClient($arrayClient);


        header('Location:?controller=client&action=listClient');
    }

    public function updateClient($idClient){
        require_once('models/ClientModel.php');
        $ClientModel = new ClientModel();
        $result = $ClientModel->detailsClient($idClient);

        if ($arrayClient = $result->fetch_assoc()){
            require_once('views/templates/header.php');
            require_once('views/client/updateClient.php');
            require_once('views/templates/footer.php');
        }
        
    }

    public function updateClientAction($idClient){
        $arrayClient = array(
            'idClient' => $idClient,
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
           );
    
           require_once('models/ClientModel.php');
            $ClientModel = new ClientModel();
            $ClientModel -> updateClient($arrayClient);
    
    
           header('Location:?controller=client&action=listClient');
    }
}

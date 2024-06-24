<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('Main_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    function index()
    {

        $data = [
            'page' => 'mainpage',
        ];

        $this->load->view('main', $data);
    }

    function getTransactions()
    {
        $getTransactions = $this->Main_Model->getTransactions();

        echo json_encode($getTransactions);
    }

    function getReadyTransactions()
    {
        $status = $this->input->get('status');
        $getReadyTransactions = $this->Main_Model->getReadyTransactions($status);

        echo json_encode($getReadyTransactions);
    }

    public function getStatistic()
    {
        $getStatistic = $this->Main_Model->getStatistic();
        echo json_encode($getStatistic);
    }

    public function add()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'customer_name' => $this->input->post('nama'),
            'customer_phone' => $this->input->post('noTelefon'),
            'model' => $this->input->post('model'),
            'problem' => $this->input->post('masalah'),
            'status' => 'Pending', // Default status
            'date' => $this->input->post('tarikh')
        );

        $this->Main_Model->add($data);
        echo json_encode(array("status" => TRUE));
    }

    public function updateTransaction()
    {
        $id = $this->input->post('id');
        $data = array(
            'customer_name' => $this->input->post('nama'),
            'customer_phone' => $this->input->post('noTelefon'),
            'model' => $this->input->post('model'),
            'problem' => $this->input->post('masalah'),
            'date' => $this->input->post('tarikh'),
            'status' => $this->input->post('status')
        );

        $this->Main_Model->update_transaction($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function getLastId() {
        $last_id = $this->Main_Model->get_last_id();
        echo json_encode($last_id);
    }

    function searchTransactions()
    {
        $search = $this->input->get('search');
        $searchTransactions = $this->Main_Model->searchTransactions($search);

        echo json_encode($searchTransactions);
    }

    function searchReadyTransactions()
    {
        $status = $this->input->get('status');
        $search = $this->input->get('search');
        $searchTransactions = $this->Main_Model->searchReadyTransactions($search, $status);

        echo json_encode($searchTransactions);
    }

    public function print_page() {
        $this->load->view('print_page');
    }
}

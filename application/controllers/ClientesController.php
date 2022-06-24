<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller ClientesController
 *
 * Gestiona los clientes
 *
 * @package   Yireh
 * @author    Bryan E. Pool Mercado <bryanedilberto@hotmail.com>
 *
 */

class ClientesController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('clientes', 'c');
  }

  public function index()
  {
    $view = $this->load->view('pages/clientes', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Clientes']);
  }

  public function getClientes()
  {
    $clientes = $this->c->selectClientes();
    $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($clientes));
  }
}


/* End of file ClientesController.php */
/* Location: ./application/controllers/ClientesController.php */
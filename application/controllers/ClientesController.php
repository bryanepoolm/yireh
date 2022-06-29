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
    $like_match = $_GET['term'];
    $clientes = $this->c->selectClientes($like_match);
    $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($clientes));
  }

  public function deleteCliente($id)
  {
    if ($this->input->is_ajax_request() && $id != null && !empty($id)) {
      if ($this->c->deleteCliente($id)) {
        $this->output->set_status_header(200)->set_content_type('text/plain')->set_output('Eliminado');
      } else $this->output->set_status_header(500)->set_content_type('text/plain')->set_output('Error al eliminar al cliente');
    } else $this->output->set_status_header(404);
  }
}


/* End of file ClientesController.php */
/* Location: ./application/controllers/ClientesController.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller OrdenesController
 *
 * Gestiona las ordenes
 *
 * @package   Yireh
 * @author    Bryan E. Pool Mercado <bryanedilberto@hotmail.com>
 *
 */

class OrdenesController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ordenes', 'o');
    $this->load->library('session');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $view = $this->load->view('pages/ordenes', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Ordenes']);
  }

  public function deleteClienteOrden()
  {
    $this->form_validation->set_rules('id-cliente', 'Cliente', 'required');

    if ($this->form_validation->run()) {
      $id_cliente = $this->input->post('id-cliente', true);
      $this->o->deleteClienteOrden(['id_cliente' => $id_cliente]);

      $this->output
        ->set_status_header(200)
        ->set_content_type('text/plain')
        ->set_output('Eliminado');
    } else {
    }
  }

  public function getOrdenActual()
  {
    $id_orden = null;
    if (isset($_SESSION['current-order']) || !empty($_SESSION['current-order'])) $id_orden = $this->session->userdata('current-order');

    $orden_clientes = $this->o->selectOrdenClientes($id_orden);


    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json')
      ->set_output(json_encode($orden_clientes));
  }

  public function getOrdenes()
  {
    $ordenes = $this->o->selectOrdenes();
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json')
      ->set_output(json_encode($ordenes));
  }
}


/* End of file OrdenesController.php */
/* Location: ./application/controllers/OrdenesController.php */
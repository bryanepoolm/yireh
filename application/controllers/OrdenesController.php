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
    $this->load->library('form_validation');
    $this->load->library('fpdf');
  }

  public function index()
  {
    $view = $this->load->view('pages/ordenes', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Ordenes']);
  }

  /**
   * deleteClienteOrden
   * Elimina a un cliente de una orden, pero el cliente permance accesible para otras ordenes
   * @author Bryan E Pool Mercado <bryanedilberto@hotmail.com>
   */
  public function deleteClienteOrden()
  {
    $this->form_validation->set_rules('id-cliente', 'Cliente', 'required');

    if ($this->form_validation->run()) {
      $id_cliente = $this->input->post('id-cliente', true);
      $id_orden = $this->o->selectOrdenes(['status' => 1])->id;
      $this->o->deleteClienteOrden(['id_cliente' => $id_cliente, 'id_orden' => $id_orden]);

      $this->output
        ->set_status_header(200)
        ->set_content_type('text/plain')
        ->set_output('Eliminado');
    } else {
    }
  }

  /**
   * deleteOrden
   * Elimina una orden
   * @author Bryan E Pool Mercado <bryanedilberto@hotmail.com>
   */
  public function deleteOrden($id)
  {
    if ($this->input->is_ajax_request() && $id != null && !empty($id)) {
      if ($this->o->deleteOrden($id)) {
        $this->output->set_status_header(200)->set_content_type('text/plain')->set_output('Orden eliminada');
      } else $this->output->set_status_header(500)->set_content_type('text/plain')->set_output('Error al eliminar la orden');
    } else $this->output->set_status_header(404);
  }

  public function getOrdenActual()
  {
    $id_orden = null;
    $get_orden = $this->o->selectOrdenes(['status' => 1]);
    if (count($get_orden) > 0) $id_orden = $get_orden->id;

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

  public function downloadOrden($id)
  {
    if ($id != null && !empty($id)) {

      $header = array('Nombre', 'Direccion', 'Telefono');
      $data = $this->o->selectOrdenClientes($id);
      $orden_data = [];
      foreach ($data as $i => $val) {
        $orden_data[] = [
          $val['nombre'],
          $val['direccion'],
          $val['telefono'],
        ];
      }
      $orden = $this->o->selectOrden($id, true);
      $this->fpdf->AddPage();
      $this->fpdf->SetFont('Arial', '', 14);
      $this->fpdf->SetTitle("Lista de clientes, orden #{$orden->id}");
      $this->fpdf->BasicTable($header, $orden_data);
      die(var_dump($this->fpdf->Output()));
    } else $this->output->set_status_header(404);
  }
}


/* End of file OrdenesController.php */
/* Location: ./application/controllers/OrdenesController.php */
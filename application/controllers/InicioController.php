<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller InicioController
 *
 * Gestiona el acceso de las vistas principales
 *
 * @package   SmarthFilter
 * @author    Bryan E. Pool Mercado <bryanedilberto@hotmail.com>
 *
 */

class InicioController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('clientes', 'c');
    $this->load->model('ordenes', 'o');
  }

  public function index()
  {
    $view = $this->load->view('pages/inicio', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Inicio']);
  }

  public function postAgregarClienteOrden()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('nombre-cliente', 'Nombre del cliente', 'required');
      $this->form_validation->set_rules('direccion-cliente', 'Direccion', 'required');
      $this->form_validation->set_rules('telefono-cliente', 'Telefono', 'required');

      if ($this->form_validation->run()) {
        $nombre = $this->input->post('nombre-cliente', true);
        $direccion = $this->input->post('direccion-cliente', true);
        $telefono = $this->input->post('telefono-cliente', true);

        $datos = [];
        $datos['nombre'] = $nombre;
        $datos['direccion'] = $direccion;
        $datos['telefono'] = $telefono;

        $id_cliente = $this->c->insertarCliente($datos);

        if ($id_cliente > 0) {
          if (isset($_POST['id-orden']) && $_POST['id-orden'] != '')
            $id_orden = $this->input->post('id-orden', true);
          else {
            $datos_orden = [];
            $datos_orden['fecha'] = date('Y-m-d H:i:s');
            $id_orden = $this->o->insertarOrden($datos_orden);
          }
          $datos_orden_cliente = [];
          $datos_orden_cliente['id_orden'] = $id_orden;
          $datos_orden_cliente['id_cliente'] = $id_cliente;
          if ($this->o->insertarOrdenCliente($datos_orden_cliente))
            $this->output->set_content_type('text/plain')->set_status_header(201)->set_output('Agregado');
          else
            $this->output->set_content_type('text/plain')->set_status_header(500)->set_output('Algo salio mal al hacer el registro');
        } else
          $this->output->set_content_type('text/plain')->set_status_header(500)->set_output('Algo salio mal al registrar el cliente');
      } else
        $this->output->set_content_type('application/json')->set_status_header(400)->set_output(json_encode([
          'nombre' => form_error('nombre-cliente'),
          'direccion' => form_error('direccion-cliente'),
          'telefono' => form_error('telefono-cliente'),
        ]));
    }
  }
}


/* End of file InicioController.php */
/* Location: ./application/controllers/InicioController.php */
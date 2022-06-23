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
  }

  public function index()
  {
    $view = $this->load->view('pages/clientes', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Clientes']);
  }
}


/* End of file ClientesController.php */
/* Location: ./application/controllers/ClientesController.php */
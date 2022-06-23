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
  }

  public function index()
  {
    $view = $this->load->view('pages/ordenes', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Ordenes']);
  }
}


/* End of file OrdenesController.php */
/* Location: ./application/controllers/OrdenesController.php */
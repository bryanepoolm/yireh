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
  }

  public function index()
  {
    $view = $this->load->view('pages/inicio', [], true);
    $this->load->view('layouts/mainLayout', ['contenido' => $view, 'titulo' => 'Inicio']);
  }
}


/* End of file InicioController.php */
/* Location: ./application/controllers/InicioController.php */
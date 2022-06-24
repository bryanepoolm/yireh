<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Clientes
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Clientes extends CI_Model
{
  public $table = 'clientes';

  public $id;
  public $nombre;
  public $direccion;
  public $telefono;

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Clientes', 'c');
  }

  // ------------------------------------------------------------------------



  public function insertarCliente($datos)
  {
    $this->db->insert($this->table, $datos);
    return $this->db->insert_id();
  }

  public function selectClientes()
  {
    return $this->db->get('clientes')->result_array();
  }
}

/* End of file Clientes.php */
/* Location: ./application/models/Clientes.php */
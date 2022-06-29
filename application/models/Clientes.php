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
  }

  // ------------------------------------------------------------------------



  public function insertarCliente($datos)
  {
    $this->db->insert($this->table, $datos);
    return $this->db->insert_id();
  }

  public function selectClientes($like = false)
  {
    if ($like != false) $this->db->like('nombre', $like);
    $this->db->select();
    $this->db->from($this->table);
    return $this->db->get()->result_array();
  }

  public function deleteCliente($id)
  {
    $this->db->delete($this->table, ['id' => $id]);
    return true;
  }
}

/* End of file Clientes.php */
/* Location: ./application/models/Clientes.php */
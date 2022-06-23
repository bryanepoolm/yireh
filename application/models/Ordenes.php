<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Ordenes
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

class Ordenes extends CI_Model
{
  public $table = 'ordenes';
  public $table2 = 'ordenes_clientes';

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function insertarOrden($datos)
  {
    $this->db->insert($this->table, $datos);
    return $this->db->insert_id();
  }

  public function insertarOrdenCliente($datos)
  {
    $this->db->insert($this->table2, $datos);
    return true;
  }

  // ------------------------------------------------------------------------

}

/* End of file Ordenes.php */
/* Location: ./application/models/Ordenes.php */
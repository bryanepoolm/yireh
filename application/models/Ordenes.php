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

  public function selectOrden($id_orden, $returnData = false)
  {
    $this->db->where('id', $id_orden);
    $get = $this->db->get('ordenes');
    if ($get->num_rows() > 0) if ($returnData) return $get->row();
    else return false;
  }

  public function selectOrdenes($where = null)
  {
    if (!is_null($where)) $this->db->where($where);
    $get = $this->db->get($this->table);
    if (!is_null($where)) $get = $get->row();
    else $get = $get->result_array();

    return $get;
  }

  public function updateOrden($set, $where)
  {
    $this->db->update($this->table, $set, $where);
  }

  public function deleteClienteOrden($where)
  {
    $this->db->delete($this->table2, $where);
  }
  public function deleteOrden($id)
  {
    $this->db->delete($this->table, ['id' => $id]);
    return true;
  }

  public function selectOrdenClientes(int $id_orden = null)
  {
    if ($id_orden != null) $this->db->where('o.id', $id_orden);

    $this->db->where('o.status', 1);
    $this->db->from("{$this->table2} AS oc");
    $this->db->join('clientes AS c', 'c.id = oc.id_cliente');
    $this->db->join('ordenes AS o', 'o.id = oc.id_orden');
    return $this->db->get()->result_array();
  }

  // ------------------------------------------------------------------------

}

/* End of file Ordenes.php */
/* Location: ./application/models/Ordenes.php */
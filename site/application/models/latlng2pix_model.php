<?php

class Latlng2pix_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getLatLng()
	{
		$this->db->select('gymID, posLongitude, posLatitude');
		$dbr = $this->db->get('gyms');
		return (($dbr->num_rows) ? $dbr->result() : NULL);
	}

	function writePoss($gimID, $posX, $posY)
	{
		$data = array('posX' => $posX, 'posY' => $posY);
		$this->db->where('gymID', $gimID);
		$this->db->update('gyms', $data);
	}

	function getPointsPossXY()
	{
		$this->db->select('gymID, posX, posY');
		$dbr = $this->db->get('gyms');
		return (($dbr->num_rows) ? $dbr->result_array() : NULL);
	}

}
?>

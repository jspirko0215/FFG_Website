<?php
if (!defined('BASEPATH'))    exit('Нет доступа к скрипту');

class Latlng2pix extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// Convert data from columns posLongitude & posLatitude to posX, posY in pixels
	public function index()
	{
		$data = array('key_googlemaps' => $this->config->item('key_googlemaps')); // Ключ для GoogleMaps
		$this->load->view('googlemaps', $data);
	}

	public function loading_latlng_array()
	{
		$this->load->model('latlng2pix_model', '', TRUE);

		// Читаем в массив таблицу, поля id, широты и долготы
		$arr = $this->latlng2pix_model->getLatLng();

		echo json_encode($arr);
	}

	public function save_poss_x_y()
	{
		$this->load->model('latlng2pix_model', '', TRUE);

		$arr = $this->input->post('arr', TRUE);
		if( ! $arr) { echo 'error'; return; }
		//system('echo "' . $_POST['arr'][0]['posX'] . '  X=' . $_POST['arr'][0]['posX'] . '  Y=' . $_POST['arr'][0]['posY'] . '" > test.txt');
		foreach($arr as $row)
		{
			$this->latlng2pix_model->writePoss($row['gymID'], $row['posX'], $row['posY']);
		}
		echo 'ok';
	}

	public function view_points()
	{
		$data = array();

		$this->load->model('latlng2pix_model', '', TRUE);

		$data['points'] = $this->latlng2pix_model->getPointsPossXY();

		$this->load->view('points_view', $data);

	}

}
?>
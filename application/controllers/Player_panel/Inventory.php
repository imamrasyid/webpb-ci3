<?php

// ==================== //
//   [DEV] EyeTracker   //
//     Lolsecs#6289     //
// ==================== //

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->login_library->primaryAuthCheck_Empty();
		$this->load->model('main/inventory_model', 'inventory');
	}
	public function index()
	{
		$this->load->library('pagination');

		$config['base_url'] = 'http://localhost:8080/webpb-ci3/player_panel/inventory/index';
		$config['total_rows'] = $this->inventory->getdata_inventory_rows();
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<div class="nk-pagination nk-pagination-center"><nav>';
		$config['full_tag_close'] = '</nav></div>';
		$config['next_link'] = '<span class="ion-ios-arrow-forward"></span>';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '</a>';
		$config['prev_link'] = '<span class="ion-ios-arrow-back"></span>';
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '</a>';
		$config['cur_tag_open'] = '<a class="nk-pagination-current" href="#">';
		$config['cur_tag_close'] = '</a>';
		$this->pagination->initialize($config);

		$data['title'] = 'DarkblowPB || '.$_SESSION['playername'].' Inventory';
		$data['start'] = $this->uri->segment(4);
		$data['inventory'] = $this->inventory->getdata_inventory_limit($config['per_page'], $data['start']);
		$data['isi'] = 'main/content/player_panel/content_inventory';
		$this->load->view('main/layout/wrapper', $data, FALSE);
	}
	public function detail($detail)
	{
		$data['title'] = 'DarkblowPB || Details Item';
		$data['details'] = $this->inventory->getdata_specific_item($detail);
		$data['isi'] = 'main/content/player_panel/content_inventory_detail';
		$this->load->view('main/layout/wrapper', $data, FALSE);
	}
}

// This Code Generated Automatically By EyeTracker Snippets. //
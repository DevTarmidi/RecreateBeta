<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class workspace extends CI_Controller {
	public function index()
	{
		$data['menu']=4;
		$this->load->view('header', $data);
		$this->load->view('workspace', $res);
		$this->load->view('footer');
	}
	public function new($width, $height)
	{
		$data['menu']=4;
		$res = array(
			'w' => $width,
			'h' => $height
		);
		$this->load->view('header', $data);
		$this->load->view('workspace', $res);
		$this->load->view('footer');
    }
}

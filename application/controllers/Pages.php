<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller
{
public function view($page = 'home')
	{
		


	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}
	
	$data['title'] = ucfirst($page); // Capitalize the first letter

	$data['main_content'] = "pages/$page";
	$this->load->view('includes/template', $data);

}

public function home()
	{
	$data['main_content'] = "pages/home";
	$this->load->view('includes/template', $data);

	}
	public function about_us()
	{
	$data['main_content'] = "pages/about-us";
	$this->load->view('includes/template', $data);

	}
	public function services()
	{
	$data['main_content'] = "pages/services";
	$this->load->view('includes/template', $data);

	}

}
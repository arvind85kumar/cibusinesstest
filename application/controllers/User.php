<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
public function login()
	{

	$data['main_content'] = "user/login";
	$this->load->view('includes/template', $data);

	}
	public function register()
	{
		$this->load->helper('security');
		if ($this->input->server('REQUEST_METHOD') == 'POST')
        { 
 
	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('email_address', 'Email Address ', 'trim|valid_email|required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[confirm_password]|xss_clean');
	$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
	$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|min_length[10]|max_length[13]|xss_clean');
 
		   if($this->form_validation->run() == TRUE)
		   {
		     $first_name=$this->input->post('first_name',TRUE);
		     $last_name=$this->input->post('last_name',TRUE);
		     $email_address=$this->input->post('email_address',TRUE);
		     $password=$this->input->post('password',TRUE);
		     $contact_number=$this->input->post('contact_number',TRUE);
		
		  	$this->db->insert('users',array('first_name'=>$first_name,'last_name'=>$last_name,'email_address'=>$email_address,'password'=>$password,'contact_number'=>$contact_number,'created_on'=>date('Y-m-d:H:i:s')));
		  }
	}
	$data['main_content'] = "user/registration";
	$this->load->view('includes/template', $data);
	}
	public function myaccount()
	{
	$this->load->model('users_model');
	$data['loggedUser']=$this->users_model->loged_user(27);
	$data['main_content'] = "user/my-account";
	$this->load->view('includes/template', $data);

	}
	public function edit_profile(){
		$data=array('first_name'=>$this->input->post('first_name',TRUE),'last_name'=>$this->input->post('last_name',TRUE),'gender'=>$this->input->post('gender',TRUE),'city'=>$this->input->post('city',TRUE),'country'=>$this->input->post('country',TRUE),'contact_number'=>$this->input->post('mobile',TRUE));
		$where=array('id'=>$this->input->post('user_id',TRUE));
			$this->db->update('users',$data,$where);die;			
		
	}
	public function change_password(){		
		$data=array('password'=>md5($this->input->post('new_password',TRUE)));
		$where=array('id'=>$this->input->post('user_id',TRUE));
		$this->db->update('users',$data,$where);die;		
	}
	public function check_existpassword(){		
		$data=array('password'=>md5($this->input->post('new_password',TRUE)));
		$where=array('id'=>$this->input->post('user_id',TRUE));
		$this->db->update('users',$data,$where);die;		
	}
}
<?php
ini_set("error_reporting",0);
class Users_model extends CI_Model {
/*
   This model is used for all User activity
	*/
   public function loged_user($loged_userid)
   {
   	$this->db->select('*');
   	$this->db->from('users');
   	$this->db->where('id',$loged_userid);
   $query=$this->db->get();
   	$userData=$query->row_object();
   	return $userData;
   	
   }
   public function update_profile($data,$where){
   	$this->db->update('users',$data,$where);
   }
}
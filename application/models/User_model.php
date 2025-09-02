<?php
class User_model extends CI_Model
{

	public function get_user($username)
	{
		return $this->db->where('username', $username)->get('users')->row();
	}

	public function get_by_id($id)
	{
		return $this->db->where('id', $id)->get('users')->row();
	}

	public function update_password($id, $new_password)
	{
		return $this->db->where('id', $id)->update('users', ['password' => $new_password]);
	}
}

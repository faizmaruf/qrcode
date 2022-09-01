<?php
class Login_model extends CI_Model
{
    //cek nip dan password Admin
    function get_admin($username, $password)
    {
        $query = $this->db->query("SELECT * FROM admin WHERE nama='$username' AND pass='$password' LIMIT 1");
        return $query;
    }
 
    //cek nim dan password Operator
    function get_operator($username, $password)
    {
        $query = $this->db->query("SELECT * FROM operator WHERE nama='$username' AND pass='$password' LIMIT 1");
        return $query;
    }


}
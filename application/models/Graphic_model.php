<?php
class Graphic_model extends CI_Model
{
    function userPerBulan()
    {
        $this->db->group_by('month(date_created)');
        $this->db->select("date_created as month");
        $this->db->select("count(*) as total");
        return $this->db->from('user')
            ->get()
            ->result();
    }
}

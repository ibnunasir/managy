
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getTransactions()
    {
        $query = $this->db->query("SELECT *
        FROM customer_issues ORDER BY date desc");
        return $query->result();
    }

    function getReadyTransactions($status)
    {
        $query = $this->db->query("SELECT *
        FROM customer_issues where status = '" . $status . "'  ORDER BY date desc");
        return $query->result();
    }

    public function getStatistic()
    {
        $this->db->select('status, COUNT(*) as count');
        $this->db->group_by('status');
        $query = $this->db->get('customer_issues');

        $counts = array(
            'Pending' => 0,
            'Ready' => 0,
            'Completed' => 0
        );

        foreach ($query->result() as $row) {
            $counts[$row->status] = $row->count;
        }

        return $counts;
    }

    public function add($data)
    {
        $this->db->insert('customer_issues', $data);
    }

    public function update_transaction($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('customer_issues', $data);
    }

    public function get_last_id() {
        $query = $this->db->query('SELECT id FROM customer_issues ORDER BY CAST(SUBSTRING(id, 4) AS UNSIGNED) DESC LIMIT 1');
        return $query->row();
    }

    function searchTransactions($search)
    {
        $query = $this->db->query("SELECT *
        FROM customer_issues
        where LOWER(id) like '%".$search."%' OR LOWER(customer_name) like '%".$search."%' 
        OR LOWER(customer_phone) like '%".$search."%' OR LOWER(model) like '%".$search."%'
        OR LOWER(status) like '%".$search."%' OR LOWER(date) like '%".$search."%'
        ");
        return $query->result();
    }

    function searchReadyTransactions($search, $status)
    {
        $query = $this->db->query("SELECT *
        FROM customer_issues
        where status = '" . $status . "' AND
        LOWER(id) like '%".$search."%' OR LOWER(customer_name) like '%".$search."%' 
        OR LOWER(customer_phone) like '%".$search."%' OR LOWER(model) like '%".$search."%'
        OR LOWER(status) like '%".$search."%' OR LOWER(date) like '%".$search."%'
        ");
        return $query->result();
    }
}

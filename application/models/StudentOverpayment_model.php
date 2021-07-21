<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class StudentOverpayment_model extends CI_Model {

        private $table = "student_overpayment";

    public function __construct() {
        parent::__construct();
    }
 
    public function get($id = null) {
        $this->db->select()->from('student_overpayment');
        if ($id != null) {
            $this->db->where('student_id', $id);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('student_id', $data['id']);
            $this->db->set('amount_overpaid', 'amount_overpaid+' .$data['amount_overpaid'], FALSE);
            $this->db->update('student_overpayment');
        } else {
            $this->db->insert('student_overpayment', $data);
        }
    }





}

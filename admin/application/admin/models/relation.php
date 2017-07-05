<?php

class Relation extends CI_Model {

    function get_client_list($company_id = "") {

        $CI = & get_instance();
        $CI->load->database();
        $db_prefix = $CI->db->dbprefix;

        $query = $this->db->query('SELECT ' . $db_prefix . 'client.*, ' . $db_prefix . 'relation.* '
                . 'FROM ' . $db_prefix . 'relation '
                . 'JOIN ' . $db_prefix . 'client '
                . 'ON ' . $db_prefix . 'client.client_id=' . $db_prefix . 'relation.relation_to_id '
                . 'WHERE ' . $db_prefix . 'relation.relation_from_id =' . $company_id . ' AND ' . $db_prefix . 'relation.relation_from = 2 AND ' . $db_prefix . 'relation.relation_to = 3 AND ' . $db_prefix . 'relation.relation_status = 1 AND ' . $db_prefix . 'client.client_status = 1 AND ' . $db_prefix . 'client.client_approve_status = 1 AND ' . $db_prefix . 'client.is_delete = 0 group by ' . $db_prefix . 'client.client_id '
                . 'UNION '
                . 'SELECT ' . $db_prefix . 'client.*, ' . $db_prefix . 'relation.* '
                . 'FROM ' . $db_prefix . 'relation '
                . 'JOIN ' . $db_prefix . 'client '
                . 'ON ' . $db_prefix . 'client.client_id=' . $db_prefix . 'relation.relation_from_id '
                . 'WHERE ' . $db_prefix . 'relation.relation_to_id = ' . $company_id . ' AND relation_to = 2 AND relation_from = 3 AND relation_status = 1  AND ' . $db_prefix . 'client.client_status = 1 AND ' . $db_prefix . 'client.client_approve_status = 1 AND ' . $db_prefix . 'client.is_delete = 0  group by ' . $db_prefix . 'client.client_id');

        $results = $query->result_array();
        return $results;
    }

    function check_client_availability($company_id = '', $client_id = '') {

        $this->db->select('*');
        $where = '((relation_from = 2 and relation_from_id = ' . $company_id . ' and relation_to = 3 and relation_to_id = ' . $client_id . ' ) or(relation_from = 3 and relation_from_id = ' . $client_id . ' and relation_to = 2 and relation_to_id = ' . $company_id . '))';
        $this->db->where($where);
        $result = $this->db->get('relation')->result_array();

        if (!empty($result)) {
            return $result;
        } else {
            return 0;
        }
    }

    function get_check_in_out($id = "") {

        $CI = & get_instance();
        $CI->load->database();
        $db_prefix = $CI->db->dbprefix;

        $query = $this->db->query('SELECT ' . $db_prefix . 'checking_process.*, ' . $db_prefix . 'work_order.*, ' . $db_prefix . 'truck.truck_number, ' . $db_prefix . 'truck.driver_name '
                . 'FROM ' . $db_prefix . 'checking_process '
                . 'JOIN ' . $db_prefix . 'work_order '
                . 'ON ' . $db_prefix . 'work_order.wo_id = ' . $db_prefix . 'checking_process.work_id '
                . 'JOIN ' . $db_prefix . 'truck '
                . 'ON ' . $db_prefix . 'truck.truck_id=' . $db_prefix . 'checking_process.truck_id '
                . 'WHERE ' . $db_prefix . 'checking_process.truck_type = 1 AND ' . $db_prefix . 'work_order.wo_id = ' . $id
                . ' UNION '
                . 'SELECT ' . $db_prefix . 'checking_process.*, ' . $db_prefix . 'work_order.*,' . $db_prefix . 'driver.truck_number, ' . $db_prefix . 'driver.driver_name '
                . 'FROM ' . $db_prefix . 'checking_process '
                . 'JOIN ' . $db_prefix . 'work_order '
                . 'ON ' . $db_prefix . 'work_order.wo_id = ' . $db_prefix . 'checking_process.work_id '
                . 'JOIN ' . $db_prefix . 'driver '
                . 'ON ' . $db_prefix . 'driver.driver_id=' . $db_prefix . 'checking_process.truck_id '
                . 'WHERE ' . $db_prefix . 'checking_process.truck_type = 2 AND ' . $db_prefix . 'work_order.wo_id = ' . $id
        );

        $results = $query->result_array();
        return $results;
    }

    function get_activity_logs($offset = "0", $limit = "10") {

        $CI = & get_instance();
        $CI->load->database();
        $db_prefix = $CI->db->dbprefix;

        $query = $this->db->query('SELECT ' . $db_prefix . 'activity_logs.*, ' . $db_prefix . 'admin.admin_name , ' . $db_prefix . 'admin.admin_role as role '
                . ' FROM ' . $db_prefix . 'activity_logs '
                . ' JOIN ' . $db_prefix . 'admin '
                . ' ON ' . $db_prefix . 'admin.admin_id = ' . $db_prefix . 'activity_logs.log_by_id '
                . ' WHERE ' . $db_prefix . 'activity_logs.log_by = 1 '
                . ' UNION '
                . ' SELECT ' . $db_prefix . 'activity_logs.*, ' . $db_prefix . 'company.company_name , ' . $db_prefix . 'company.company_role as role '
                . ' FROM ' . $db_prefix . 'activity_logs '
                . ' JOIN ' . $db_prefix . 'company '
                . ' ON ' . $db_prefix . 'company.company_id = ' . $db_prefix . 'activity_logs.log_by_id '
                . ' WHERE ' . $db_prefix . 'activity_logs.log_by = 2'
                . ' UNION '
                . ' SELECT ' . $db_prefix . 'activity_logs.*, ' . $db_prefix . 'client.client_name , ' . $db_prefix . 'client.client_role as role '
                . ' FROM ' . $db_prefix . 'activity_logs '
                . ' JOIN ' . $db_prefix . 'client '
                . ' ON ' . $db_prefix . 'client.client_id = ' . $db_prefix . 'activity_logs.log_by_id '
                . ' WHERE ' . $db_prefix . 'activity_logs.log_by = 3 '
                    . ' ORDER BY log_id ASC '
                . ' LIMIT ' . $offset . ',' . $limit
				);

        $results = $query->result_array();
        return $results;
    }

    function get_top_data($count_table = '', $count_fieldname = '', $table = '', $fieldname = '') {

        $CI = & get_instance();
        $CI->load->database();
        $db_prefix = $CI->db->dbprefix;

        $query = $this->db->query('SELECT  ' . $count_fieldname . ' , COUNT(' . $count_fieldname . ') AS `value_occurrence`'
                . ' FROM ' . $db_prefix . $count_table . ''
                . ' GROUP BY ' . $count_fieldname . ''
                . ' ORDER BY `value_occurrence`'
                . ' DESC LIMIT 1');

        $result = $query->result_array();
        if ($result) {
            $wo_id = $result[0][$count_fieldname];

            $query = $this->db->query('SELECT ' . $db_prefix . $table . '.* '
                    . ' FROM ' . $db_prefix . $table
                    . ' WHERE ' . $db_prefix . $table . '.is_delete = 0 AND ' . $db_prefix . $table . '.' . $fieldname . ' =' . $wo_id
            );

            $results = $query->result_array();
            $return_result = array_merge($result, $results);
            return $return_result;
        } else {
            return 1;
        }
    }

    function get_top_data_driver() {

        $CI = & get_instance();
        $CI->load->database();
        $db_prefix = $CI->db->dbprefix;

        $query = $this->db->query('SELECT truck_id, COUNT(truck_id) AS `value_occurrence`'
                . ' FROM ' . $db_prefix . 'checking_process'
                . ' WHERE truck_type = 2'
                . ' GROUP BY truck_id'
                . ' ORDER BY `value_occurrence`'
                . ' DESC LIMIT 1');

        $result = $query->result_array();

        if ($result) {
            $wo_id = $result[0]['truck_id'];


            $query = $this->db->query('SELECT ' . $db_prefix . 'driver.* '
                    . ' FROM ' . $db_prefix . 'driver'
                    . ' WHERE ' . $db_prefix . 'driver.is_delete = 0 AND ' . $db_prefix . 'driver.driver_id =' . $wo_id
            );

            $results = $query->result_array();
            $return_result = array_merge($result, $results);
            return $return_result;
        } else {
            return 1;
        }
    }

}

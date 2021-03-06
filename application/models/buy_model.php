<?php
class Buy_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function sign_up($post) {
		if (empty ( $post ['id'] ) || empty ( $post ['type'] )) {
			return array (
					'ret' => 400 
			);
		}
		if ($post ['type'] == 2) {
            $this->db->select ( 'id , price , type , title' );
			$this->db->from ( 'lesson' );
		} else if ($post ['type'] == 4) {
            $this->db->select ( 'id , price , type , title' );
			$this->db->from ( 'active' );
		}else if($post ['type'] == 5){
            $this->db->select ( '*' );
            $this->db->from ( 'video' );
        }else if($post ['type'] == 6){
            $this->db->select ( '*' );
            $this->db->from ( 'year' );
        }
		$this->db->where ( 'id', $post ['id'] );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			if ($post ['type'] == 2) {
				$this->db->where ( 'id', $info ['id'] );
				$this->db->set ( 'sign_num', 'sign_num + 1', FALSE );
				$this->db->update ( 'lesson' );
			}
			$this->db->trans_start ();
			$data ['order_sn'] = $this->get_order_sn ();
            if($post['type'] == 5){
                $data ['price'] = $info ['cost'];
            }else{
                $data ['price'] = $info ['price'];
            }
			$data ['amount'] = 1;
			$data ['discount'] = 0;
			$data ['pay_type'] = 0;
			$data ['type'] = 0;
            if($post['type'] == 5){
			    $data ['status'] = floatval($info ['cost']) == 0 ? 2 : 0;
            }else{
                $data ['status'] = floatval($info ['price']) == 0 ? 2 : 0;
            }

            if($post['type'] == 6){
                $data ['is_year'] = $post ['is_year'];
            }
			$data ['user_id'] = $_SESSION ['uid'];
			$data ['itype'] = $info ['type'];
			$data ['ctime'] = time ();
			$data ['utime'] = time ();
			$this->db->insert ( 'order', $data );
			$oid = $this->db->insert_id ();
			$ogoods ['user_id'] = $_SESSION ['uid'];
			$ogoods ['order_id'] = $oid;
			$ogoods ['goods_id'] = $post ['id'];
			$ogoods ['goods_num'] = 1;
			$ogoods ['type'] = $post ['type'];
            if($post['type'] == 5){
                $ogoods ['price'] = $info ['cost'];
            }else{
                $ogoods ['price'] = $info ['price'];
            }
            $ogoods ['itype'] = $info ['type'];
			$ogoods ['goods_title'] = $info ['title'];
			// $ogoods['goods_img'] = $info['']
			$ogoods ['ctime'] = time ();
			$ogoods ['utime'] = time ();
			$this->db->insert ( 'order_goods', $ogoods );
			$this->db->trans_complete ();
			if ($this->db->trans_status () === true) {
				return array (
						'ret' => 200,
						'oid' => $oid, 
				);
			}
			return array (
					'ret' => 205 
			);
		}
		return array (
				'ret' => 204 
		);
	}
    /**
     * 得到新订单号
     * @return  string
     */
    function get_order_sn(){
        $code = '';
        do
        {
            $date = date('YmdHis');
            list($usec, $sec) = explode(" ", microtime());
            $code = $date.substr($usec,2,6);
            if ( !$this->db->query(" select order_sn from z_order where order_sn = '$code' ")->row_array() )
            {
                break;
            }
        }while (true);
        return $code;

    }
	private function get_order_sn1() {
		$order = $this->config->item ( 'order' );
		$order_sn = $order ['hcode'];
		$this->db->select ( 'id,order_sn' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( 1 );
		$query = $this->db->get ( 'order' );
		$order_num = 1;
		$order_str = '';
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$order_num = intval ( substr ( $info ['order_sn'], 2 ) ) + 1;
		}
		$len = $order ['length'] - strlen ( $order_num );
		for($i = 0; $i < $len; $i ++) {
			$order_str .= '0';
		}
		$order_sn = $order_sn . $order_str . $order_num;
		return $order_sn;
	}
}

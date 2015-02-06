<?php
class Order_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_order($oid) {
		$this->db->select ( 'id,price,pay_type,type,status,order_sn' );
		$this->db->where ( 'id', $oid );
		$query = $this->db->get ( 'order' );
		if ($query->num_rows () > 0) {
			$oinfo = $query->row_array ();
			$this->db->select ( 'goods_id,price,type' );
			$this->db->where ( 'order_id', $oid );
			$query = $this->db->get ( 'order_goods' );
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				$data ['ret'] = 200;
				$info ['oid'] = $oid;
				$info ['oprice'] = $oinfo ['price'];
				$info ['status'] = $oinfo ['status'];
				$info ['order_sn'] = $oinfo ['order_sn'];
				$data ['info'] = $info;
				return $data;
			}
			return array (
					'ret' => 205 
			);
		}
		return array (
				'ret' => 204 
		);
	}
	function get_user_info() {
		$this->db->select ( 'id,nick_name ,email,mobile' );
		$this->db->where ( 'id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$data ['ret'] = 200;
			$data ['info'] = $info;
			return $data;
		}
		return false;
	}
	function update_status($post) {
		if (! empty ( $post ['oid'] )) {
			$this->db->select ( 'id,status' );
			$this->db->where ( 'id', $post ['oid'] );
			$query = $this->db->get ( 'order' );
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				if ($info ['status'] < $post ['status']) {
					$this->db->where ( 'id', $info ['id'] )->update ( 'order', array (
							'status' => $post ['status'] 
					) );
					return array (
							'ret' => 200 
					);
				}
				return array (
						'ret' => 205 
				);
			}
			return array (
					'ret' => 204 
			);
		} else {
			return array (
					'ret' => 400 
			);
		}
	}
	function do_pay($post) {
	}
	function center($post) {
		$this->db->select ( 'id , price , ctime , status,order_sn' );
		if (isset( $post ['otype'] )) {
			$this->db->where ( 'status', $post ['otype'] );
		}
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$this->db->order_by ( 'id', 'desc' );
		$query = $this->db->get ( 'order' );
		if ($query->num_rows () > 0) {
			$order = $query->result_array ();
			foreach ( $order as $k => $v ) {
				$oid [] = $v ['id'];
			}
			$this->db->select ( 'id ,order_id, goods_id , goods_title,goods_img' );
			$this->db->where_in ( 'order_id', $oid );
			$this->db->limit ( 10 );
			$query = $this->db->get ( 'order_goods' );
			// ss($query);
			if ($query->num_rows () > 0) {
				$order_goods = $query->result_array ();
				foreach ( $order_goods as $k => $v ) {
					$ogid [] = $v ['goods_id'];
					$order_goods_info [$v ['order_id']] = $v;
				}
			}
			$data ['order'] = $order;
			$data ['order_goods'] = $order_goods_info;
			// ss($data);
			return $data;
		}
		return false;
	}
	function get_order_goods($oid) {
		if (empty ( $oid )) {
			return false;
		}
		$this->db->select ( 'goods_id,price,type' );
		$this->db->where ( 'id', $oid );
		$query = $this->db->get ( 'order_goods' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			return $info;
		} else {
			return false;
		}
	}
}

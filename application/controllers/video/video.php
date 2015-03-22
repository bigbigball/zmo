<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Video extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'video_model', '', true );
        $this->load->model ( 'order_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'video' 
		);
		$ci->load->vars ( $variable );
	}
	function show() {
		$get = $this->input->get ();
		$option ['type'] = empty ( $get ['type'] ) ? 0 : $get ['type'];
		
		// 分页
		$option ['limit'] = 9;
        if(isset($_GET['category'])){
            $option ['category'] = $_GET['category'];
        }
		$option ['page'] = empty ( $get ['page'] ) ? 1 : $get ['page'];
		$this->load->library ( 'pagination' );
		$config ['num_links'] = 5;
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
        if(isset($option['category'])){
            $config ['base_url'] = site_url ( 'video/video/show', array (
                'type' => $option ['type'],'category'=>$option['category']
            ) );
        }else{
            $config ['base_url'] = site_url ( 'video/video/show', array (
                'type' => $option ['type']
            ) );
        }

		$config ['total_rows'] = $this->video_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		$list = $this->video_model->getlist ( $option );
		if (! empty ( $list ['info'] )) {
			$data ['list'] = array_chunk ( $list ['info'], 3 );
		}
		$data ['type'] = $get ['type'];
		$data ['page'] = $pagination;
        $category_list = $this->db->get ('category')->result_array();
        $data ['category'] = $category_list;
		$this->load->view ( 'video/show', $data );
	}
	function info() {
		$get = $this->input->get ();
		if (! isset ( $get ['id'] ) || empty ( $get ['id'] )) {
			err_msg ( '参数错误', site_url ( 'video/video/show' ) );
		}
		$info = $this->video_model->get_info ( $get ['id'] );
        $is_cost = 0;
        if($info['is_cost']==1){
            $is_cost = 1;
            if ( !empty ( $_SESSION ['uid'] )) {
                $this->db->select ( 'id ,order_id, goods_id , goods_title,goods_img' );
                $this->db->where_in ( 'goods_id', $get['id'] );
                $this->db->where_in ( 'user_id', $_SESSION ['uid'] );
                $query = $this->db->get ( 'order_goods' );
                if ($query->num_rows () > 0) {
                    $info_order = $query->row_array ();
                    $order_info = $this->order_model->get_order($info_order['order_id'],$_SESSION ['uid'] );
                    if($order_info['info']['status'] == 2){
                        $is_cost = 0;
                    }
                }
            }
        }
		if (! empty ( $info )) {
            $info ['is_cost'] = $is_cost;
			$data ['info'] = $info;
			$this->load->view ( 'video/info', $data );
		} else {
			err_msgs ( '您要看的视频已被删除或不存在', site_url ( 'video/video/show' ) );
		}
	}
}
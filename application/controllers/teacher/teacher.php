<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Teacher extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'teacher_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'teacher' 
		);
		$ci->load->vars ( $variable );
	}
	function show() {
		$get = $this->input->get ();
		// 分页
		$option ['limit'] = 8;
		$option ['page'] = empty ( $get ['page'] ) ? 1 : $get ['page'];
		$this->load->library ( 'pagination' );
		$config ['num_links'] = 5;
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
		$config ['base_url'] = site_url ( 'teacher/teacher/show', array (
				'_r' => time () 
		) );
		$config ['total_rows'] = $this->teacher_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		$list = $this->teacher_model->getlist ( $option );
		$data ['list'] = $list;
		$data ['page'] = $pagination;
		$this->load->view ( 'teacher/show', $data );
	}
	function info($id) {
		if (empty ( $id )) {
			msgs ( '参数错误', site_url ( 'teacher/teacher/show' ) );
		}
		$info = $this->teacher_model->getinfo ( $id );
		if (! empty ( $info )) {
			$data ['info'] = $info;
			$data ['is_collect'] = $this->teacher_model->check_collect ( $id );
			$this->load->view ( 'teacher/info', $data );
		} else {
			msgs ( '您要访问的资讯不存在', site_url ( 'teacher/teacher/show' ) );
		}
	}
}
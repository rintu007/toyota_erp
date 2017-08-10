<?php
/**
 * Created by PhpStorm.
 * User: Shah Saqib
 * Date: 8/8/2017
 * Time: 12:18 AM
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


class Ffs extends CI_Controller {

    private $ffs;

    function __construct() {
        parent::__construct();
        $this->load->model('car_ffs');
        $this->load->library('form_validation');
        $this->ffs = new Car_ffs();
    }

    public function index()
    {
        $data['gpf'] = $this->ffs->get_gatepass();
//        var_dump($data['gpf']);die;
        $this->load->view('header');
        $this->load->view('ffslist.php',$data);
        $this->load->view('footer');
    }

    function create_ffs($idgatepass)
    {

        $data['id'] = $this->ffs->get_max_id();
//        var_dump( $data['id']);die;
        $data['gp'] = $this->ffs->get_gp_detail($idgatepass);
        $this->load->view('header');
        $this->load->view('ffs',$data);
        $this->load->view('footer');

    }

    function edit_ffs($id)
    {

        $data['ffs'] = $this->ffs->get_ffs($id);
        $data['ffsd'] = $this->ffs->get_ffs_detail($id);
        $data['gp'] = $this->ffs->get_gp_detail($data['ffs']->idGatePass);

        $this->load->view('header');
        $this->load->view('ffs_edit',$data);
        $this->load->view('footer');

    }

    function view_ffs($id)
    {

        $data['ffs'] = $this->ffs->get_ffs($id);
        $data['ffsd'] = $this->ffs->get_ffs_detail($id);
        $data['gp'] = $this->ffs->get_gp_detail($data['ffs']->idGatePass);

        $this->load->view('header');
        $this->load->view('ffs_view',$data);
        $this->load->view('footer');

    }

    function insert_ffs()
    {
        $id = $this->ffs->insert_ffs();
        $this->session->set_flashdata('message', "FFS no# $id has been inserted.");
        redirect(site_url('index.php/ffs/index'));
    }

    function update_ffs()
    {
        $id = $this->ffs->update_ffs($_POST['id']);
        $this->session->set_flashdata('message', "FFS no# $id has been Updated.");
        redirect(site_url('index.php/ffs/index'));
    }

}

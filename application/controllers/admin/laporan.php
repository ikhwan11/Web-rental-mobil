<?php 

class Laporan extends CI_Controller
{
	public function index()
	{
		
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/filter_laporan');
			$this->load->view('templates_admin/footer');
		}else{
			$data['laporan'] = $this->db->query("SELECT * FROM tb_transaksi tr , tb_mobil mb, tb_costumer cs WHERE tr.id_mobil = mb.id_mobil AND tr.id_costumer = cs.id_costumer AND date(tanggal_rental)>= '$dari' AND date(tanggal_rental)<= '$sampai'")->result();

			$this->load->view('templates_admin/header');
			$this->load->view('templates_admin/sidebar');
			$this->load->view('admin/tampilkan_laporan',$data);
			$this->load->view('templates_admin/footer');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('dari','Dari Tanggal','required');
		$this->form_validation->set_rules('sampai','Sampai Tanggal','required');
	}
}

 ?>
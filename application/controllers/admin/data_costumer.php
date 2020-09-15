<?php 

class Data_costumer extends CI_Controller
{
	public function index()
	{
		$data['costumer'] = $this->rental_model->get_data('tb_costumer')->result();

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/data_costumer', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_costumer()
	{
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_costumer');
		$this->load->view('templates_admin/footer');
	}

	public function tambah_costumer_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->tambah_costumer();
		}else{
			$nama 				= $this->input->post('nama');
			$username 			= $this->input->post('username');
			$alamat 			= $this->input->post('alamat');
			$gender 			= $this->input->post('gender');
			$no_telepon 		= $this->input->post('no_telepon');
			$no_ktp 			= $this->input->post('no_ktp');
			$password 			= md5($this->input->post('password'));

			$data = array(
				'nama'     		=> $nama,
				'username' 		=> $username,
				'alamat'   		=> $alamat,
				'gender'   		=> $gender,
				'no_telepon' 	=> $no_telepon,
				'no_ktp'    	=> $no_ktp,
				'password'  	=> $password

			);

			$this->rental_model->insert_data($data, 'tb_costumer');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Data costumer berhasil ditambahkan!.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/data_costumer');
			
		}
	}

	public function update_costumer($id)
	{
		$where = array('id_costumer' => $id);
		$data['costumer'] = $this->db->query("SELECT * FROM tb_costumer WHERE id_costumer = '$id'")->result();

		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_costumer',$data);
		$this->load->view('templates_admin/footer');

	}

	public function update_costumer_aksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->update_costumer();

		}else{
			$id 				= $this->input->post('id_costumer');
			$nama 				= $this->input->post('nama');
			$username 			= $this->input->post('username');
			$alamat 			= $this->input->post('alamat');
			$gender 			= $this->input->post('gender');
			$no_telepon 		= $this->input->post('no_telepon');
			$no_ktp 			= $this->input->post('no_ktp');
			$password 			= md5($this->input->post('password'));

			$data = array(
				'nama'     		=> $nama,
				'username' 		=> $username,
				'alamat'   		=> $alamat,
				'gender'   		=> $gender,
				'no_telepon' 	=> $no_telepon,
				'no_ktp'    	=> $no_ktp,
				'password'  	=> $password

			);

			$where = array(
				'id_costumer'    => $id

			);

			$this->rental_model->update_data('tb_costumer', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Data costumer berhasil diupdate!.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/data_costumer');
		}

	}

	public function delete_costumer($id)
	{
		$where = array('id_costumer' => $id);
		$this->rental_model->delete_data($where, 'tb_costumer');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  Data costumer berhasil dihapus!.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('admin/data_costumer');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('gender','Jenis Kelamin','required');
		$this->form_validation->set_rules('no_telepon','No. Telepon','required');
		$this->form_validation->set_rules('no_ktp','No. KTP','required');
		$this->form_validation->set_rules('password','Password','required');
	}
}


 ?>
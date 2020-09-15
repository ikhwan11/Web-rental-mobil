<?php 

class Transaksi extends CI_Controller
{
	public function index()
	{
		$costumer = $this->session->userdata('id_costumer');

		$data['transaksi'] = $this->db->query("SELECT * FROM tb_transaksi tr, tb_mobil mb, tb_costumer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_costumer = cs.id_costumer AND cs.id_costumer = '$costumer' ORDER BY id_rental DESC")->result();

		$this->load->view('templates_costumer/header');
		$this->load->view('costumer/transaksi', $data);
		$this->load->view('templates_costumer/footer');
	}
	public function pembayaran($id)
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM tb_transaksi tr, tb_mobil mb, tb_costumer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_costumer = cs.id_costumer AND tr.id_rental = '$id' ORDER BY id_rental DESC")->result();

		$this->load->view('templates_costumer/header');
		$this->load->view('costumer/pembayaran', $data);
		$this->load->view('templates_costumer/footer');
	}

	public function pembayaran_aksi()
	{
		$id      				=$this->input->post('id_rental');
		$bukti_pembayaran   	=$_FILES['bukti_pembayaran']['name'];

			if($bukti_pembayaran){
				$config ['upload_path'] 	= './assets/upload/';
				$config ['allowed_types']	= 'jpg|jpeg|png|pdf';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('bukti_pembayaran')){
					echo "bukti pembayaran Gagal di Upload!";
				}else {
					$bukti_pembayaran = $this->upload->data("file_name");
				}
			}

			$data = array(
				'bukti_pembayaran'    => $bukti_pembayaran,

			);

			$where = array (
					'id_rental'    => $id
			);

			$this->rental_model->update_data('tb_transaksi',$data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Bukti Pembayaran Berhasil di Upload!
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');
			redirect('costumer/transaksi');
	}

	public function cetak_invoice($id)
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM tb_transaksi tr, tb_mobil mb, tb_costumer cs WHERE tr.id_mobil=mb.id_mobil AND tr.id_costumer = cs.id_costumer AND tr.id_rental = '$id'")->result();

		$this->load->view('costumer/cetak_invoice', $data);
	}

	public function batal_transaksi($id)
	{
		$where = array('id_rental' => $id);
		$data = $this->rental_model->get_where($where, 'tb_transaksi')->row();

		$where2 = array('id_mobil' => $data->id_mobil);

		$data2 = array('status' => '1');

		$this->rental_model->update_data('tb_mobil', $data2, $where2);
		$this->rental_model->delete_data($where, 'tb_transaksi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Transaksi dibatalkan
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

		redirect('costumer/transaksi');
	}
}

 ?>
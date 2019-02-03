<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username')!="Admin-bj" || $this->session->userdata('role')!=-1 ){
			$this->session->set_flashdata('error','Maaf anda belum log in sebagain admin');	
				redirect('error');			
			}
		$this->load->model('model_users');
		$this->load->model('model_admin');
        $this->load->model('model_new');
		$this->load->model('demografi_model');
		$this->load->helper('text');
        $this->load->helper('form');
        $this->load->library('image_lib');
        $this->load->library('form_validation');
	}
	public function index()
	{
        $data['direktorat'] = $this->model_new->dir_data();
		$data['jawa'] = $this->model_admin->listjawa();	
		$data['jakarta'] = $this->model_admin->listjakarta();	
		$data['kalimantan'] = $this->model_admin->listkalimantan();	
		$data['sumatera'] = $this->model_admin->listsumatra();	
		$data['HO'] = $this->model_admin->listho();	
		$data['progres'] = $this->model_admin->progresHO();
		$data['progresbo'] = $this->model_admin->progresBO();
		$data['progresvparea'] = $this->model_admin->progresVPAREA();
		$data['progrescorporate'] = $this->model_admin->progrescorporate();
		//print_r($data['progres']);exit(); 
		$this->load->view('admin/dashboard_view',$data);
	}

	public function dashboard_warrior()
	{
         $data['direktorat'] = $this->model_new->dir_data();
		$data['jawa'] = $this->model_admin->listjawa();	
		$data['jakarta'] = $this->model_admin->listjakarta();	
		$data['kalimantan'] = $this->model_admin->listkalimantan();	
		$data['sumatera'] = $this->model_admin->listsumatra();	
		$data['HO'] = $this->model_admin->listho();	
		$data['progres'] = $this->model_admin->progresHO();
		$data['progresbo'] = $this->model_admin->progresBO();
		$data['progresvparea'] = $this->model_admin->progresVPAREA();
		$data['progrescorporate'] = $this->model_admin->progrescorporate();
		//print_r($data['progres']);exit(); 
		$this->load->view('admin/dashboard_warrior',$data);
	}
	public function dashboard_implementasi_budaya()
	{
         $data['direktorat'] = $this->model_new->dir_data();
		$data['jawa'] = $this->model_admin->listjawa();	
		$data['jakarta'] = $this->model_admin->listjakarta();	
		$data['kalimantan'] = $this->model_admin->listkalimantan();	
		$data['sumatera'] = $this->model_admin->listsumatra();	
		$data['HO'] = $this->model_admin->listho();	
		$data['progres'] = $this->model_admin->progresHO();
		$data['progresbo'] = $this->model_admin->progresBO();
		$data['progresvparea'] = $this->model_admin->progresVPAREA();
		$data['progrescorporate'] = $this->model_admin->progrescorporate();
		//print_r($data['progres']);exit(); 
		$this->load->view('admin/dashboard_implementasi_budaya',$data);
	}

	public function program()
	{
		$data['program'] = $this->model_admin->program();	
		//print_r($data); 
		$this->load->view('admin/list_program',$data);
	}
	public function tambah_program(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('desc');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/tambah_program');
		}
		else {
			$data_program = array(
								'cc_detail'			=> $this->input->post('program'),
								'cc_desc'			=> $this->input->post('deskripsi'),
								'start_month'		=> $this->input->post('waktu_pelaksanaan'),
								'end_month'			=> $this->input->post('batas_pelaksanaan'),
								'status'			=> $this->input->post('status')

						);
			//print_r($data_program);exit();
			$this->model_admin->tambah_program($data_program);
			redirect('admin/program'); 
			}
	}
	public function edit_program($id){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('desc');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/tambah_program');
		}
		else {
			$data_program = array(
								'cc_detail'			=> $this->input->post('program'),
								'cc_desc'			=> $this->input->post('deskripsi'),
								'start_month'		=> $this->input->post('waktu_pelaksanaan'),
								'end_month'			=> $this->input->post('batas_pelaksanaan'),
								'status'			=> $this->input->post('status')

						);
			//print_r($data_program);exit();
			$this->model_admin->update_program($id,$data_program);
			redirect('admin/program'); 
			}
	}

	public function delete_program($id){
		$this->model_admin->delete_program($id);
		redirect('admin/program');
	}	

	public function daftar_user()
	{
		$data['unit'] = $this->model_admin->listuser();	
		//print_r($data); 
		$this->load->view('admin/list_unit',$data);
	}

	public function tambah_user(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('username');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/tambah_unit');
		}
		else {
			$data_user = array(
								'username'			=> $this->input->post('username'),
								'password'			=> $this->input->post('password'),
								'role'				=> 1

						);
			//print_r($data_user);exit();
			$this->model_admin->tambah_user($data_user);
			redirect('admin/daftar_user'); 
			}
	}
	public function edit_user($id){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('username');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/tambah_user');
		}
		else {
			$data_user = array(
								'username'			=> $this->input->post('username'),
								'password'			=> $this->input->post('password')

						);
			//print_r($data_user);exit();
			$this->model_admin->update_user($id,$data_user);
			redirect('admin/daftar_user'); 
			}
	}
	public function delete_user($id){
		$this->model_admin->delete_user($id);
		redirect('admin/daftar_user');
	}	

	function progress_program($unit)
	{	
		$month = 7;
		//print_r($month);
		$data["unit"]=$unit;
		$user = $unit;
		$data['jumlahprogram']	= $this->model_users->jumlah_program_jalan();
		$data['nilairealisasi']	= $this->model_users->program_unit($unit);
		$data['program'] = $this->model_users->program_unit($unit);
		$data['programdefault'] = $this->model_users->program_jalan();
		$data['max'] = $this->model_users->max_bulan();
		/*if(!$data['nilairealisasi']) { $data['rerata'] =0; } else {
		$data['rerata'] = $data['nilairealisasi'][0]->Total/$data['jumlahprogram']; }*/
		//print_r($data['program']);exit();

		$this->load->view('admin/progress_program',$data);
	}
	function progress_evaluasi()
	{	
		$mydate=getdate(date("U"));
		$jam = date('H:i:s a');
		$date = "$mydate[month] $mydate[mday], $mydate[year] $jam";
		
		$data_pesan = array(
								'fb_sender'			=> $this->input->post('dari'),
								'fb_recipient'			=> $this->input->post('untuk'),	
								'fb_subject'			=> $this->input->post('subjek'),
								'fb_detail'			=> $this->input->post('pesan'),
								'last_modified'			=> $date,
								'status'			=> 'unread'


						);
		//print_r($data_pesan['fb_recipient']);exit();
		$this->model_admin->isi_evaluasi($data_pesan);
		
		$url=base_url()."admin/progress_program/".$data_pesan['fb_recipient'];
		//print_r($url);
		$message = "Pesan telah terkirim";
		echo "<script>
			alert('Pesan telah terkirim');
			window.location.href='".$url."';
			</script>";
		//redirect('admin/progress_program/'.$data_pesan['fb_recipient']);
	}
	

    function json(){
        $this->load->library('datatables');
        $this->datatables->select('*');
        $this->datatables->from('tb_pegawai');
        return print_r($this->datatables->generate());
    }

	public function add($unit) {
		$this->load->helper('form');
		$data['unit'] = $this->model_admin->find($unit);
		$this->load->view('admin/tambah_pertanyaan',$data);
		//print_r($data);
	}

	function daftar_warrior()
	{
		$data['warrior']=$this->model_admin->warrior();
		//print_r($data);exit();
		$this->load->view('admin/list_warrior',$data);
	}

	public function tambah_warrior(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('nopeg');
		
		if ($this->form_validation->run() == FALSE){
			$data['warrior']=$this->model_admin->warrior();
			$this->load->view('admin/list_warrior',$data);
		}
		else {
			$daftar_warrior = array(
								'nopeg'			=> $this->input->post('nopeg'),
								'unit'			=> $this->input->post('unit'),
								'direktorat'	=> $this->input->post('direktorat'),
								'status_aktif'	=> $this->input->post('status_aktif'),
								'email'			=> $this->input->post('email')

						);
			//print_r($daftar_warrior);exit();
			$this->model_admin->tambah_warrior($daftar_warrior);
			redirect('admin/daftar_warrior'); 
			}
	}
	public function edit_warrior($id){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('nopeg');
		
		if ($this->form_validation->run() == FALSE){
			$data['warrior']=$this->model_admin->warrior();
			$this->load->view('admin/list_warrior',$data);
		}
		else {
			$daftar_warrior = array(
								'nopeg'			=> $this->input->post('nopeg'),
								'unit'			=> $this->input->post('unit'),
								'direktorat'	=> $this->input->post('direktorat'),
								'status_aktif'	=> $this->input->post('status_aktif'),
								'email'			=> $this->input->post('email')

						);
			//print_r($daftar_warrior);exit();
			$this->model_admin->update_warrior($id,$daftar_warrior);
			redirect('admin/daftar_warrior'); 
			}
	}

	public function delete_warrior($id){
		$this->model_admin->delete_warrior($id);
		redirect('admin/daftar_warrior');
	}

	function daftar_tib()
	{
		$data['tib']=$this->model_admin->tib();
		//print_r($data);exit();
		$this->load->view('admin/list_tib',$data);
	}

	public function tambah_tib(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('nopeg');
		
		if ($this->form_validation->run() == FALSE){
			$data['tib']=$this->model_admin->tib();
			$this->load->view('admin/list_tib',$data);
		}
		else {
			$daftar_warrior= array(
								'nopeg'			=> $this->input->post('nopeg'),
								'posisi'		=> $this->input->post('posisi'),
								'unit'			=> $this->input->post('unit'),
								'direktorat'	=> $this->input->post('direktorat'),
								'status_aktif'	=> $this->input->post('status_aktif'),
								'email'			=> $this->input->post('email')

						);
			//print_r($daftar_warrior);exit();
			$this->model_admin->tambah_tib($daftar_warrior);
			redirect('admin/daftar_tib'); 
			}
	}

	public function edit_tib($id){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('nopeg');
		
		if ($this->form_validation->run() == FALSE){
			$data['tib']=$this->model_admin->tib();
			$this->load->view('admin/list_tib',$data);
		}
		else {
			$daftar_warrior= array(
								'nopeg'			=> $this->input->post('nopeg'),
								'posisi'			=> $this->input->post('posisi'),
								'unit'			=> $this->input->post('unit'),
								'direktorat'	=> $this->input->post('direktorat'),
								'status_aktif'	=> $this->input->post('status_aktif'),
								'email'			=> $this->input->post('email')

						);
			//print_r($daftar_warrior);exit();
			$this->model_admin->update_tib($id,$daftar_warrior);
			redirect('admin/daftar_tib'); 
			}
	}

	public function delete_tib($id){
		$this->model_admin->delete_tib($id);
		redirect('admin/daftar_tib');
	}

	public function upload_warrior(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('judul');
		
		$data['warrior']=$this->model_admin->warrior();
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/list_warrior',$data);
		}
		else {
			if($_FILES['userfile']['name'] != NULL){
				//form sumbit dengan gambar diisi
				//load uploading file library
				 $config['upload_path']   = './uploads/warrior/'; 
		         $config['allowed_types'] = 'xls|xlsx|csv'; 
		         $config['max_size']	= '2048';
		         $config['overwrite']	= true;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if ( !$this->upload->do_upload()){
						$error = array('error' => $this->upload->display_errors());
        			    //var_dump($error);
        			    $message = "File yang anda unggah tidak sesuai dengan format. Unggah data kembali.";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='".base_url("admin/daftar_warrior")."';</script>";
					}
					else {
						// jika berhasil upload ambil data dan masukkan ke database
		                $upload_data = $this->upload->data();

			            //  Include PHPExcel_IOFactory
						include 'PHPExcel/IOFactory.php';

						$inputFileName = $upload_data['full_path'];

						//  Read your Excel workbook
						try {
						    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
						    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
						    $objPHPExcel = $objReader->load($inputFileName);
						} catch(Exception $e) {
						    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
						}

						//  Get worksheet dimensions
						$sheet = $objPHPExcel->getSheet(0); 
						$highestRow = $sheet->getHighestRow(); 
						$highestColumn = $sheet->getHighestColumn();

						//  Loop through each row of the worksheet in turn
						for ($row = 2; $row <= $highestRow; $row++){ 
						    //  Read a row of data into an array
						    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
						                                    NULL,
						                                    TRUE,
						                                    FALSE);
						    //  Insert row data array into your database of choice here
						    //print_r($rowData[1]);
						    $this->model_admin->simpanwarrior($rowData);
						}
						
						//delete file
			            $file = $upload_data['file_name'];
			            $path = './uploads/warrior/' . $file;
			            unlink($path);

			            $message = "Data telah berhasil diperbaharui";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='".base_url("admin/daftar_warrior")."';</script>";
						}
					}
			//redirect('admin/data'); 
		}
	}

	public function upload_tib(){
		//sebelum mengeksekusi query
		$this->form_validation->set_rules('judul');
		
		$data['tib']=$this->model_admin->tib();
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/list_tib',$data);
		}
		else {
			if($_FILES['userfile']['name'] != NULL){
				//form sumbit dengan gambar diisi
				//load uploading file library
				 $config['upload_path']   = './uploads/tibwarrior/'; 
		         $config['allowed_types'] = 'xls|xlsx|csv'; 
		         $config['max_size']	= '2048';
		         $config['overwrite']	= true;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
					if ( !$this->upload->do_upload()){
						$error = array('error' => $this->upload->display_errors());
        			    //var_dump($error);
        			    $message = "File yang anda unggah tidak sesuai dengan format. Unggah data kembali.";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='".base_url("admin/daftar_tib")."';</script>";
					}
					else {
						// jika berhasil upload ambil data dan masukkan ke database
		                $upload_data = $this->upload->data();

			            //  Include PHPExcel_IOFactory
						include 'PHPExcel/IOFactory.php';

						$inputFileName = $upload_data['full_path'];

						//  Read your Excel workbook
						try {
						    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
						    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
						    $objPHPExcel = $objReader->load($inputFileName);
						} catch(Exception $e) {
						    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
						}

						//  Get worksheet dimensions
						$sheet = $objPHPExcel->getSheet(0); 
						$highestRow = $sheet->getHighestRow(); 
						$highestColumn = $sheet->getHighestColumn();

						//  Loop through each row of the worksheet in turn
						for ($row = 2; $row <= $highestRow; $row++){ 
						    //  Read a row of data into an array
						    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
						                                    NULL,
						                                    TRUE,
						                                    FALSE);
						    //  Insert row data array into your database of choice here
						    //print_r($rowData[1]);
						    $this->model_admin->simpantibwarrior($rowData);
						}
						
						//delete file
			            $file = $upload_data['file_name'];
			            $path = './uploads/tibwarrior/' . $file;
			            unlink($path);

			            $message = "Data telah berhasil diperbaharui";
						echo "<script type='text/javascript'>alert('$message');
						window.location.href='".base_url("admin/daftar_tib")."';</script>";
						}
					}
			//redirect('admin/data'); 
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin_login');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
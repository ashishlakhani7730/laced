<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class List_approve extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_list_approve');
    }
	
	public function index()
	{
		$data["approve_item_list"] = $this->m_list_approve->get_approve_item();
		//echo "<pre>"; print_r($data["approve_item_list"]); exit;
		$this->load->view("approve_item",$data);
	}
	
	public function more()
	{
		$itemid = $this->uri->segment(3);
		$data["item_list"] = $this->m_list_approve->moreitem($itemid);
		//echo "<pre>"; print_r($data["item_list"]); exit;
		$this->load->view("approve_item_only",$data);
	}
	
	public function accept_product()
	{
		$this->m_list_approve->accept_item($this->input->post("itemid"));
		$this->index();
	}

	public function changeimage()
	{
				if($_FILES['front']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['front']['name']);
						$oex = end($ex);
						
						$new_name = time()."frontpic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'Items/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('front'))
						{
							$this->session->set_flashdata('approve_fail_message', $this->upload->display_errors('', ''));
							//redirect('brand');
						}
						else
						{
							$newimg = $config['file_name'];
							$data = $this->m_list_approve->update_pic($this->input->post('itemid'),$newimg);
							
							$this->session->set_flashdata('message_approve', 'Your Brand Added Successfully!');

							
    						redirect('List_approve/more/'.$this->input->post('itemid'));
						}
				}
				else
				{
					$this->session->set_flashdata('approve_fail_message', 'Please Upload Once Agian!');
					redirect('List_approve/more/'.$this->input->post('itemid'));
				}
	}
	
	public function changeimage2()
	{
				if($_FILES['back']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['back']['name']);
						$oex = end($ex);
						
						$new_name = time()."Backpic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'Items/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('back'))
						{
							$this->session->set_flashdata('approve_fail_message', $this->upload->display_errors('', ''));
							//redirect('brand');
						}
						else
						{
							$newimg = $config['file_name'];
							$data = $this->m_list_approve->update_pic2($this->input->post('itemid'),$newimg);
							
							$this->session->set_flashdata('message_approve', 'Your Brand Added Successfully!');

							
    						redirect('List_approve/more/'.$this->input->post('itemid'));
						}
				}
				else
				{
					$this->session->set_flashdata('approve_fail_message', 'Please Upload Once Agian!');
					redirect('List_approve/more/'.$this->input->post('itemid'));
				}
	}
	
	public function changeimage3()
	{
				if($_FILES['side']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['side']['name']);
						$oex = end($ex);
						
						$new_name = time()."Sidepic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'Items/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('side'))
						{
							$this->session->set_flashdata('approve_fail_message', $this->upload->display_errors('', ''));
							//redirect('brand');
						}
						else
						{
							$newimg = $config['file_name'];
							$data = $this->m_list_approve->update_pic3($this->input->post('itemid'),$newimg);
							
							$this->session->set_flashdata('message_approve', 'Your Brand Added Successfully!');

							
    						redirect('List_approve/more/'.$this->input->post('itemid'));
						}
				}
				else
				{
					$this->session->set_flashdata('approve_fail_message', 'Please Upload Once Agian!');
					redirect('List_approve/more/'.$this->input->post('itemid'));
				}
	}
	
	public function changeimage4()
	{
				if($_FILES['tag']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['tag']['name']);
						$oex = end($ex);
						
						$new_name = time()."tagpic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'Items/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('tag'))
						{
							$this->session->set_flashdata('approve_fail_message', $this->upload->display_errors('', ''));
							//redirect('brand');
						}
						else
						{
							$newimg = $config['file_name'];
							$data = $this->m_list_approve->update_pic4($this->input->post('itemid'),$newimg);
							
							$this->session->set_flashdata('message_approve', 'Your Brand Added Successfully!');

							
    						redirect('List_approve/more/'.$this->input->post('itemid'));
						}
				}
				else
				{
					$this->session->set_flashdata('approve_fail_message', 'Please Upload Once Agian!');
					redirect('List_approve/more/'.$this->input->post('itemid'));
				}
	}
	
	public function changeimage5()
	{
				if($_FILES['box']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['box']['name']);
						$oex = end($ex);
						
						$new_name = time()."boxpic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'Items/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('box'))
						{
							$this->session->set_flashdata('approve_fail_message', $this->upload->display_errors('', ''));
							//redirect('brand');
						}
						else
						{
							$newimg = $config['file_name'];
							$data = $this->m_list_approve->update_pic5($this->input->post('itemid'),$newimg);
							
							$this->session->set_flashdata('message_approve', 'Your Brand Added Successfully!');

							
    						redirect('List_approve/more/'.$this->input->post('itemid'));
						}
				}
				else
				{
					$this->session->set_flashdata('approve_fail_message', 'Please Upload Once Agian!');
					redirect('List_approve/more/'.$this->input->post('itemid'));
				}
	}
}
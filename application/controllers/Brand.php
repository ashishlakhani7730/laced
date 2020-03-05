<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_brand');
    }

    public function index()
    {
    	if($this->session->userdata('Admin_Id'))
		{
			//echo "<pre>";print_r($data['brand_list']); exit;
			$data['brand_list'] = $this->m_brand->get_brand();
    		$this->load->view('brand',$data);
    	}
    	else
    	{
    		redirect('login');
    	}
    }
    public function delete_data() {

        $feedback = $this->m_brand->delete_brand($this->uri->segment(3));
        $this->session->set_flashdata('message_brand', 'Brand Delete Successfully...');
        redirect("brand/index");
    }
    public function addbrand()
    {
    	if($this->session->userdata('Admin_Id'))
		{
			//print_r($_FILES); exit;
    		if(empty($_FILES['brandi']['name']))
			{
				$this->form_validation->set_rules('brandi', 'brand Image', 'required');
			}

				$this->form_validation->set_rules('brand', 'brand Name', 'required|min_length[3]|max_length[256]|regex_match[/^[a-zA-Z\s]*$/]',array('regex_match'=>'Enter Only Characters In Brand Name!'));

			 if($this->form_validation->run() == FALSE) 
			 {
				$data['brand_list'] = $this->m_brand->get_brand();
    			$this->load->view('brand',$data);
			 }
			 else
			 {
				if($_FILES['brandi']['error'] == 0)
				{
						//upload and update the file
						$ex = explode(".",$_FILES['brandi']['name']);
						$oex = end($ex);
						
						$new_name = time()."brandpic.".$oex;					
						$config['file_name'] = $new_name;
						$config['upload_path'] = 'uploads/brand/';
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['max_size']	= '2048000';// // Can be set to particular file size , here it is 2

						$this->load->library('upload', $config);

						if(!$this->upload->do_upload('brandi'))
						{
							$this->session->set_flashdata('brand_fail_message', $this->upload->display_errors('', ''));
							redirect('brand');
						}
						else
						{
							$added_brand = array(
											'Brand_Name' => $this->input->post('brand'),
											'Brand_Logo' => "uploads/brand/".$config['file_name']
										   );

							$data = $this->m_brand->add_brand($added_brand);
							
							$this->session->set_flashdata('message_brand', 'Your Brand Added Successfully!');

							
    						redirect('brand');
						}
				}
				else
				{
					$this->session->set_flashdata('brand_fail_message', 'Please Upload Once Agian!');
					redirect('brand');
				}
			}
    	}
    	else
    	{
    		redirect('login');
    	}
    }

    public function update_data($Brand_Id) {
        if ($this->session->userdata('Admin_Id')) {
            $update_datas = $this->m_brand->edit_data($Brand_Id);
            $this->load->view('update_brand', ['update_datas' => $update_datas]);
        } else {
            redirect('login');
        }
    }

    public function finallyupdate() {
        if ($this->session->userdata('Admin_Id')) {
            $Brand_Logo = $this->input->post('Brand_Logo');
            $Brand_Name = $this->input->post('Brand_Name');
            $Brand_Id = $this->input->post('Brand_Id');

            if (empty($_FILES['brandi']['name'])) {
                $added_brand = array(
                    'Brand_Name' => $Brand_Name,
                    'Brand_Logo' => $Brand_Logo
                );

                $data = $this->m_brand->update_brand($added_brand, $this->input->post('Brand_Id'));

                $this->session->set_flashdata('message_brand', 'Your Brand Update Successfully!');
                redirect('brand');
            } else {

                if ($_FILES['brandi']['error'] == 0) {
                    //upload and update the file
                    $ex = explode(".", $_FILES['brandi']['name']);
                    $oex = end($ex);

                    $new_name = time() . "brandpic." . $oex;
                    $config['file_name'] = $new_name;
                    $config['upload_path'] = 'uploads/brand/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['overwrite'] = false;
                    $config['remove_spaces'] = true;
                    $config['max_size'] = '2048000'; // // Can be set to particular file size , here it is 2

                    $this->load->library('upload', $config);


                    if (!$this->upload->do_upload('brandi')) {
                        $this->session->set_flashdata('brand_fail_message', $this->upload->display_errors('', ''));
                        redirect('brand');
                    } else {
                        $added_brand = array(
                            'Brand_Name' => $Brand_Name,
                            'Brand_Logo' => "uploads/brand/" . $config['file_name']
                        );

                        $data = $this->m_brand->update_brand($added_brand, $Brand_Id);
                        if (file_exists($Brand_Logo)) {
                            unlink($Brand_Logo);
                        }
                        $this->session->set_flashdata('message_brand', 'Your Brand Update Successfully!');


                        redirect('brand');
                    }
                }
            }
        } else {
            redirect('login');
        }
    }

}
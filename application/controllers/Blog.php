<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller
{
  private $about_data;
  private $data = [];

  function __construct()
  {
      parent::__construct();
      $this->load->model('blog_model');
      $this->load->helper('url');
      $this->load->library('parser');
      
      $this->data['about'] = array('about_info'=>array('blog_name' => 'Just a {code} blog', 'blog_subtitle' => '', 'author_name' => 'Theodoros', 'bio'=>'Hi! I am a self-taught developer, certified medical radiologist and a Linux lover. Check out my personal website <a class="link-blue" href="http://theodoros.info" target="_blank">theodoros.info</a> or tweet me <a class="link-blue" href="https://twitter.com/kouna_to" target="_blank">@kouna_to</a>'));
      $this->data['latest'] = $this->blog_model->get_latest_posts(5);
      $this->data['total_pages']=ceil($this->blog_model->count_post()/5);
  }

  function index()
  {    
    $this->load_data();
  }

  public function view($slug = 0)
  {
    $this->load_data($slug);
  }

  private function load_data($id = 0)
  {
    
    // Load post data
    $this->data['posts'] = $this->blog_model->get_initial_posts($id);

    // Show pager if we are in main blog page
    $this->data['show_pager'] = $id;

    // Send page number to page 1->default
    $this->data['current_page'] = 1;

    // Load index file with $data
    $this->parser->parse('blog/index', $this->data);

  }

  function load_page($pagenum = 0)
  {
    
    if($pagenum<=0)die();

    // Calculate the the offset
    $offset = ($pagenum-1)*5;

    // Get data from DB
    $this->data['posts'] = $this->blog_model->get_initial_posts(0, $offset);

    // Show pager if we are in main blog page
    $this->data['show_pager'] = 0;

    $this->data['current_page'] = $pagenum;
    if($pagenum!==1) {
      $this->data['previous_page'] =$pagenum-1;
    }

    $this->parser->parse('blog/index', $this->data);
  }

  function add_new_entry()
  {
      $this->load->helper('form');
      $this->load->library(array('form_validation','session'));

      //set validation rules
      $this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
      $this->form_validation->set_rules('entry_body', 'Body', 'required|xss_clean');

      if ($this->form_validation->run() == FALSE)
      {
          //if not valid
          $this->load->view('blog/add_new_entry');
      }
      else
      {
          //if valid
          $name = $this->input->post('entry_name');
          $body = $this->input->post('entry_body');
          $this->blog_model->add_new_entry($name,$body);
          $this->session->set_flashdata('message', '1 new entry added!');
          redirect('blog/add_new_entry');
      }
  }
}
 
/* End of file blog.php */
/* Location: ./application/controllers/blog.php */

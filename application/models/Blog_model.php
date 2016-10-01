<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function get_initial_posts($id,$offset = 0, $pagesize = 5)
    {
        // Turn off cache
        $this->db->cache_off();
        
        $tags_html = '';
        
        // Where clause 
        if($id!==0) {
          $this->db->where('entry_id', $id);
        }

        // Order by
        $this->db->order_by('entry_id', 'DESC');

        // Fetch data from DB
        $query = $this->db->get('entry', $pagesize, $offset);

        foreach ($query->result() as $row) {    
          $tags=explode(',',$row->entry_tags);
          foreach($tags as $tag) {
            $tags_html.='<a href="/tags/'.$tag.'" >'.$tag.'</a> ';
          }

          $data[] = array(
            'entry_id'  =>  $row->entry_id,
            'entry_name' => $row->entry_name,
            'entry_date' => $row->entry_date,
            'entry_body' => $row->entry_body,
            'entry_body_summary' => $this->summarise($row->entry_body).'...<a class="read-more" href="/index.php/blog/'.$row->entry_id.'">Read More</a>',
            'entry_author'=> $row->entry_author,
            'entry_tags' => $tags_html
          );
          $tags_html='';
        }        
        return $data;

        //return $query->result();
    }
    
    /*
    *   Count total posts in DB. Needed for calculating total pages in pagination
    *   @param none
    *   @return integer
    */
    function count_post()
    {
        return $this->db->count_all_results('entry');
    }

    /*
    *   Retun last posts from DB
    *   @param $itemsCount integer The number of last posts to return
    *   @return array Return an array containing last posts
    */
    function get_latest_posts($itemsCount)
    {
        $this->db->cache_off();
        $this->db->order_by('entry_id', 'DESC');
        $query = $this->db->get('entry', $itemsCount);
        return $query->result_array();
    }
    
    function summarise($data, $word_count = 55) 
    {   
        //If data start with a tag, then none is displayed. Bug?
        preg_match("/(?:\w+(?:\W+|$)){0,$word_count}/", $data, $matches);
        return $matches[0];
    }

}
 
/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */
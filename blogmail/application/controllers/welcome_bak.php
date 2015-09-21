<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
error_reporting(~0);


class welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->database();
	}
    
    public function get_append()
    {
        $this->db->order_by("id", "random");
		$query = $this->db->get('appendtext', 1, 0);
        $query_data = $query->result_array();
        
        if(count($query_data)>0){
			$append = $query_data[0];
            return ( $append['append'] );
		}
		else 
			return;
    }
    
    public function insertArticle()
    {
        $messate = $this->input->post('editor1');
        $subject = $this->input->post('subject');
        $limited = $this->input->post('limited');

        if(strlen($messate)<10)
            return;

        if($limited){
            $this->db->order_by("id", "random");
            $this->db->select('email,id, url');
            $query = $this->db->get('website',$limited,0);            
        }
        else{
            $this->db->select('email,url');
            $query = $this->db->get('website');
        }
        
        $query_data = $query->result_array();
        //print_r($query_data);
        //exit;
        
        for($i=0;$i<count($query_data);$i=$i+1)
        {
            echo "$i  ";
            echo $query_data[$i]['email'] . " " . $query_data[$i]['url'];
            echo "<br />";
            
            $data = array(
               'to' => $query_data[$i]['email'] ,
               'subject' => $subject ,
               'message' => $messate
            );

            $this->db->insert('jobs', $data); 
        }
        echo "insertArticle done";
    }
	
	public function post_blog()
	{
		$this->db->order_by("id", "random");
		$query = $this->db->get('jobs', 1, 0);
		$query_data = $query->result_array();
		//print_r($query_data);
		//exit;
		
		if(count($query_data)>0){
			$job = $query_data[0];
		}
		else 
			return;

		$config = Array(   //pixnet ok
			'protocol'  => 'sendmail',
			'mailtype'  => 'html',
			//'smtp_host' => $job['server'],
			//'smtp_port' => $job['port'],
			//'smtp_user' => $job['account'],
			//'smtp_pass' => $job['pass'],
			'starttls'  => false,
			'newline'   => "\r\n"
		);
		
/*
		$config = Array(   //smtp
			'protocol'  => 'smtp',
			'mailtype'  => 'html',
			'smtp_host' => $job['server'],
			'smtp_port' => $job['port'],
			'smtp_user' => $job['account'],
			'smtp_pass' => $job['pass'],
			'starttls'  => false,
			'newline'   => "\r\n"
		);	
		 
		
		$config = Array( //gmail
			'protocol'  => 'smtp',
			'mailtype'  => 'html',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => '465',
			'smtp_user' => 'puper.hdd@gmail.com',
			'smtp_pass' => 'puper0120',
			'starttls'  => true,
			'newline'   => "\r\n"
		);
*/		
		$this->load->library('email',$config);

		$this->email->from('puperchang@gmail.com', 'jonson');
		$this->email->to($job['to']); 
		$this->email->cc('puperchang@gmail.com'); 
		$this->email->subject($job['subject'] . " " .time() );
		$this->email->message($job['message'] . "<br />" . $this->get_append() ."<br />" .time()); 
		$this->email->send();
		echo $this->email->print_debugger();
//        echo $job['message'] . "<br />" . $this->get_append() ."<br />" .time() ;
        
        $this->db->delete('jobs', array('id' => $job['id'])); 
	}
	
	public function index()
	{
		$this->load->view('main');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
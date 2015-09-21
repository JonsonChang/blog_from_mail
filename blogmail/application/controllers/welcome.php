<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//主程式
ini_set('display_errors', 1);
error_reporting(~0);


error_reporting(E_ALL);


class welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->model('db_model');
		$this->load->helper('url');
        $this->load->database();
	}
    
    public function web_list($page=0)
    {
        $list = $this->db_model->get_web_list($page,10);
		$data['web_list'] = $list["query_data"];
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("welcome/web_list");
		$config['total_rows'] = $list["total"];
		$config['per_page'] = 10; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('web_list',$data);    
    }
    
    public function append_list($page=0)
    {
        $list = $this->db_model->get_append_list($page,10);
		$data['append_list'] = $list["query_data"];
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("welcome/append_list");
		$config['total_rows'] = $list["total"];
		$config['per_page'] = 10; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('append_list',$data);    
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
            $this->db->select('email,id, url,account,password,xmlrpc_url');
            $query = $this->db->get('website',$limited,0);            
        }
        else{
            $this->db->select('email,url,account,password,xmlrpc_url');
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
               'message' => $messate,
               'account' => $query_data[$i]['account'],
               'pass' => $query_data[$i]['password'],
               'xmlrpc_url' => $query_data[$i]['xmlrpc_url'],
            );

            $this->db->insert('jobs', $data); 
        }
        echo "insertArticle done";
    }

  
    public function test()
    {
        
    
        $url="http://api.pixnet.cc/blog/xmlrpc";
        $username = "a6299314";
        $password = "puper0120";
        $blog =null;
       
       
        $this->load->library('xmlrpc');
        $this->xmlrpc->server($url);
        $this->xmlrpc->method('blogger.getUsersBlogs');

        $request = array('0123456789ABCDEF',$username, $password);
        $this->xmlrpc->request($request);
        
        //发送请求
        if ( ! $this->xmlrpc->send_request()){
            echo $this->xmlrpc->display_error();
            return;
        }
        
        //打印结果看一看
        $response = $this->xmlrpc->display_response();
        $blog["blogid"] = $response[0]["blogid"];
        echo "<pre>";
        print_r( $response);
        print_r($blog);
        echo "</pre>";

    /*****new post***********************/        
    $this->xmlrpc->method('metaWeblog.newPost');
    $article = array (
                   array(
                        'title' => array("title test",'string'),
                        'description' => array("content test",'string'),
                        //'mt_text_more' => array('mt_text_more','string'),
                        //'mt_keywords' => array('mt_keywords','string'),
                        ),
                 'struct'
               );    
    
        $request = array($blog["blogid"],$username, $password,$article,true);
        $this->xmlrpc->request($request);
        
        
        //发送请求
        if ( ! $this->xmlrpc->send_request()){
            echo $this->xmlrpc->display_error();
            return;
        }
        
        //打印结果看一看
        $response = $this->xmlrpc->display_response();
        echo "<pre>";
        print_r( $response);
        echo "</pre>";

    }
    
    public function post_blog()
    {
        
        $this->db->order_by("id", "random");
		$query = $this->db->get('jobs', 1, 0);
		$query_data = $query->result_array();
		
		if(count($query_data)>0){
			$job = $query_data[0];
		}
		else 
			return;       

        //print_r($job);
        //exit;
    
        echo $url=$job['xmlrpc_url'];       echo "<br />";
        echo $username = trim($job['account']);   echo "<br />";
        echo $password = trim($job['pass']);      echo "<br />";
        $blog =null;
        
        if(strlen($url) < 5){
            $this->db->delete('jobs', array('id' => $job['id'])); 
            return;       
        }
       
        $this->load->library('xmlrpc');
        $this->xmlrpc->server($url);
        $this->xmlrpc->method('blogger.getUsersBlogs');

        $request = array('',$username, $password);
        $this->xmlrpc->request($request);
        
        //发送请求
        if ( ! $this->xmlrpc->send_request()){
            echo $this->xmlrpc->display_error();
            return;
        }
        
        //打印结果看一看
        $response = $this->xmlrpc->display_response();
        $blog["blogid"] = $response[0]["blogid"];
        echo "<pre>";
        print_r( $response);
        print_r($blog);
        echo "</pre>";

    /*****new post***********************/        
    $this->xmlrpc->method('metaWeblog.newPost');
    $article = array (
                   array(
                        'title' => array($job['subject'],'string'),
                        'description' => array($job['message'] . $this->get_append() ,'string'),
                        //'mt_text_more' => array('mt_text_more','string'),
                        //'mt_keywords' => array('mt_keywords','string'),
                        ),
                 'struct'
               );    
    
        $request = array($blog["blogid"],$username, $password,$article,true);
        $this->xmlrpc->request($request);
        
        
        //发送请求
        if ( ! $this->xmlrpc->send_request()){
            echo $this->xmlrpc->display_error();
            return;
        }
        
        //打印结果看一看
        $response = $this->xmlrpc->display_response();
        echo "<pre>";
        print_r( $response);
        echo "</pre>";

        $this->db->delete('jobs', array('id' => $job['id'])); 
    }

    
	
	public function post_blog_email()
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

/*
		$config = Array(   //pixnet ok
			'protocol'  => 'sendmail',//smtp , sendmail
			'mailtype'  => 'html',
			//'smtp_host' => 'www.ingrasys.com',
			//'smtp_port' => 25,
			//'smtp_user' => 'jonsonchang@ingrasys.com',
			'smtp_pass' => 'puper0120',
			'starttls'  => false,
			'newline'   => "\r\n"
		);
*/		
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
*/
        

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

        $mailbody = $job['message'] . "<br />" . $this->get_append() ;

		$this->load->library('email',$config);

		$this->email->from('puper.hdd@gmail.com', 'puper.hdd');  //.time()
		$this->email->to($job['to']); 
        //$this->email->to("pajm7661@pajm7661.pixnet.net"); 
		$this->email->cc('jonsonchang@ingrasys.com');
		$this->email->subject($job['subject'] );
		$this->email->message($mailbody); 
		$this->email->send();
		echo $this->email->print_debugger();
        
        $this->db->delete('jobs', array('id' => $job['id'])); 
	}
	
    public function do_add_append()
	{
        $message = $this->input->post('editor1');
        
        $data = array(
               'append' => $message
        );

        $this->db->insert('appendtext', $data); 
        $this->load->view('addappend');
	}
    
    public function addappend()
	{
		$this->load->view('addappend');
	}
	public function index()
	{
		$this->load->view('main');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
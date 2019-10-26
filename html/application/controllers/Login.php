<?
    class Login extends CI_Controller {									// Jangbuo클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("login_m");								// 모델 login_m 연결
			$this->load->helper(array("url","date"));              // Helper 선언
			$this->load->library('session');
			date_default_timezone_set("Asia/Seoul");         // 지역설정
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
			if($this->session->userdata('rank')!=1) redirect("/~four13");
		}
        public function check()
        {
			$uid=$this->input->post("uid", true);
			$pwd=$this->input->post("pwd", true);

			$row=$this->login_m->getrow($uid,$pwd);
			if ($row)
			{
				$data=array(
					"uid" =>$row->uid13,
					"rank"=>$row->rank13
				);
				$this->session->set_userdata($data);
			}

			$this->load->view("main_header");
			$this->load->view("main_footer");
		}

		public function logout()
		{
			$data=array('uid', 'rank');
			$this->session->unset_userdata($data);

			$this->load->view('main_header');
			$this->load->view('main_footer');
		}
	}
?>

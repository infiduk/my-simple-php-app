<?
    class Monthly extends CI_Controller {									// Jangbuo클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("monthly_m");								// 모델 monthly_m 연결
			$this->load->library("pagination");
			$this->load->library('upload');
			$this->load->helper(array("url","date"));              // Helper 선언
			date_default_timezone_set("Asia/Seoul");         // 지역설정
			$today=date("Y");                                        // 오늘날짜
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
            $this->lists();																// list 함수 호출
        }
        public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y");
			$base_url = "/monthly/lists/text1/$text1/page";

			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url = "/~four13". $base_url;
			
			$config["per_page"]	 = 5;                              // 페이지당 표시할 line 수
			$config["total_rows"] = $this->monthly_m->rowcount($text1);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;		 // 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;                // 기본 URL
			$this->pagination->initialize($config);           // pagination 설정 적용
			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			
			$data["list"]=$this->monthly_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기
			$this->	load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("monthly_list",$data);       // monthly_list에 자료전달
			$this->load->view("main_footer");             // 하단 출력 
        }
	}
?>

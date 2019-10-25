<?
    class Gubun extends CI_Controller {									// Gubun클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("gubun_m");								// 모델 Gubun_m 연결
			$this->load->library("pagination");
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
            $this->lists();																// list 함수 호출
        }
		function updaterow( $row, $no )
		{
			$where=array( "no"=>$no );
			return $this->db->update( "gubun", $row, $where );
		}
        public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1=array_key_exists("text1",$uri_array) ? "" . urldecode($uri_array["text1"]) : "";  
			$data["text1"]=$text1;

			if ($text1=="") 
				$base_url = "/gubun/lists/page";                        // $page_segment = 4;
			else 
				$base_url = "/gubun/lists/text1/$text1/page";    // $page_segment = 6;
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url = "/~four13". $base_url;

			$config["per_page"]	 = 5;                              // 페이지당 표시할 line 수
			$config["total_rows"] = $this->gubun_m->rowcount($text1);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;		 // 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;                // 기본 URL
			$this->pagination->initialize($config);           // pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			$data["list"]=$this->gubun_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기

			$this->	load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("gubun_list",$data);       // gubun_list에 자료전달
			$this->load->view("main_footer");             // 하단 출력 
        }
		public function view() {
			$uri_array=$this->uri->uri_to_assoc(3);
			$no	= array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "" ;
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$data["page"] = $page;
			$data["row"] = $this->gubun_m->getrow($no);
			$this->load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("gubun_view",$data);
			$this->load->view("main_footer");             // 하단 출력 
		}
		public function del()
		{
			$this->load->helper(array("url", "date"));    //  helper 선언
			$uri_array=$this->uri->uri_to_assoc(3);
			$no=array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$this->gubun_m->deleterow($no);
			redirect("gubun/lists/". $text1 .$page);										// 목록화면으로 돌아가기
		}
		public function add()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("name","이름","required|max_length[20]");
			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			if ( $this->form_validation->run()==FALSE )
			{
				$this->load->view("main_header");
				$this->load->view("gubun_add");    // 입력화면 표시
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$name13 = $this->input->post("name",true);
				$data13 = array(
					'name13' => $name13,
				);
				$this->gubun_m->insertrow($data13); 

				redirect("gubun/lists". $text1 .$page);										//   목록화면으로 이동.
			}
		}
		public function edit()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("name","이름","required|max_length[20]");
			
			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;
			$data["row"] = $this->gubun_m->getrow($no);

			if ($this->form_validation->run()==FALSE)		// 수정버튼 클릭한 경우																
			{
				$this->load->view("main_header");
				$data["row"]=$this->gubun_m->getrow($no);
				$this->load->view("gubun_edit",$data);
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$name13 = $this->input->post("name",true);
				$data13 = array(
					'name13' => $name13,
				);
				$this->gubun_m->updaterow($data13, $no); 

				redirect("gubun/lists". $text1. $page);										//   목록화면으로 이동.
			}
		}
	}
?>

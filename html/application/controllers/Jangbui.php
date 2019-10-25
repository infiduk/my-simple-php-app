<?
    class Jangbui extends CI_Controller {									// Jangbui클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("jangbui_m");								// 모델 jangbui_m 연결
			$this->load->library("pagination");
			$this->load->library('upload');
			$this->load->helper(array("url","date"));              // Helper 선언
			date_default_timezone_set("Asia/Seoul");         // 지역설정
			$today=date("Y-m-d");                                        // 오늘날짜
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
            $this->lists();																// list 함수 호출
        }
		function updaterow( $row, $no )
		{
			$where=array( "no"=>$no );
			return $this->db->update( "jangbui", $row, $where );
		}
        public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y-m-d") ;
			$base_url = "/jangbui/lists/text1/$text1/page";

			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url = "/~four13". $base_url;
			$config["per_page"]	 = 5;                              // 페이지당 표시할 line 수
			$config["total_rows"] = $this->jangbui_m->rowcount($text1);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;		 // 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;                // 기본 URL
			$this->pagination->initialize($config);           // pagination 설정 적용
			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			$data["list"]=$this->jangbui_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기
			$this->	load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("jangbui_list",$data);       // jangbui_list에 자료전달
			$this->load->view("main_footer");             // 하단 출력 
        }
		public function view() {
			$uri_array=$this->uri->uri_to_assoc(3);
			$no	= array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "" ;
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$data["page"] = $page;
			$data["row"] = $this->jangbui_m->getrow($no);
			$this->load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("jangbui_view",$data);
			$this->load->view("main_footer");             // 하단 출력 
		}
		public function del()
		{
			$this->load->helper(array("url", "date"));    //  helper 선언
			$uri_array=$this->uri->uri_to_assoc(3);
			$no=array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$this->jangbui_m->deleterow($no);
			redirect("jangbui/lists/". $text1 .$page);										// 목록화면으로 돌아가기
		}
		public function add()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("writeday","날짜","required");
			$this->form_validation->set_rules("product_no","제품명","required");

			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			if ( $this->form_validation->run()==FALSE )
			{
				$data["list"]=$this->jangbui_m->getlist_product();
				$this->load->view("main_header");
				$this->load->view("jangbui_add", $data);    // 입력화면 표시
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$io = 0;
				$writeday = $this->input->post("writeday",true);
				$product_no = $this->input->post("product_no",true);
				$price = $this->input->post("price",true);
				$numi = $this->input->post("numi",true);
				$numo = 0;
				$prices = $this->input->post("prices",true);
				$bigo = $this->input->post("bigo",true);
				$data13 = array(
					'io13' => $io,
					'writeday13' => $writeday,
					'product_no13' => $product_no,
					'price13' => $price,
					'numi13' => $numi,
					'numo13' => $numo,
					'prices13' => $prices,
					'bigo13' => $bigo);
				
				$this->jangbui_m->insertrow($data13); 

				redirect("jangbui/lists". $text1 .$page);										//   목록화면으로 이동.
			}
		}
		public function edit()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("writeday","날짜","required");
			$this->form_validation->set_rules("product_no","제품명","required");

			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;
			$data["row"] = $this->jangbui_m->getrow($no);

			if ($this->form_validation->run()==FALSE)		// 수정버튼 클릭한 경우																
			{
				$data["list"]=$this->jangbui_m->getlist_product();
				$this->load->view("main_header");
				$data["row"]=$this->jangbui_m->getrow($no);
				$this->load->view("jangbui_edit",$data);
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$io = 0;
				$writeday = $this->input->post("writeday",true);
				$product_no = $this->input->post("product_no",true);
				$price = $this->input->post("price",true);
				$numi = $this->input->post("numi",true);
				$numo = 0;
				$prices = $this->input->post("prices",true);
				$bigo = $this->input->post("bigo",true);
				$data13 = array(
					'io13' => $io,
					'writeday13' => $writeday,
					'product_no13' => $product_no,
					'price13' => $price,
					'numi13' => $numi,
					'numo13' => $numo,
					'prices13' => $prices,
					'bigo13' => $bigo);
				
				$this->jangbui_m->updaterow($data13, $no); 

				redirect("jangbui/lists". $text1. $page);										//   목록화면으로 이동.
			}
		}
	}
?>

<?
    class Product extends CI_Controller {									// Product클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("product_m");								// 모델 Product_m 연결
			$this->load->library("pagination");
			$this->load->library('upload');
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
            $this->lists();																// list 함수 호출
        }
		function updaterow( $row, $no )
		{
			$where=array( "no"=>$no );
			return $this->db->update( "product", $row, $where );
		}
        public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1=array_key_exists("text1",$uri_array) ? "" . urldecode($uri_array["text1"]) : "";  
			$data["text1"]=$text1;

			if ($text1=="") 
				$base_url = "/product/lists/page";                        // $page_segment = 4;
			else 
				$base_url = "/product/lists/text1/$text1/page";    // $page_segment = 6;
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url = "/~four13". $base_url;
			$config["per_page"]	 = 5;                              // 페이지당 표시할 line 수
			$config["total_rows"] = $this->product_m->rowcount($text1);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;		 // 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;                // 기본 URL
			$this->pagination->initialize($config);           // pagination 설정 적용
			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			$data["list"]=$this->product_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기
			$this->	load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("product_list",$data);       // product_list에 자료전달
			$this->load->view("main_footer");             // 하단 출력 
        }
		public function view() {
			$uri_array=$this->uri->uri_to_assoc(3);
			$no	= array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "" ;
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$data["page"] = $page;
			$data["row"] = $this->product_m->getrow($no);
			$this->load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("product_view",$data);
			$this->load->view("main_footer");             // 하단 출력 
		}
		public function del()
		{
			$this->load->helper(array("url", "date"));    //  helper 선언
			$uri_array=$this->uri->uri_to_assoc(3);
			$no=array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$this->product_m->deleterow($no);
			redirect("product/lists/". $text1 .$page);										// 목록화면으로 돌아가기
		}
		public function add()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("gubun_no","구분명","required");
			$this->form_validation->set_rules("name","이름","required|max_length[50]");
			$this->form_validation->set_rules("price","단가","required|numeric");

			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			if ( $this->form_validation->run()==FALSE )
			{
				$data["list"]=$this->product_m->getlist_gubun();
				$this->load->view("main_header");
				$this->load->view("product_add", $data);    // 입력화면 표시
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$gubun_no = $this->input->post("gubun_no",true);
				$name13 = $this->input->post("name",true);
				$price13 = $this->input->post("price",true);
				$jaego13 = $this->input->post("jaego",true);
				$data13 = array(
					'gubun_no13' => $gubun_no,
					'name13' => $name13,
					'price13' => $price13,
					'jaego13' => $jaego13);

				$picname=$this->product_m->call_upload();
				if($picname) $data13["pic13"]=$picname;
				
				$this->product_m->insertrow($data13); 

				redirect("product/lists". $text1 .$page);										//   목록화면으로 이동.
			}
		}
		public function edit()
		{
			$this->load->helper(array("url", "date"));
			$this->load->library("form_validation");
			$this->form_validation->set_rules("gubun_no","구분명","required");
			$this->form_validation->set_rules("name","이름","required|max_length[50]");
			$this->form_validation->set_rules("price","단가","required|numeric");

			$uri_array=$this->uri->uri_to_assoc(3);
			$no    =array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;
			$data["row"] = $this->product_m->getrow($no);

			if ($this->form_validation->run()==FALSE)		// 수정버튼 클릭한 경우																
			{
				$data["list"]=$this->product_m->getlist_gubun();
				$this->load->view("main_header");
				$data["row"]=$this->product_m->getrow($no);
				$this->load->view("product_edit",$data);
				$this->load->view("main_footer");
			}
			else																						// 입력화면의 저장버튼 클릭한 경우
			{
				$gubun_no = $this->input->post("gubun_no",true);
				$name13 = $this->input->post("name",true);
				$price13 = $this->input->post("price",true);
				$jaego13 = $this->input->post("jaego",true);
				$data13 = array(
					'gubun_no13' => $gubun_no,
					'name13' => $name13,
					'price13' => $price13,
					'jaego13' => $jaego13);

				$picname=$this->product_m->call_upload();
				if($picname) $data13["pic13"]=$picname;

				$this->product_m->updaterow($data13, $no); 

				redirect("product/lists". $text1. $page);										//   목록화면으로 이동.
			}
		}
		public function cal_jaego()
		{
			$this->load->helper(array("url", "date"));    //  helper 선언
			$uri_array=$this->uri->uri_to_assoc(3);
			$no=array_key_exists("no",$uri_array) ? $uri_array["no"] : "" ;
			$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$this->product_m->cal_jaego();
			redirect("product/lists". $text1. $page);
		}
	}
?>

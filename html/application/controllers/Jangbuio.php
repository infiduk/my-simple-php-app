<?
    class Jangbuio extends CI_Controller {									// Jangbuo클래스 선언
        function __construct()														// 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();											// 데이터베이스 연결
            $this->load->model("jangbuio_m");								// 모델 jangbuio_m 연결
			$this->load->library("pagination");
			$this->load->library('upload');
			$this->load->library('PHPExcel');
			$this->load->helper(array("url","date"));              // Helper 선언
			date_default_timezone_set("Asia/Seoul");         // 지역설정
			$today=date("Y-m-d");                                        // 오늘날짜
        }
        public function index()														// 제일 먼저 실행되는 함수	
        {
            $this->lists();																// list 함수 호출
        }
        public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y-m-d", strtotime("-1 month"));
			$text2 = array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]) : date("Y-m-d");
			$text3 = array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]) : "0";
			$base_url = "/jangbuio/lists/text1/$text1/text2/$text2/text3/$text3/page";

			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url = "/~four13". $base_url;
			
			$config["per_page"]	 = 5;                              // 페이지당 표시할 line 수
			$config["total_rows"] = $this->jangbuio_m->rowcount($text1, $text2, $text3);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;		 // 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;                // 기본 URL
			
			$this->pagination->initialize($config);           // pagination 설정 적용
			
			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성
			$data["list_product"]=$this->jangbuio_m->getlist_product();

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			
			$data["list"]=$this->jangbuio_m->getlist($text1,$text2,$text3,$start,$limit);   // 해당페이지 자료읽기
			
			$this->	load->view("main_header");             // 상단출력(메뉴)
			$this->load->view("jangbuio_list",$data);       // jangbuio_list에 자료전달
			$this->load->view("main_footer");             // 하단 출력 
		}
		public function excel()
		{
			$uri_array=$this->uri->uri_to_assoc(3);
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : date("Y-m-d", strtotime("-1 month"));
			$text2 = array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]) : date("Y-m-d");
			$text3 = array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]) : "0";
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$count = $this->jangbuio_m->rowcount($text1,$text2,$text3);
			$list = $this->jangbuio_m->getlist_all($text1,$text2,$text3);

			$objPHPExcel = new PHPExcel();

			$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);

			$objPHPExcel->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$objPHPExcel->getActiveSheet()->getStyle("C:F")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "매출입장");
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
			$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "기간: $text1 - $text2");
			$objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			
			$objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->getStartColor()->setARGB("FFCCCCCC");

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A2","날짜")
				->setCellValue("B2","제품명")
				->setCellValue("C2","단가")
				->setCellValue("D2","매입수량")
				->setCellValue("E2","매출수량")
				->setCellValue("F2","금액")
				->setCellValue("G2","비고");

			$i=3;
			foreach ($list as $row)
			{
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", $row->writeday13)
					->setCellValue("B$i", $row->product_name)
					->setCellValue("C$i", $row->price13 ? $row->price13 : "")
					->setCellValue("D$i", $row->numi13 ? $row->numi13 : "")
					->setCellValue("E$i", $row->numo13 ? $row->numo13 : "")
					->setCellValue("F$i", $row->prices13 ? $row->prices13 : "")
					->setCellValue("G$i", $row->bigo13);
				$i++;
			}
			
			$objPHPExcel->setActiveSheetIndex(0);

			$fname="매출입장($text1 - $text2).xlsx";
			$fname=iconv("UTF-8", "EUC-KR", $fname);
			header("Content-Type: application/vnd.ms-excel");
			header("COntent-Disposition: attachment;filename=$fname");
			header("Cache-Control: max-age=0");
			header("Cache-Control: max-age=1");

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
			$objWriter->save("php://output");
		}
	}
?>

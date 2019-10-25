<?
    class Findproduct_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $start, $limit)
		{
			if (!$text1)
				$sql="select product13.*, gubun13.name13 as gubun_name 
				from product13 left join gubun13 on product13.gubun_no13=gubun13.no13 
				order by product13.name13 limit $start,$limit";    // 전체 자료
			else
				$sql="select product13.*, gubun13.name13 as gubun_name 
				from product13 left join gubun13 on product13.gubun_no13=gubun13.no13 where product13.name13 like '%$text1%' 
				order by product13.name13 limit $start,$limit";
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1)
		{
			if (!$text1)
				$sql="select * from product13";
			else
				$sql="select * from product13 where name13 like '%$text1%' ";
			return $this->db->query($sql)->num_rows();
		}
    }
?>

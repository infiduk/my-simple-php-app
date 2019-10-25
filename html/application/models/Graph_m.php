<?
    class Graph_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $text2, $start, $limit)
		{
			$sql="select gubun13.name13 as gubun_name, count(jangbu13.numo13) as cnumo from (gubun13 right join product13 on gubun13.no13=product13.gubun_no13) right join jangbu13 on product13.no13=jangbu13.product_no13
			where io13=1 and jangbu13.writeday13 between '$text1' and '$text2' 
			group by gubun13.name13
			order by cnumo desc limit 14";		
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1, $text2)
		{
			$sql="select * from jangbu13 where io13=1 and writeday13 between '$text1' and '$text2'";
			return $this->db->query($sql)->num_rows();
		}
		function getlist_product()
		{
			$sql="select * from product13 order by name13";
			return $this->db->query($sql)->result();
		}
    }
?>

<?
    class Jangbuio_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $text2, $text3, $start, $limit)
		{
			if($text3 == "0")
				$sql="select jangbu13.*, product13.name13 as product_name from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 where jangbu13.writeday13 between '$text1' and '$text2' order by jangbu13.no13 limit $start,$limit";
			else
				$sql="select jangbu13.*, product13.name13 as product_name from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 where jangbu13.writeday13 between '$text1' and '$text2' and jangbu13.product_no13=$text3 order by jangbu13.no13 limit $start,$limit";
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1, $text2, $text3)
		{
			if($text3 == "0")
				$sql="select * from jangbu13 where writeday13 between '$text1' and '$text2'";
			else
				$sql="select * from jangbu13 where writeday13 between '$text1' and '$text2' and jangbu13.product_no13=$text3";
			return $this->db->query($sql)->num_rows();
		}
		function getlist_product()
		{
			$sql="select * from product13 order by name13";
			return $this->db->query($sql)->result();
		}
    }
?>

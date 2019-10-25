<?
    class Best_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $text2, $start, $limit)
		{
			$sql="select product13.name13 as product_name, sum(jangbu13.numo13) as snumo, count(jangbu13.numo13) as cnumo from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 where io13=1 and jangbu13.writeday13 between '$text1' and '$text2' group by product13.name13 order by cnumo desc limit $start,$limit";
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

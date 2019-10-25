<?
    class Monthly_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $start, $limit)
		{
			$sql="select product13.name13 as product_name, sum( if(month(jangbu13.writeday13)=1, jangbu13.numo13, 0)) as s1, sum( if(month(jangbu13.writeday13)=2, jangbu13.numo13, 0)) as s2, sum( if(month(jangbu13.writeday13)=3, jangbu13.numo13, 0)) as s3, sum( if(month(jangbu13.writeday13)=4, jangbu13.numo13, 0)) as s4, sum( if(month(jangbu13.writeday13)=5, jangbu13.numo13, 0)) as s5, sum( if(month(jangbu13.writeday13)=6, jangbu13.numo13, 0)) as s6, sum( if(month(jangbu13.writeday13)=7, jangbu13.numo13, 0)) as s7, sum( if(month(jangbu13.writeday13)=8, jangbu13.numo13, 0)) as s8, sum( if(month(jangbu13.writeday13)=9, jangbu13.numo13, 0)) as s9, sum( if(month(jangbu13.writeday13)=10, jangbu13.numo13, 0)) as s10, sum( if(month(jangbu13.writeday13)=11, jangbu13.numo13, 0)) as s11, sum( if(month(jangbu13.writeday13)=12, jangbu13.numo13, 0)) as s12 from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 where year(jangbu13.writeday13)=$text1 group by product13.name13 order by product13.name13 limit $start,$limit";
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1)
		{
			$sql="select * from jangbu13 where year(jangbu13.writeday13)=$text1 group by product_no13";
			return $this->db->query($sql)->num_rows();
		}
		function getlist_product()
		{
			$sql="select * from product13 order by name13";
			return $this->db->query($sql)->result();
		}
    }
?>

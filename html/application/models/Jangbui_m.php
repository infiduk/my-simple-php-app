<?
    class Jangbui_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $start, $limit)
		{
			$sql="select jangbu13.*, product13.name13 as product_name 
			from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 where jangbu13.io13=0 and jangbu13.writeday13='$text1' 
			order by jangbu13.no13 limit $start,$limit";
			return $this->db->query($sql)->result();
		}
		function getlist_product()
		{
			$sql="select * from product13 order by name13";
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1)
		{
			$sql="select * from jangbu13 where io13 = 0 and writeday13 = '$text1'";
			return $this->db->query($sql)->num_rows();
		}
		function getrow($no)  {
			$sql="select jangbu13.*, product13.name13 as product_name 
			from jangbu13 left join product13 on jangbu13.product_no13=product13.no13 
			where jangbu13.no13=$no";
			return  $this->db->query($sql)->row();
		}
		function deleterow($no)  {
			$sql="delete from jangbu13 where no13=$no";
			return  $this->db->query($sql);
		}
		function insertrow($row)
		{	
			return $this->db->insert("jangbu13",$row);
		}
		function updaterow($row, $no)
		{
			$where=array("no13"=>$no);
			return $this->db->update("jangbu13", $row, $where);
		}
    }
?>

<?
    class Member_m extends CI_Model												// 모델 클래스 선언
    {
        public function getlist($text1, $start, $limit)
		{
			if (!$text1)
				$sql="select * from member13 order by name13 limit $start,$limit";    // 전체 자료
			else
				$sql="select * from member13 where name13 like '%$text1%' order by name13 limit $start,$limit";
			return $this->db->query($sql)->result();
		}
		public function rowcount($text1)
		{
			if (!$text1)
				$sql="select * from member13";
			else
				$sql="select * from member13 where name13 like '%$text1%' ";
			return $this->db->query($sql)->num_rows();
		}
		function getrow($no)  {
			$sql="select * from member13 where no13=$no";
			return  $this->db->query($sql)->row();
		}
		function deleterow($no)  {
			$sql="delete from member13 where no13=$no";
			return  $this->db->query($sql);
		}
		function insertrow($row)
		{	
			return $this->db->insert("member13",$row);
		}
		function updaterow($row, $no)
		{
			$where=array("no13"=>$no);
			return $this->db->update("member13", $row, $where);
		}
    }
?>

<?
    class Product_m extends CI_Model												// 모델 클래스 선언
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
		function getlist_gubun()
		{
			$sql="select * from gubun13 order by name13";
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
		function getrow($no)  {
			$sql="select product13.*, gubun13.name13 as gubun_name 
			from product13 left join gubun13 on product13.gubun_no13=gubun13.no13 
			where product13.no13=$no";
			return  $this->db->query($sql)->row();
		}
		function deleterow($no)  {
			$sql="delete from product13 where no13=$no";
			return  $this->db->query($sql);
		}
		function insertrow($row)
		{	
			return $this->db->insert("product13",$row);
		}
		function updaterow($row, $no)
		{
			$where=array("no13"=>$no);
			return $this->db->update("product13", $row, $where);
		}
		public function call_upload()
		{
			$config['upload_path']	= './product_img';
			$config['allowed_types']	= 'gif|jpg|png'; 
			$config['overwrite']	= TRUE; 
			$this->upload->initialize($config); 
			if (!$this->upload->do_upload('pic')) 
				$picname="";
			else
				$picname=$this->upload->data("file_name");
			return $picname;
		}
		function cal_jaego()
		{
			$sql="drop table if exists temp";
			$this->db->query($sql);

			$sql="create table temp (
				no int not null auto_increment,
				product_no int,
				jaego int default 0,
				primary key(no) );
			";
			$this->db->query($sql);

			$sql="update product13 set jaego13=0;";
			$this->db->query($sql);

			$sql="insert into temp (product_no, jaego) select product_no13, sum(numi13)-sum(numo13) from jangbu13 group by product_no13;";
			$this->db->query($sql);

			$sql="update product13 inner join temp on product13.no13=temp.product_no set product13.jaego13=temp.jaego;";
			$this->db->query($sql);
		}
    }
?>

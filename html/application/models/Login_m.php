<?
    class Login_m extends CI_Model												// 모델 클래스 선언
    {
		function getrow($uid,$pwd)
		{
			$sql="select * from member13 where uid13='$uid' and pwd13='$pwd'";
			return $this->db->query($sql)->row();
		}
    }
?>

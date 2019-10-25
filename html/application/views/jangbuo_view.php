<br>
        <div class="alert mycolor1" role="alert">매입장</div>
<?
    $uri_array=$this->uri->uri_to_assoc(3);
	$text1=array_key_exists("text1",$uri_array) ? "text1/" . urldecode($uri_array["text1"]) : "";
    $page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "" ;
    $no=$row->no13;
    $writeday=$row->writeday13;
    $product_name=$row->product_name;
    $price=$row->price13;
    $numo=$row->numo13;
    $prices=$row->prices13;
    $bigo=$row->bigo13;
?>
<?      
 $tmp = $text1 ? "/no/$no/$text1/$page" : "/no/$no/$page";   ?>				
        <form name="form1" method="jangbuo_insert.html">
            <table class="table table-bordered table-sm mymargin5">
                <tbody><tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                    <font color="red">*</font> 번호</td>
                    <td width="80%" align="left">
                        <div class="form-inline"><?=$no; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 날짜</td>
                    <td width="80%" align="left">
                        <div class="form-inline"><?=$writeday; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 제품명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <?=$product_name?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        단가
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <?=$price; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        수량
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <?=$numo; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        금액 
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <?=$prices; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        비고
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <?=$bigo; ?>
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
				<a href="/~four13/jangbuo/edit<?=$tmp; ?>"><input type="button" value="수정" class="btn btn-sm mycolor1"></a>              
            </div>
        </form>
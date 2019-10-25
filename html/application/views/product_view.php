<br>
        <div class="alert mycolor1" role="alert">제품</div>
<?
    $uri_array=$this->uri->uri_to_assoc(3);
	$text1=array_key_exists("text1",$uri_array) ? "text1/" . urldecode($uri_array["text1"]) : "";
    $page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "" ;
    $no=$row->no13;
    $gubun_no=$row->gubun_no13;
    $gubun_name=$row->gubun_name;
    $name=$row->name13;
    $price=$row->price13;
    $jaego=$row->jaego13;
?>
<?      
 $tmp = $text1 ? "/no/$no/$text1/$page" : "/no/$no/$page";   ?>				
        <form name="form1" method="product_insert.html">
            <table class="table table-bordered table-sm mymargin5">
                <tbody><tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle"> 번호</td>
                    <td width="80%" align="left">
                        <div class="form-inline"><?=$row->no13; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 구분명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <select name="gubun_no" class="form-control form-control-sm" readonly>
                                <option value=""><?=$gubun_name?></option>
<?
    foreach($list as $row1)
    {
        if($row->gubun_no13==$row1->no13)
            echo("<option value='$row1->no13' selected>$row1->name13</option>");
        else
            echo("<option value='$row1->no13'>$row1->name13</option>");
    }
?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 제품명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="name" size="20" maxlength="20" value="<?=$row->name13; ?>" class="form-control form-control-sm" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 가격
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" name="price" class="form-control form-control-sm" value="<?=$row->price13; ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 재고
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" name="price" class="form-control form-control-sm" value="<?=$row->jaego13; ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 이미지
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="file" name="pic" class="form-control form-control-sm" value="<?=$row->pic13; ?>" readonly>
                        </div>
<?
    if ($row->pic13)     // 이미지가 있는 경우
        echo("<img src='/~four13/product_img/$row->pic13' width='200’ class='img-fluid img-thumbnail'>");
    else                   // 이미지가 없는 경우
        echo("<img src='' width='200’ class='img-fluid img-thumbnail'>");
?>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
				<a href="/~four13/product/edit<?=$tmp; ?>"><input type="button" value="수정" class="btn btn-sm mycolor1"></a>              
            </div>
        </form>
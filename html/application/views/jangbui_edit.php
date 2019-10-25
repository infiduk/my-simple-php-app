<br>
        <div class="alert mycolor1" role="alert">매입장</div>
<script>
$(function() {
    $('#writeday') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
    });
});

function find_product()
{
    window.open("/~four13/findproduct","","resizable=yes,scrollbars=yes,width=500,height=600");
}
</script>	
				<?
                        $uri_array=$this->uri->uri_to_assoc(3);
                        $text1=array_key_exists("text1",$uri_array) ? "text1/" . urldecode($uri_array["text1"]) : "";                    
                        $page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "" ;
                        $no=$row->no13;
                        $writeday=$row->writeday13;
                        $product_no=$row->product_no13;
                        $product_name=$row->product_name;
                        $price=$row->price13;
                        $numi=$row->numi13;
                        $prices=$row->prices13;
                        $bigo=$row->bigo13;
				?>
                <?    $tmp = $text1 ? "/no/$no/$text1/$page" : "/no/$no/$page";   ?>	
        <form name="form1" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-sm mymargin5">
                <tbody><tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle"> 번호</td>
                    <td width="80%" align="left">
                        <div class="form-inline"><?=$no ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 날짜
                    </td>
                    <td width="80%" align="left">
                        <div class="input-group input-group-sm table-sm date">
                            <input type="date" id="writeday" name="writeday" size="20" maxlength="20" value="<?=$writeday?>" class="form-control form-control-sm" style="flex:0.25 auto;">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 제품명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="hidden" name="product_no" value="<?=$product_no?>">
                            <input type="text" name="product_name" value="<?=$product_name?>" class="form-control form-control-sm" disabled>
                            <input type="button" value="제품찾기" onClick="find_product();" class="btn btn-sm mycolor1">
                        </div>
<? if(form_error("product_no")==true) echo form_error("product_no"); ?>
                    </td>
                </tr>
<script>
    function select_product()
    {
        var str;
        str = form1.sel_product_no.value;
        if(str == "")
        {
            form1.product_no.value = "";
            form1.price.value = "";
            form1.prices.value = "";
        }
        else
        {
            str = str.split("^^");
            form1.product_no.value = str[0];
            form1.price.value = str[1];
            form1.prices.value = Number(form1.price.value) * Number(form1.numi.value);
        }
    }

    function cal_prices()
    {
        form1.prices.value = Number(form1.price.value) * Number(form1.numi.value);
        form1.bigo.focus();
    }
</script>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        단가
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" name="price" size="20" maxlength="20" value="<?=$price; ?>" class="form-control form-control-sm" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        수량
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" name="numi" class="form-control form-control-sm" value="<?=$numi ?>" onchange="cal_prices();">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        금액
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" name="prices" class="form-control form-control-sm" value="<?=$prices ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        비고
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="bigo" class="form-control form-control-sm" value="<?=$bigo ?>">
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
				<a href="/~four13/jangbui/edit/<?=$tmp; ?>"><input type="submit" value="저장" class="btn btn-sm mycolor1">
                <a href="/~four13/jangbui/del<?=$tmp; ?>"><input type="button" value="삭제" class="btn btn-sm mycolor1"></a>
            </div>
        </form>
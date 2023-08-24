<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/admin_check.php';
?>

<div class="container">
  <h2 class="text-center">쿠폰 등록</h2>
  <form action="coupon_ok.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th scope="row"><label for="coupon_name">쿠폰명: </label></th>
          <td><input type="text" name="coupon_name" id="coupon_name" class="form-control" require></td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_image">쿠폰이미지: </label></th>
          <td><input type="file" name="coupon_image" id="coupon_image" class="form-control" require></td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_type">타입: </label></th>
          <td class="coupon_type">
           <input type="radio" name="coupon_type" checked value="정액" id="price">
           <label for="price">정액</label>
           <input type="radio" name="coupon_type" value="정률" id="ratio">
           <label for="ratio">정률</label>
          </td>
        </tr>
        <tr id="coupon_price_tr">
          <th scope="row"><label for="coupon_price">할인금액: </label></th>
          <td class="d-flex align-items-center">
            <input type="number" name="coupon_price" id="coupon_price" value="0"  min="10000" max="100000" step="10000" class="form-control"><span>원</span>
          </td>
        </tr>
        <tr id="coupon_ratio_tr">
          <th scope="row"><label for="coupon_ratio">할인비율: </label></th>
          <td class="d-flex align-items-center">
            <input type="number" name="coupon_ratio" id="coupon_ratio" value="0"  min="5" max="15" step="5" class="form-control">
            <span>%</span>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="status">상태: </label></th>
          <td>
            <select name="status" id="" class="form-select">
              <option value="1" selected>대기</option>
              <option value="2">사용중</option>
              <option value="3">폐기</option>
            </select>
          
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="regdate">등록일: </label></th>
          <td><input type="text" name="regdate" id="regdate" class="form-control" required></td>
        </tr>
        <tr>
          <th scope="row"><label for="max_value">최대할인금액: </label></th>
          <td><input type="number" name="max_value" min="10000" max="100000" step="10000" id="max_value" class="form-control" required></td>
        </tr>
        <tr>
          <th scope="row"><label for="use_min_price">최소사용금액: </label></th>
          <td><input type="number" name="use_min_price" min="10000" max="100000" step="10000" id="use_min_price" class="form-control" required></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary">등록</button>
  </form>
</div>
<script>
  // $('#coupon_ratio_tr').hide();
  $('#coupon_ratio_tr input').prop( "disabled", true );

  $('.coupon_type input').change(function(){
    let typeval = $(this).val();
    if(typeval == '정률'){
      $('#coupon_price_tr input').prop( "disabled", true );
      $('#coupon_ratio_tr input').prop( "disabled", false ).focus();
    }
    if(typeval == '정액'){
      $('#coupon_price_tr input').prop( "disabled", false ).focus();
      $('#coupon_ratio_tr input').prop( "disabled", true );
    }    
  });



  $("#regdate").datepicker({
    dateFormat: 'yy-mm-dd'
  });
  $("#regdate").datepicker( "setDate", new Date() );

</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/footer.php';
?>
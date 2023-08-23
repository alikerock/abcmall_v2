<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
?>

<div class="container">
  <h2 class="text-center">쿠폰 등록</h2>
  <form action="">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th scope="row"><label for="coupon_name">쿠폰명: </label></th>
          <td><input type="text" name="coupon_name" id="coupon_name" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_image">쿠폰이미지: </label></th>
          <td><input type="file" name="coupon_image" id="coupon_image" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_type">타입: </label></th>
          <td>
           <input type="radio" name="coupon_type" value="정액" id="price">
           <label for="price">정액</label>
           <input type="radio" name="coupon_type" value="정률" id="ratio">
           <label for="ratio">정률</label>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_price">할인금액: </label></th>
          <td><input type="text" name="coupon_price" id="coupon_price" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="coupon_ratio">할인비율: </label></th>
          <td><input type="text" name="coupon_ratio" id="coupon_ratio" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="status">상태: </label></th>
          <td>
            <select name="status" id="" class="form-select">
              <option value="1">대기</option>
              <option value="2">사용중</option>
              <option value="3">폐기</option>
            </select>
          
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="regdate">등록일: </label></th>
          <td><input type="text" name="regdate" id="regdate" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="max_value">최대할인금액: </label></th>
          <td><input type="text" name="max_value" id="max_value" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="use_min_price">최소사용금액: </label></th>
          <td><input type="text" name="use_min_price" id="use_min_price" class="form-control"></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary">등록</button>
  </form>
</div>
<script>
    $("#regdate").datepicker({
    dateFormat: 'yy-mm-dd'
  });
</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
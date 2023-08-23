<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
?>

<div class="container">
  <h2 class="text-center">쿠폰리스트</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">썸네일</th>
        <th scope="col">쿠폰명</th>
        <th scope="col">타입</th>
        <th scope="col">할인가</th>
        <th scope="col">할인율</th>
        <th scope="col">최소사용금액</th>
        <th scope="col">최대할인금액</th>
        <th scope="col">상태</th>
      </tr>
    </thead>
  </table>
  <a href="coupon_up.php" class="btn btn-primary">쿠폰 등록</a>

</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
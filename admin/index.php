<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/header.php';
?>

<div class="container">
  <h1 class="h3 mt-5">쇼핑몰 관리자 대쉬보드</h1>
 
  <ul>
    <li><a href="/abcmall/admin/product/product_up.php">상품등록</a></li>
    <li><a href="/abcmall/admin/product/product_list.php">상품리스트</a></li>
    <li><a href="/abcmall/admin/coupon/coupon_up.php">쿠폰등록</a></li>
    <li><a href="/abcmall/admin/coupon/coupon_list.php">쿠폰리스트</a></li>
  </ul>

</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/footer.php';
?>
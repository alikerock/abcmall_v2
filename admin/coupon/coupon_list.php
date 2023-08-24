<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/header.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/admin_check.php';

  $pageNumber = $_GET['pageNumber'] ?? 1;
  $pageCount = $_GET['pageCount'] ?? 10;
  $statLimit = ($pageNumber-1)*$pageCount; // (1-1)*10 = 0, (2-1)*10 = 10
  $endLimit = $statLimit + $pageCount;
  $firstPageNumber = $_GET['firstPageNumber'] ?? 0 ;
  
  $sql = "SELECT * from coupons where 1=1" ; // and 컬러명=값 and 컬러명=값 and 컬러명=값 
  $order = " order by cid desc";//최근순 정렬
  $limit = " limit $statLimit, $endLimit";

  $query = $sql.$order.$limit; //쿼리 문장 조합

  // var_dump($query);
  
  $result = $mysqli -> query($query);
  
  while($rs = $result -> fetch_object()){
    $rsc[] = $rs;
  }
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
    <tbody>
      <?php
        if(isset($rsc)){
          foreach($rsc as $item){            
      ?>
      <tr>
        <td class="coupon_thumb"><img src="<?= $item -> coupon_image; ?>" alt="<?= $item -> coupon_name; ?>"></td>
        <td><?= $item -> coupon_name; ?></td>
        <td><?= $item -> coupon_type; ?></td>
        <td><?= $item -> coupon_price; ?></td>
        <td><?= $item -> coupon_ratio; ?></td>
        <td><?= $item -> use_min_price; ?></td>
        <td><?= $item -> max_value; ?></td>
        <td>
          <?php 
          if($item -> status == 1){
            echo '대기';
          } else if ($item -> status == 2){
            echo '사용중';
          } else {
            echo '폐기';
          } 
          ?>
        </td>
      </tr>
      <?php
        } //foreach
      } else {    
      ?>  
      <tr>
        <td colspan="8">조회 결과가 없습니다.</td>
      </tr>
      <?php
        }  
      ?>  

    </tbody>
  </table>
  <a href="coupon_up.php" class="btn btn-primary">쿠폰 등록</a>

</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/footer.php';
?>
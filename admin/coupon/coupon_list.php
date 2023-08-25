<?php
  $title = '쿠폰목록';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/header.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/admin_check.php';

  $pagenationTarget = 'coupons';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/pagenation.php';

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
  <nav aria-label="페이지네이션">
    <ul class="pagination">
    <?php
        if($pageNumber>1){                   
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?pageNumber=1\">&lt;&lt;</a></li>";
            if($block_num > 1){
                $prev = ($block_num - 2) * $block_ct + 1;
                echo "<li class=\"page-item\"><a href='?pageNumber=$prev' class=\"page-link\">이전</a></li>";
            }
        }
        for($i=$block_start;$i<=$block_end;$i++){
          if($pageNumber == $i){
              echo "<li class=\"page-item active\" aria-current=\"page\"><a href=\"?pageNumber=$i\" class=\"page-link\">$i</a></li>";
          }else{
              echo "<li class=\"page-item\"><a href=\"?pageNumber=$i\" class=\"page-link\">$i</a></li>";
          }
        }
        if($pageNumber<$total_page){
          if($total_block > $block_num){
              $next = $block_num * $block_ct + 1;
              echo "<li class=\"page-item\"><a href=\"?pageNumber=$next\" class=\"page-link\">다음</a></li>";
          }
          echo "<li class=\"page-item\"><a href=\"?pageNumber=$total_page\" class=\"page-link\">&gt;&gt;</a></li>";
        }
      ?>           
    </ul>
  </nav>  
  <a href="coupon_up.php" class="btn btn-primary">쿠폰 등록</a>

</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/admin/inc/footer.php';
?>
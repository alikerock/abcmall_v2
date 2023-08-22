<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/admin_check.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
  
  $pid = $_GET['pid'];
  
  $sql = "SELECT * FROM products where pid={$pid}";
  $result = $mysqli -> query($sql);
  $rs = $result -> fetch_object();

  $sql2 = "SELECT * FROM product_options where pid={$pid}";
  $result2 = $mysqli -> query($sql2);
  //$rs2 = $result2 -> fetch_object();

  while($rs2 = $result2 -> fetch_object()){
    $options[]=$rs2;
  }

  $sql3 = "SELECT * FROM product_image_table where pid={$pid}";
  $result3 = $mysqli -> query($sql3);
  //$rs2 = $result2 -> fetch_object();

  while($rs3 = $result3 -> fetch_object()){
    $addImgs[]=$rs3;
  }


?>

<div class="container mt-5">
  <h2>제품 상세</h2>
  <table class="table">
    <tbody>
      <tr><th>분류:</th><td><?= $rs->cate; ?></td></tr>
      <tr><th>제품명:</th><td><?= $rs->name; ?></td></tr>
      <tr><th>가격:</th><td><?= $rs->price; ?></td></tr>
      <tr><th>전시옵션:</th><td>
        <?php
          if($rs->ismain){echo '메인';}
          if($rs->isnew){echo '신제품';}
          if($rs->isbest){echo '베스트 ';}
          if($rs->isrecom){echo '추천';}
        ?>
      </td></tr>
      <tr><th>위치:</th><td><?= $rs->locate; ?></td></tr>
      <tr><th>판매종료일:</th><td><?= $rs->sale_end_date; ?></td></tr>
      <tr>
        <th>옵션</th>
        <td>
          <?php
            foreach($options as $op){
          ?> 
            <div class="product_options">
              <span><?= $op-> option_name;?></span>
              <span><?= $op-> option_cnt;?>개</span>
              <span><?= $op-> option_price;?>원</span>
              <img src="<?= $op-> image_url;?>" alt="">
            </div>
          <?php      
            }
          ?>      
        </td>
        </tr>
      <tr><th>상세설명:</th><td><?= $rs->content; ?></td></tr>
      <tr><th>썸네일</th><td>
        <img src="<?= $rs->thumbnail; ?>" alt="">
      </td></tr>
      <tr><th>추가이미지</th><td>

        <?php
            if(isset($addImgs)){
              foreach($addImgs as $ai){
          ?>             
            <div class="product_options">
              <img src="/abcmall/pdata/<?= $ai-> filename;?>" alt="">
            </div>
          <?php      
            }
          }
          ?>      

      </td></tr>
    </tbody>
  </table>
  <hr>
  <a href="product_modify.php?pid=" class="btn btn-primary">수정</a>
  <button type="button" class="btn btn-danger">삭제</button>
  <a href="product_list.php" class="btn btn-secondary">목록</a>
</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>

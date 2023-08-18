<?php
  session_start(); 
  // var_dump($_SESSION['AUID']);

  if(isset($_SESSION['AUID'])){
    if(!$_SESSION['AUID'] == 'admin'){
      echo "<script>
        alert('권한이 없습니다.');
        location.href = '/abcmall/admin/login.php';
      </script>";
    }
  } else{
    echo "<script>
        alert('권한이 없습니다.');
        location.href = '/abcmall/admin/login.php';
      </script>";
  }

  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/category_func.php';


?>

<div class="container">
  <h1 class="h3 mt-5">제품 목록</h1>
 
  <form action="" class="mt-5">
    <div class="row">
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate1">
          <option selected disabled>대분류</option>
          <?php
          foreach($cate1 as $c){            
        ?>
          <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate2">
          <option selected disabled>중분류</option>
         
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate3">
          <option selected disabled>소분류</option>
          
        </select>
      </div>
    </div>
  </form>
  <div class="input-group d-flex g-5 align-items-center mt-5">
    <span>
      <input class="form-check-input" type="checkbox" value="1" name="ismain" id="ismain">
      <label class="form-check-label" for="ismain">메인</label>
    </span>    
    <span>
      <input class="form-check-input" type="checkbox" value="1" name="isnew" id="isnew">
      <label class="form-check-label" for="isnew">신제품</label>
    </span>   
    <span>
      <input class="form-check-input" type="checkbox" value="1" name="isbest" id="isbest">
      <label class="form-check-label" for="isbest">베스트</label>
    </span>   
    <span>
      <input class="form-check-input" type="checkbox" value="1" name="isrecom" id="isrecom">
      <label class="form-check-label" for="isrecom">추천</label>
    </span>   
    <span class="d-flex g-5 align-items-center">
      <label for="end_date">판매종료일</label>
      <input type="text" class="form-control" name="sale_end_date" id="end_date">
    </span>
  </div>



  <table class="table">
  <thead>
    <tr>
      <th scope="col">사진</th>
      <th scope="col">제품명</th>
      <th scope="col">가격</th>
      <th scope="col">재고</th>
      <th scope="col">메인</th>
      <th scope="col">신제품</th>
      <th scope="col">베스트</th>
      <th scope="col">추천</th>
      <th scope="col">상태</th>
      <th scope="col">보기</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td>8</td>
      <td>9</td>
      <td>10</td>
    </tr>
   
   
  </tbody>
</table>
<hr>
<a href="product_up.php" class="btn btn-primary">제품 등록</a>

</div>

<script src="../../js/makeoption.js"></script>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
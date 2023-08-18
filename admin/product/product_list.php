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

  $pageNumber = $_GET['pageNumber'] ?? 1;
  $pageCount = $_GET['pageCount'] ?? 10;
  $statLimit = ($pageNumber-1)*$pageCount; // (1-1)*10 = 0, (2-1)*10 = 10
  $endLimit = $statLimit + $pageCount;
  $firstPageNumber = $_GET['firstPageNumber'] ?? 0 ;

  $sql = "SELECT * from products where 1=1" ; // and 컬러명=값 and 컬러명=값 and 컬러명=값 
  //$sql = $sql.$search_where;
  $search_where = '';
  $sql .= $search_where;
  $order = " order by pid desc";//최근순 정렬
  $limit = " limit $statLimit, $endLimit";
  $query = $sql.$order.$limit; //쿼리 문장 조합
  $result = $mysqli -> query($query);
  
  while($rs = $result -> fetch_object()){
    $rsc[] = $rs;
  }


?>

<div class="container">
  <h1 class="h3 mt-5">제품 목록</h1>
 
  <form action="" class="mt-5" id="search_form">
    <div class="row">
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate1" name="cate1">
          <option selected disabled>대분류</option>
          <?php
          foreach($cate1 as $c){            
        ?>
          <option value="<?php echo $c->code ?>"><?php echo $c->name ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate2" name="cate2">
          <option selected disabled>중분류</option>
         
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="Default select example" id="cate3" name="cate3">
          <option selected disabled>소분류</option>
          
        </select>
      </div>
    </div>

    <div class="input-group d-flex g-5 align-items-center mt-3 justify-content-between">
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
      <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="제목 및 내용에서 검색합니다">
      <button class="btn btn-primary">검색</button>
    </div>
    
  </form>


  <table class="table product_list">
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
      <?php
          foreach($rsc as $item){            
        ?>
    <tr>
      <td>
        <img src="<?php echo $item->thumbnail ?>" alt="">
      </td>
      <td><?php echo $item->name ?></td>
      <td><?php echo $item->price ?></td>
      <td><?php echo $item->cnt ?></td>
      <td>
        
        <input class="form-check-input" type="checkbox" value="<?php echo $item->ismain ?>" <?php if($item->ismain){ echo "checked"; } ?> name="ismain[<?php echo $item->pid ?>]" id="ismain[<?php echo $item->pid ?>]">
        
      </td>
      <td>
        <input class="form-check-input" type="checkbox" value="<?php echo $item->isnew ?>" <?php if($item->isnew){ echo "checked"; } ?> name="isnew[<?php echo $item->pid ?>]" id="isnew[<?php echo $item->pid ?>]">
      </td>
      <td>
        <input class="form-check-input" type="checkbox" value="<?php echo $item->isbest ?>" <?php if($item->isbest){ echo "checked"; } ?> name="isbest[<?php echo $item->pid ?>]" id="isbest[<?php echo $item->pid ?>]">
    </td>
      <td>
        <input class="form-check-input" type="checkbox" value="<?php echo $item->isrecom ?>" <?php if($item->isrecom){ echo "checked"; } ?> name="isrecom[<?php echo $item->pid ?>]" id="isrecom[<?php echo $item->pid ?>]">
    </td>
      <td>
        <input class="form-check-input" type="checkbox" value="<?php echo $item->status ?>" <?php if($item->status){ echo "checked"; } ?> name="status[<?php echo $item->pid ?>]" id="status[<?php echo $item->pid ?>]">
      </td>
      <td></td>
    </tr>
   <?php
      }
   ?>
   
  </tbody>
</table>
<hr>
<a href="product_up.php" class="btn btn-primary">제품 등록</a>

</div>

<script src="../../js/makeoption.js"></script>

<script>
    $( "#end_date" ).datepicker({
    dateFormat:'yy-mm-dd'
  });

</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
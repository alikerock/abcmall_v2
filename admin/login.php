<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
?>

<div class="container">
  <h1 class="h3 mt-5">쇼핑몰 관리자 페이지</h1>
  <form action="login_ok.php" method="POST">
    <div class="mb-3">
      <label for="userid" class="form-label">관리자 아이디: </label>
      <div class="input-group">        
        <input type="text" name="userid" class="form-control" id="userid" aria-describedby="basic-addon3 basic-addon4">
      </div>      
    </div>
    <div class="mb-3">
      <label for="userpw"  class="form-label">관리자 비밀번호: </label>
      <div class="input-group">        
        <input type="password" name="passwd" class="form-control" id="userpw" aria-describedby="basic-addon3 basic-addon4">
      </div>      
    </div>
    <button type="submit" class="btn btn-primary">로그인</button>
  </form>
</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
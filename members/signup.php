<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
?>

<div class="container">
  <h2 class="text-center">회원가입</h2>

  <form action="" class="signup">
    <div class="d-flex g-5">
      <label for="username">이름</label>
      <input type="text" name="username" id="username" class="form-control" require>
    </div>
    <div class="d-flex g-5">
      <label for="userid">아이디</label>
      <input type="text" name="userid" id="userid" class="form-control" require>
    </div>
    <div class="d-flex g-5">
      <label for="userpw">비번</label>
      <input type="password" name="userpw" id="userpw" class="form-control" require>
    </div>
    <div class="d-flex g-5">
      <label for="useremail">이메일</label>
      <input type="email" name="useremail" id="useremail" class="form-control" require>
    </div>
    <button class="btn btn-primary">회원가입</button>
  </form>

</div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
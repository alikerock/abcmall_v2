<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';
?>

<div class="container">
  <h2 class="text-center">회원가입</h2>

  <form action="signup_ok.php" class="signup" method="POST" id="signup_form">
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
<script>
  $('#signup_form button').click(function(e){
    e.preventDefault();
    let userid = $('#userid').val();
    let useremail = $('#useremail').val();

    let data = {
      userid: userid,
      useremail: useremail
    }
    $.ajax({
      async:false,
      type:'post',
      url:'signup_validate.php',
      data:data,
      dataType:'json',
      error:function(error){
        console.log(error);
      },
      success:function(returned_data){
        if(returned_data.cnt > 0){
          alert('입력한 아이디 또는 이메일은 이미 가입된 정보입니다.');
          return false;
        } else{
          $('#signup_form').submit();
        }
      }
    });
  });
</script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
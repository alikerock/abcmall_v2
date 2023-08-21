<?php
  session_start();


  include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/dbcon.php';


  //관리자 검사
  if(!isset($_SESSION['AUID'])){
    echo "<script>
    alert('권한이 없습니다');
    history.back();
    </script>";
  }


  // print_r($_POST);
  // print_r($_FILES);


//  if(isset($_POST['cate1'])){
//   $cate1 =  $_POST['cate1'];
// } else{
//   $cate1 = '';
// }


  $cate1 =  $_POST['cate1']??'' ;
  $cate2 =  $_POST['cate2']??'' ;
  $cate3 =  $_POST['cate3']??'' ;


  $cate = $cate1.$cate2.$cate3;
  $name = $_POST['name'];
  $price = $_POST['price']??'' ;
  $ismain = $_POST['ismain']??0 ;
  $isnew = $_POST['isnew']??0 ;
  $isbest = $_POST['isbest']??0 ;
  $isrecom = $_POST['isrecom']??0 ;
  $locate =  $_POST['locate']??0 ;


  $sale_price =  $_POST['sale_price']??0 ;
  $sale_ratio =  $_POST['sale_ratio']??0 ;
  $cnt =  $_POST['cnt']?? 0 ;
  $sale_cnt =  $_POST['sale_cnt']?? 0 ;
  $delivery_fee =  $_POST['delivery_fee']?? 0 ;




  $sale_end_date =  $_POST['sale_end_date'];
  $content =  rawurldecode($_POST['content']); //encodeURIComponent통해 변경된 코드를 원래코드로 변경
  $file_table_id = $_POST['file_table_id']??0;
  $file_table_id = $_POST['file_table_id'];
  $file_table_id = rtrim($file_table_id, ',');//최우측 콤마 제거
  $optionCate1 = $_POST['optionCate1']?? '';



  if($_FILES['thumbnail']['name']){
      //파일 사이즈 검사
      if($_FILES['thumbnail']['size']> 10240000){
        echo "<script>
          alert('10MB 이하만 첨부할 수 있습니다.');    
          history.back();      
        </script>";
        exit;
      }
      //이미지 여부 검사
      if(strpos($_FILES['thumbnail']['type'], 'image') === false){
        echo "<script>
          alert('이미지만 첨부할 수 있습니다.');    
          history.back();            
        </script>";
        exit;
      }
      //파일 업로드
      $save_dir = $_SERVER['DOCUMENT_ROOT']."/abcmall/pdata/";
      $filename = $_FILES['thumbnail']['name']; //insta.jpg
      $ext = pathinfo($filename, PATHINFO_EXTENSION); //jpg
      $newfilename = date("YmdHis").substr(rand(), 0,6); //20238171184015
      $thumbnail = $newfilename.".".$ext; //20238171184015.jpg


      if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $save_dir.$thumbnail)){  
        $thumbnail = "/abcmall/pdata/".$thumbnail;
      } else{
        echo "<script>
          alert('이미지등록 실패!');    
          history.back();            
        </script>";
      }


  } //첨부파일 있다면 할일


  $sql = "INSERT INTO products
  (name, cate, content, thumbnail, price, sale_price, sale_ratio, cnt, sale_cnt, isnew, isbest, isrecom, ismain, locate, userid, sale_end_date, reg_date, delivery_fee, file_table_id)
  VALUES
  ('{$name}', '{$cate}', '{$content}', '{$thumbnail}', '{$price}', '{$sale_price}', '{$sale_ratio}', {$cnt}, {$sale_cnt}, '{$isnew}', '{$isbest}', '{$isrecom}', '{$ismain}', '{$locate}', '{$_SESSION['AUID']}', '{$sale_end_date}', now(), {$delivery_fee}, '{$file_table_id}')";




$result = $mysqli -> query($sql);
$pid = $mysqli -> insert_id; //테이블에 저장되는 값의 고유 번호


if($result){ //상품이 등록되면
  if($file_table_id){//추가 이미지가 있으면 product_image_table pid 업데이트
    $updatesql = "UPDATE product_image_table set pid={$pid} where imgid in ({$file_table_id})";
    $result = $mysqli -> query($updatesql);
  }
  if($optionCate1){ //옵션값이 있으면 product_options에 값을 저장
    $optionName1 = $_REQUEST['optionName1'];//옵션명
    $optionCnt1 = $_REQUEST['optionCnt1'];//옵션재고
    $optionPrice1 = $_REQUEST['optionPrice1'];//옵션가격


      for($i = 0;$i<count($optionName1) ; $i++){ //옵션들 마다 할일

        if(isset($_FILES['optionImage1'])){ //해당옵션에 이미지가 있다면
          // 반복할일 
          if($_FILES['optionImage1']['size'][$i] > 10240000){
              echo "<script>
                alert('<?php echo $i + 1 ?>번째 이미지가 기준을 초과합니다., 10메가 이하만 첨부할 수 있습니다. ');
                history.back();  
              </script>";
              exit;
            }
          if(strpos($_FILES['optionImage1']['type'][$i], 'image') === false){
            echo "<script>
              alert('이미지만 첨부할 수 있습니다.');    
              history.back();            
            </script>";
            exit;
          }
  
            //파일 업로드
            $save_dir = $_SERVER['DOCUMENT_ROOT']."/abcmall/pdata/option/";
            $filename = $_FILES['optionImage1']['name'][$i]; //insta.jpg
            $ext = pathinfo($filename, PATHINFO_EXTENSION); //jpg
            $newfilename = date("YmdHis").substr(rand(), 0,6); //20238171184015
            $optionImage1 = $newfilename.".".$ext; //20238171184015.jpg  
  
            if(move_uploaded_file($_FILES['optionImage1']['tmp_name'][$i], $save_dir.$optionImage1)){  
              $upload_option_image[] = "/abcmall/pdata/option/".$optionImage1;
            } else{
              echo "<script>
                alert('이미지등록 실패!');    
                history.back();            
              </script>";
            }          
        }//해당옵션에 이미지가 있다면

        $optsql = "INSERT INTO product_options 
        (pid, cate,option_name, option_cnt, option_price, image_url) 
        VALUES 
        ({$pid}, '{$optionCate1}', '{$optionName1[$i]}', '{$optionCnt1[$i]}', '{$optionPrice1[$i]}', '{$upload_option_image[$i]}')
        ";
        $oprs = $mysqli -> query($optsql);       

        // if($oprs == true){

        // }

      }//반복문
    
  }//옵션값이 있으면

  echo "<script>
   alert('상품 등록 완료!');
   location.href='/abcmall/admin/product/product_list.php';  
  </script>";
} else{
  echo "<script>
   alert('상품 등록 실패');
   history.back();
  </script>";
}




  ?>
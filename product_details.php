<?php
ob_start(); 

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

$related_cateArr = explode('/', $rs -> cate);
$related_cateArr = array_filter($related_cateArr);

// if(end($related_cateArr) == ''){
//     $related_cate = array_slice($related_cateArr, -2, 1)[0];
// } else {
//     $related_cate = end($related_cateArr);
// }
$related_cate = end($related_cateArr);


$rsql = "SELECT * FROM products where cate like '%{$related_cate}%' and not(pid={$pid})";
$related_cate_rt = $mysqli -> query($rsql);

while($rcr = $related_cate_rt -> fetch_object()){
    $rr[]=$rcr;
}

$i = 0; //쿠키에 상품정보를 등록할 때 사용할 인덱스





if(isset($_COOKIE['recent_view_pd'])){ //recent_view_pd이름의 쿠키 존재유무
    $pvc = json_decode($_COOKIE['recent_view_pd']);//쿠키의 json값을 배열로 변경
    if(!in_array($rs, $pvc)){
        if(sizeof($pvc)>=3){ //이미 3개의 쿠키가 있다면 
            unset($pvc[0]); //배열의 첫번째 값을 지운다.
        }
        ksort($pvc); //연관배열의 키값을 기준으로 오름차순, abc 순으로

        foreach ($pvc as $pc) {
            $rvarr[$i] = $pc; //오름차순 정렬된 값을 새배열에 할당.
            $i++;
        }
        $rvarr[$i] = $rs; //배열에 마지막에 현재상품정보를 추가
        $ckval = json_encode($rvarr);//쿠키에 넣기전에 쿠키형식으로 encode;
        setcookie('recent_view_pd', $ckval, time()+86400); //24시간유지되는 쿠키 생성
    }
} else{
    //recent_view_pd 쿠키 생성
    $rvarr[$i] = $rs; //배열에 마지막에 현재상품정보를 추가
    $ckval = json_encode($rvarr);//쿠키에 넣기전에 쿠키형식으로 encode;
    setcookie('recent_view_pd', $ckval, time()+86400); //24시간유지되는 쿠키 생성
}

?>

        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
        <div class="breadcumb_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Dresses</a></li>
                            <li class="breadcrumb-item active">Long Dress</li>
                        </ol>
                        <!-- btn -->
                        <a href="#" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to Category</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="single_product_details_area section_padding_0_100">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(<?= $rs->thumbnail; ?>);">
                                    </li>


                                    <?php
                                      $i = 1;
                                      if(isset($addImgs)){
                                        foreach($addImgs as $ai){
                                    ?>   
                                    <li data-target="#product_details_slider" data-slide-to="<?= $i; ?>" style="background-image: url(/abcmall/pdata/<?= $ai-> filename;?>);">
                                    </li>          
                                      
                                    <?php 
                                        $i++; 
                                      }
                                    }
                                    ?>                                       
                                    
                                   
                                </ol>

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="<?= $rs->thumbnail; ?>">
                                        <img class="d-block w-100" src="<?= $rs->thumbnail; ?>" alt="First slide">
                                        </a>
                                    </div>

                                    
                                    <?php                               
                                      if(isset($addImgs)){
                                        foreach($addImgs as $ai){
                                    ?>  
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="/abcmall/pdata/<?= $ai-> filename;?>">
                                        <img class="d-block w-100" src="/abcmall/pdata/<?= $ai-> filename;?>" alt="Second slide">
                                        </a>
                                    </div>                                              
                                      
                                    <?php                                        
                                      }
                                    }
                                    ?>       
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">

                            <h4 class="title"><?= $rs->name; ?></h4>

                            <h4 class="price number"><?= $rs->price; ?></h4>
                            
                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>

                            <div class="widget size mb-50">
                                <h6 class="widget-title"><?php if(isset($options)){ $options[0] -> cate; }?></h6>
                                <div class="widget-desc">
                                    <ul>
                                    <?php
                                        $oi = 0;
                                        if(isset($options)){
                                        foreach($options as $op){

                                            if($op -> cate == '사이즈'){
                                                $cate = 'size';
                                            } else if($op -> cate == '컬러'){
                                                $cate = 'color';
                                            }
                                            
                                            if($oi == 0){
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                      ?> 
                                        <li>
                                            <label for="poid<?= $op-> poid;?>"><?= $op-> option_name;?></label>
                                            <input type="radio" name="poid<?= $cate;?>" id="poid<?= $op-> poid;?>" value="<?= $op-> option_name;?>" data-price="<?= $op-> option_price;?>" <?= $checked;?> >
                                          <img src="<?= $op-> image_url;?>" alt="">
                                          <span class="number"><?= $op-> option_price;?>원</span>
                                        </li>
                                        <?php  
                                            $oi++;    
                                            }
                                        }
                                          ?>  
                                    </ul>
                                </div> 
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart mb-50" method="post">
                                <div class="d-flex">
                                    <div class="quantity">
                                        <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                        <span class="qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="btn cart-submit d-block">Add to cart</button>                                    
                                </div>
                                <h4 class="mt-50">Total Amount: <span class="totalprice number"><?= $rs->price; ?></span>원</h4>
                            </form>

                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                          <?= $rs->content; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Cart Details</a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos nemo, nulla quaerat. Quibusdam non, eos, voluptatem reprehenderit hic nam! Laboriosam, sapiente! Praesentium.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia magnam laborum eaque.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">shipping &amp; Returns</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae, tempore maxime rerum iste dolorem mollitia perferendis distinctio. Quibusdam laboriosam rerum distinctio. Repudiandae fugit odit, sequi id!</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae qui maxime consequatur laudantium temporibus ad et. A optio inventore deleniti ipsa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img src="img/product-img/product-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">Boutique Silk Dress</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">$120.99 <span>$130</span></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                            <a href="#">View Full Product Details</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <form class="cart" method="post">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="qty2" step="1" min="1" max="12" name="quantity" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>

                                        <div class="share_wf mt-30">
                                            <p>Share With Friend</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->

        <section class="you_may_like_area clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="you_make_like_slider owl-carousel">

                        <?php
                  if(isset($rr)){
                    foreach($rr as $item){            
                  ?>
                    <!-- Single gallery Item Start -->
                    <div class="single_gallery_item">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="<?php echo $item->thumbnail ?>" alt="<?php echo $item->name ?>">
                            <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price"><?php echo $item->price ?></h4>
                            <p><a href="product_details.php?pid=<?php echo $item->pid ?>"><?php echo $item->name ?></a></p>
                            <!-- Add to Cart -->
                            <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                        </div>
                    </div>

                    <?php
                        }
                      } else {
                    ?>                    
                      <div class="single_gallery_item">
                          <p>조회 결과가 없습니다.</p>
                      </div>
                      <?php
                        }   
                      ?>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            
            if($('.widget-desc input').length > 0){
                var optionbutton = $('.widget-desc input');
                optionbutton.on('change',calcCart);
            } 

            let qty = $('#qty');
            let unitprice = <?= $rs->price; ?>;

           

            $('.quantity .qty-plus').click(function(){
                let value = qty.val();
                value++;
                qty.val(value);
                calcCart();
            });
            $('.quantity .qty-minus').click(function(){
                let value = qty.val();
                if(value > 1){ value--; }
                qty.val(value);
                calcCart();
            });

            function calcCart(){
                let option_price = 0;
                if($('.widget-desc input').length > 0){
                    option_price = Number(optionbutton.filter(':checked').attr('data-price'));
                } 
                let cnt = Number(qty.val());
                console.log(unitprice, option_price, cnt);
                $('.totalprice').text(unitprice*cnt + option_price*cnt);
                $('.number').number(true);
            }
            calcCart();

            $('.cart-submit').click(function(e){ 
                    e.preventDefault();
                    cart_insert();
            });
            function cart_insert(){
                let pid = <?= $pid; ?>;
                let optionname = '<?= $op -> cate; ?>';
                let optionval = $('.widget-desc input:checked').val();
                let options = optionname+'-'+optionval;
                let cnt = $('#qty').val();  
                let total = Number($('.totalprice').text().replace(',',''));

                let data = {
                    pid : pid,
                    opts : options,
                    cnt : cnt,
                    total: total
                }
                console.log(data);
                $.ajax({
                    async:false,
                    type:'post',
                    url:'cart_insert.php',
                    data: data,
                    dataType:'json',
                    error:function(error){
                        console.log(error);
                    },
                    success:function(data){
                        if(data.result == 'ok'){
                            alert('장바구니에 추가되었습니다.');
                        } else{
                            alert('장바구니 담기 실패');
                        }
                    }
                });

            }


        </script>


<?php
ob_end_flush();

include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
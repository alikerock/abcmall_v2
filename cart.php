<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/header.php';

$where = '';
if(isset($_SESSION['UID'])){
    $where = "c.userid = '{$_SESSION['UID']}'"; 
} else{
    $where = "c.ssid = '".session_id()."'"; 
}
$sql = "select p.thumbnail,p.name, p.price, c.cartid, c.cnt, c.total 
        from products p 
        join cart c 
        on p.pid=c.pid
        where $where
        ";

$result = $mysqli->query($sql);
while($rs = $result -> fetch_object()){
  $rsArr[] = $rs;
}
// var_dump($rsArr);

//사용가능 쿠폰 출력
$ucsql = "SELECT uc.ucid, c.coupon_name, c.coupon_price from user_coupons uc JOIN coupons c on c.cid = uc.couponid where c.status = 2 and uc.status = 1 and uc.userid = '{$_SESSION['UID']}' and uc.use_max_date >= now() ";

$ucresult = $mysqli->query($ucsql);
while($urs = $ucresult -> fetch_object()){
  $ucArr[] = $urs;
}

?>

        <!-- ****** Cart Area Start ****** -->
        <div class="cart_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach($rsArr as $item){
                                  ?>
                                    <tr data-id="<?= $item -> cartid; ?>">
                                        <td class="cart_product_img d-flex align-items-center">
                                            <a href="#"><img src="<?= $item -> thumbnail; ?>" alt="Product"></a>
                                            <h6><?= $item -> name; ?></h6>
                                        </td>
                                        <td class="price"><span><?= $item -> price; ?></span></td>
                                        <td class="qty">
                                            <div class="quantity">
                                                <span class="qty-minus"
                                                    onclick="var effect = document.getElementById('qty<?= $item -> cartid; ?>'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                        class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty<?= $item -> cartid; ?>" step="1" min="1" max="99"
                                                    name="quantity" value="<?= $item -> cnt; ?>">
                                                <span class="qty-plus"
                                                    onclick="var effect = document.getElementById('qty<?= $item -> cartid; ?>'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </td>
                                        <td class="total_price"><span></span><button class="cart_item_del"> x
                                            </button>
                                        </td>
                                    </tr>

                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop w-50">
                                <a href="shop-grid-left-sidebar.html">Continue shooping</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <a href="#">clear cart</a>
                                <a href="#">Update cart</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-code-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cupon code</h5>
                                <p>Enter your cupone code</p>
                            </div>
                            <form action="#">                                
                                <select name="coupon" id="coupon">
                                    <option value="" disabled selected>쿠폰을 선택해주세요.</option>
                                    <?php
                                    foreach($ucArr as $uc){
                                    
                                    ?>

                                    <option value="<?= $uc -> ucid; ?>" data-price="<?= $uc -> coupon_price; ?>"><?= $uc -> coupon_name; ?></option>
                                    
                                    <?php
                                        }                                    
                                    ?>
                                </select>
                                <button type="button">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Shipping method</h5>
                                <p>Select the one you want</p>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio1"><span>Next day delivery</span><span>$4.99</span></label>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio2"><span>Standard delivery</span><span>$1.99</span></label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio3"><span>Personal Pickup</span><span>Free</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-total-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cart total</h5>
                                <p>Final info</p>
                            </div>

                            <ul class="cart-total-chart">
                                <li><span>Subtotal</span> <span class="subtotal"></span></li>
                                <li><span>Discount</span> <span class="discount">0</span></li>
                                <li><span><strong>Total</strong></span> <span><strong class="grandtotal"></strong></span></li>
                            </ul>
                            <a href="checkout.html" class="btn karl-checkout-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Cart Area End ****** -->
        <script>
          let cartItem = $('.cart_area tbody tr');
          
          $('.quantity > span').click(function(){
            console.log('click');
            let item = $(this).closest('tr');
            console.log(item);
            let unitprice = Number(item.find('.price span').text());
            let count =  Number(item.find('.qty-text').val());
            let itemtotal = unitprice*count;            

            item.find('.total_price span').text(itemtotal);
            cartClac();
          })
  
          function cartClac(){
            let subtotal = 0;
            cartItem.each(function(){
              const unitprice = Number($(this).find('.price span').text());
              const count =  Number($(this).find('.qty-text').val());
              let itemtotal = unitprice*count;

              subtotal+=itemtotal;
              $(this).find('.total_price span').text(itemtotal);

            });
            $('.subtotal').text(subtotal);
            $('.grandtotal').text(subtotal);
          }
          cartClac();

          $('.cart_item_del').click(function(){
            let cartId = $(this).closest('tr').attr('data-id');
            
            if (confirm('정말 삭제하시겠습니까?')) {
                  // 확인
                  let data = {
                    cartid : cartId
                  }
                  $.ajax({
                          async:false,
                          type:'post',
                          url:'cart_delete.php',
                          data: data,
                          dataType:'json',
                          error:function(error){
                              console.log(error);
                          },
                          success:function(data){
                              if(data.result == 'ok'){
                                  alert('장바구니에 삭제되었습니다.');
                                  location.reload();
                              } else{
                                  alert('장바구니 삭제 실패');
                              }
                          }
                      });
            } else{
              alert('삭제를 취소했습니다.');
            }
          });
        </script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/abcmall/inc/footer.php';
?>
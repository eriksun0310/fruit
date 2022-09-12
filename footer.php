<footer class="page-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 pt-">
            <br>
            <h6 class="text-uppercase font-weight-bold">花嬸在哪裡?</h6>
            <p>地址：淘淘樂街上,斯爾特對面
            <br/>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <br>
            <h6 class="text-uppercase font-weight-bold">花嬸最喜歡的東西?</h6>
            <p>毛毛花
            <br/>葡萄
            <br/>椰汁漿果撈</p>
          </div>
        </div>
        <div class="footer-copyright text-center">花嬸ㄟ水果行🌸2022</div>
      </footer>

      <!-- 購物車彈出視窗 -->
      <div class="modal fade " id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">購物車</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="show-cart table">
                
              </table>
              <div>
              <img src="my-fruits/images/摩爾豆.png" alt="" width="35px">
                總共: $<span class="total-cart"></span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">關閉</button>
              <button type="button" class="btn btn-info" onclick="submit_order()">送出訂單</button>
            </div>
          </div>
        </div>
      </div> 


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="my-fruits/js/main.js"></script>
    <script src="my-fruits/js/cart.js"></script>
    <script>
            function submit_order(){
                var orderBody = "";

                var cartItems = shoppingCart.listCart(); //傳回購物車項目的陣列
                var orderTotal = 0; //訂單總金額
                for (var i = 0; i < cartItems.length; i++){
                    var cartItem = Object.values(cartItems[i]);    //cartItemArray是一個陣列，分別是品名、單價、數量、小計
                    // console.log(cartItemArray);
                    orderBody += '項目' + (i+1) + '：' + 
                                cartItem[0] + 
                                ' 單價：' + cartItem[1] + '元,' + 
                                ' 數量：' +  cartItem[2] + 
                                ' 小計：' + parseFloat( cartItem[3] ) + '元' +
                                '<br>';
                    orderTotal = orderTotal + parseFloat( cartItem[3]  );
                }    
                //console.log("訂單總金額: " + orderTotal + "元" )
                orderBody += "訂單總金額: " + orderTotal + "元" + "<br>";
                console.log(orderBody);
                $.ajax({ //使用jQuery的ajax方法進行POST資料到後端
                    url: 'index.php',
                    type: 'POST',
                    data: { 'order': orderBody },
                    success: function (result) { 
                        alert('訂單發送成功');
                        $(".clear-cart").click();//觸發"清除購物車"按鈕
                        $("#cart").modal('hide');//隱藏購物車對話框
                    },
                    error: function(jqxhr, status, exception) {
                        alert('Exception:', exception);
                    }
                });  
        }    
  </script>

<?php
  if ( isset($_POST["order"]) ) {    
    $orderBody = stripslashes($_POST["order"]);
    $to ="wda2209@wda2209.stu.fgchen.com"; //收件者
    $subject = "新便當訂單"; //信件標題    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: wda2209<wda2209@wda2209.stu.fgchen.com>' . '\r\n';
    if(mail($to, $subject, $orderBody, $headers))
     echo "信件發送成功";//寄信成功就會顯示的提示訊息
    else
     echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  } 
?>

    
  </body>
</html>
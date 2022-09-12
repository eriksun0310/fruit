<?php include("header.php");?>
        <body>
            <!-- Contact Us Section -->
            <section class="contact-us">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="section-title">
                                <h2>Contact Us</h2>
                                <p><b>花嬸:猜猜我在哪呀?</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7">
                            <form action="/" class="mb-4 mb-lg-0">
                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="Type Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-light">Contact Now</button>
                            </form>
                        </div>
    
                        <div class="col-lg-5">
                            <div class="map">
                                <img src="my-fruits/images/地圖.jpg" alt="" width="100%" height="300"   frameborder="0" style="border: 0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Contact Us Section -->

            <script>
            function submit_contact(){      

            let contact = 'Name : ' + $('[name="Your Name"]').val() + '<br>' +
                        'Email : ' + $('[name="Email"]').val() +  '<br>' +
                        'Phone : ' + $('[name="Phone Number"]').val() +  '<br>' +
                        'Message : ' + $('[name="Message"]').val();
            console.log(contact);
            $.ajax({ //使用jQuery的ajax方法進行POST資料到後端
                url: 'contact.php',
                type: 'POST',
                data: { 'contact': contact },
                success: function (result) { 
                    alert('發送成功，我們會在最快的時間內與您聯繫！');
                    $('[name="Your Name"]').val('') ;
                    $('[name="Email"]').val('');
                    $('[name="Phone Number"]').val('');
                    $('[name="Message"]').val('');
                },
                error: function(jqxhr, status, exception) {
                    alert('Exception:', exception);
                    
                }
            }); 
            }
      </script>

<?php
  if ( isset($_POST["contact"]) ) {    
    $contact = stripslashes($_POST["contact"]);
    $to ="wda2209@wda2209.stu.fgchen.com"; //收件者
    $subject = "訪客來信"; //信件標題    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: wda2209<wda2209@wda2209.stu.fgchen.com>' . '\r\n';
    if(mail($to, $subject, $contact, $headers))
     echo "信件發送成功";//寄信成功就會顯示的提示訊息
    else
     echo "信件發送失敗！";//寄信失敗顯示的錯誤訊息
  } 
?>
      
    <?php include("footer.php");?>

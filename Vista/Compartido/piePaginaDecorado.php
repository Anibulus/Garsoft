<!--footer section start -->
<div class="footer_section layout_padding">
		<div class="container">
			<div class="row">
			    <div class="col-sm-3">
				    <div class="footer_contact">Contact Us</div>
			    </div>
			    <div class="col-sm-3">
				    <div class="location_text"><img src="<?php echo $dominio?>Img/map-icon.png"><span style="padding-left: 10px;">Locations</span></div>
			    </div>
			    <div class="col-sm-3">
			    	<div class="location_text"><img src="<?php echo $dominio?>Img/call-icon.png"><span style="padding-left: 10px;">Locations</span></div>
			    </div>
			    <div class="col-sm-3">
			    	<div class="location_text"><img src="<?php echo $dominio?>Img/mail-icon.png"><span style="padding-left: 10px;">Locations</span></div>
			    </div>
		    </div>
		    <div class="enput_bt">
		    	<div class="row">
		    		<div class="col-md-6">
		    			<div class="input_main">
                       <div class="container">
                          <form action="/action_page.php">
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="NAME" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="EMAIL" name="Email">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="PHONE NUMBER" name="Email">
                            </div>
                            <form action="/action_page.php">
                                <div class="form-group">
                                  <textarea class="massage-bt" placeholder="MASSAGE" rows="5" id="comment" name="text"></textarea>
                                </div>
                            </form>
                          </form>
                       </div> 
                       <div class="send_bt_main">
                       	<div class="left">
                       		<div class="send_bt"><a href="#">SEND</a></div>
                       	</div>
                       	<div class="right">
                       		<div class="social_icon">
                       			<ul>
                       				<li><a href="https://www.facebook.com/Acumuladores-Garza-1105702469636789"><img src="<?php echo $dominio?>Img/fb-icon.png"></a></li>
                       				<!--<li><a href="#"><img src="<?php echo $dominio?>Img/twitter-icon.png"></a></li>                       				
                       				<li><a href="#"><img src="<?php echo $dominio?>Img/instagram-icon.png"></a></li>-->
                       			</ul>
                       		</div>
                       	</div>
                       </div>
                    </div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="map_section">
		                    <div class="row">
			            <div class="col-sm-12">
				            <div class="full map_section">
                               <div id="map">
                                    Mapa

                               </div>
                            </div>
			            </div>
		            </div>
	                 </div>
		    			<h1 class="newsletter_text">Newsletter</h1>
		    			<div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ENTER YOUR MAIL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                       <div class="input-group-append">
                       <span class="input-group-text" id="basic-addon2">SUBSCRIBE</span>
                       </div>
                       </div>
		    		</div>
		    	</div>
		    </div>
		    <div class="copyright_section">
				<p class="copyright_text">  <?php echo date("Y"); ?> Realizado por ANJANATH</p>
			</div>
		</div>
	</div>
	<!--footer section end -->
	<style>
		.texto-mail{
			color:white;
		}
		.texto-mail:hover{
			color:#EDA854;
		}
	</style>
     <!-- Javascript files-->
	<script src="<?php echo $dominio?>Contenido/js/bootstrap.bundle.min.js"></script>
	<!-- sidebar -->
	<script src="<?php echo $dominio?>Contenido/js/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>

<!-- Page top section -->
<section class="page-top-section set-bg" data-setbg="<?= URL_ROOT ?>img/page-top-bg/4.jpg">
		<div class="page-info">
			<h2>Contact</h2>
			<div class="site-breadcrumb">
				<a href="">Home</a>  /
				<span>Contact</span>
			</div>
		</div>
	</section>
	<!-- Page top end-->


	<!-- Contact page -->
	<section class="contact-page">
		<div class="container">
			<div class="map"><iframe src="<?= $data['setting_map'] ?>" style="border:0" allowfullscreen></iframe></div>
			<div class="row">
				<div class="col-lg-7 order-2 order-lg-1">
					<div id="contact_form_resp"></div>
					<form class="contact-form" id="contact_form">
						<input type="text" placeholder="Your name" name="name">
						<input type="email" placeholder="Your e-mail" name="email">
						<input type="text" placeholder="Subject" name="subject">
						<textarea placeholder="Message" name="message"></textarea>
						<button class="site-btn" type="submit">Send message<img src="<?= URL_ROOT ?>img/icons/double-arrow.png" alt="#"/></button>
					</form>
				</div>
				<div class="col-lg-5 order-1 order-lg-2 contact-text text-white">
					<h3>Contact Us</h3>
					<p>Any Problem? We would love to hear you from. Please feel free to contact us.</p>
					<div class="cont-info">
						<div class="ci-icon"><img src="<?= URL_ROOT ?>img/icons/location.png" alt=""></div>
						<div class="ci-text"><?=  $data['contact_address'] ?></div>
					</div>
					<div class="cont-info">
						<div class="ci-icon"><img src="<?= URL_ROOT ?>img/icons/phone.png" alt=""></div>
						<div class="ci-text"><?= $data['contact_phone'] ?></div>
					</div>
					<div class="cont-info">
						<div class="ci-icon"><img src="<?= URL_ROOT ?>img/icons/mail.png" alt=""></div>
						<div class="ci-text"><?= $data['contact_email'] ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact page end-->

@extends('principal.master')


@section('body')


<div class="main-container">
	<section class="map">
		<div class="map-holder">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3127.4316839775333!2d-0.5157705842429441!3d38.38526667965295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6236bb72bf619b%3A0x506e11c403138428!2sUniversidad+de+Alicante!5e0!3m2!1ses!2ses!4v1495244713561"></iframe>
		</div>
	</section>
		
	<section class="contact-thirds">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h5>Detalles</h5>					
					<p>Edificio Politécnica 4, Universidad de Alicante
					<br>03690, San Vicente del Raspeig
					<br>+70 424 495 952 
					<br>contact@soundbook.com</p>
				</div>
				
				
				
				<div class="col-sm-6">
					<h5>Envianos un mensaje</h5>
					<div class="form-wrapper clearfix">
					<form class="form-contact email-form">
						<div class="inputs-wrapper">
							<input class="form-name validate-required" type="text" placeholder="Nombre" name="name">
							<input class="form-email validate-required validate-email" type="text" placeholder="Email" name="email">
							<textarea class="form-message validate-required" name="message" placeholder="Mensaje"></textarea>
						</div>
						<input type="submit" class="send-form" value="Send Form">
						<div class="form-success">
							<span class="text-white">Mensaje enviado.</span>
						</div>
						<div class="form-error">
							<span class="text-white">Rellene todos los campos.</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>	
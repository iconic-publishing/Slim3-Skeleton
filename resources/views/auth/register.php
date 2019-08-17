{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>

				<h2>Sample Register Page</h2>
				
				<code>app/Controllers/Auth/AuthRegisterController.php</code>

				<hr>

				{% include 'includes/messages/messages.php' %}

				<form action="{{ path_for('postRegister') }}" method="post" autocomplete="{{ config.app.autocomplete }}">
					<div class="form-row">
						<div class="col-lg-6 mb-3">
							<label>First Name <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.first_name ? 'is-invalid' : '' }}" name="first_name" value="{{ old.first_name }}">
							<span class="invalid-feedback">{{ errors.first_name | first }}</span>
						</div>

						<div class="col-lg-6 mb-3">
							<label>Last Name <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.last_name ? 'is-invalid' : '' }}" name="last_name" value="{{ old.last_name }}">
							<span class="invalid-feedback">{{ errors.last_name | first }}</span>
						</div>

						<div class="col-lg-6 mb-3">
							<label>Email Address <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.email_address ? 'is-invalid' : '' }}" name="email_address" value="{{ old.email_address }}">
							<span class="invalid-feedback">{{ errors.email_address | first }}</span>
						</div>

						<div class="col-lg-6 mb-3">
							<label>Mobile Number <small><i>(SMS Verification)</i></small> <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.mobile_number ? 'is-invalid' : '' }}" name="mobile_number" value="{{ old.mobile_number }}">
							<span class="invalid-feedback">{{ errors.mobile_number | first }}</span>
						</div>
						
						<div class="col-lg-6 mb-3">
							<label>Password <span class="red">*</span></label>
							<input type="password" class="form-control {{ errors.password ? 'is-invalid' : '' }}" name="password" value="{{ old.password }}">
							<span class="invalid-feedback">{{ errors.password | first }}</span>
						</div>

						<div class="col-lg-6 mb-3">
							<label>Confirm Password <span class="red">*</span></label>
							<input type="password" class="form-control {{ errors.confirm_password ? 'is-invalid' : '' }}" name="confirm_password" value="{{ old.confirm_password }}">
							<span class="invalid-feedback">{{ errors.confirm_password | first }}</span>
						</div>
						
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">REGISTER</button>
						</div>
					</div>
					{{ csrf.field | raw }}
				</form>
			</div>
		</div>
	</div>
	
{% endblock %}
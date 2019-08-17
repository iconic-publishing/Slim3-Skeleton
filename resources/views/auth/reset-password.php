{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>

				<h2>Sample Reset Password Page</h2>
				
				<code>app/Controllers/Auth/AuthResetPasswordController.php</code>

				<hr>

				{% include 'includes/messages/messages.php' %}

				<form action="{{ path_for('postResetPassword', {email_address: user.email_address}) }}" method="post" autocomplete="{{ config.app.autocomplete }}">
					<div class="form-row">
						<div class="col-lg-12 mb-3">
							<label>New Password <span class="red">*</span></label>
							<input type="password" class="form-control {{ errors.password ? 'is-invalid' : '' }}" name="password" value="{{ old.password }}">
							<span class="invalid-feedback">{{ errors.password | first }}</span>
						</div>

						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">RESET PASSWORD</button>
						</div>
					</div>
					{{ csrf.field | raw }}
				</form>
			</div>
		</div>
	</div>
	
{% endblock %}
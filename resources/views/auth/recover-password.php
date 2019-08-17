{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>

				<h2>Sample Recover Password Page</h2>

				<code>app/Controllers/Auth/AuthRecoverPasswordController.php</code>

				<hr>

				{% include 'includes/messages/messages.php' %}

				<form action="{{ path_for('postRecoverPassword') }}" method="post" autocomplete="{{ config.app.autocomplete }}">
					<div class="form-row">
						<div class="col-lg-12 mb-3">
							<label>Email Address <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.email_address ? 'is-invalid' : '' }}" name="email_address" value="{{ old.email_address }}">
							<span class="invalid-feedback">{{ errors.email_address | first }}</span>
						</div>

						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">RECOVER PASSWORD</button>
						</div>
					</div>
					{{ csrf.field | raw }}
				</form>

				<hr>

				<h3>Test Emails</h3>

				<p>Admin Account: Email <code>johndoe@domain.com</code></p>
				<p>User Account: Email <code>jaynedoe@domain.com</code></p>
			</div>
		</div>
	</div>
	
{% endblock %}
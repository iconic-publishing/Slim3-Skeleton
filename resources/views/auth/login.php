{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>

				<h2>Sample Login Page</h2>

				<code>app/Controllers/Auth/AuthLoginController.php</code>

				<hr>

				{% include 'includes/messages/messages.php' %}

				<form action="{{ path_for('postLogin') }}" method="post" autocomplete="{{ config.app.autocomplete }}">
					<div class="form-row">
						<div class="col-lg-6 mb-3">
							<label>Email or Username <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.email_or_username ? 'is-invalid' : '' }}" name="email_or_username" value="{{ old.email_or_username }}">
							<span class="invalid-feedback">{{ errors.email_or_username | first }}</span>
						</div>
						
						<div class="col-lg-6 mb-3">
							<label>Password <span class="red">*</span></label>
							<input type="password" class="form-control {{ errors.password ? 'is-invalid' : '' }}" name="password">
							<span class="invalid-feedback">{{ errors.password | first }}</span>
						</div>
						
						<div class="col-lg-12 mb-3">
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" name="remember">
									Keep me logged in
								</label>
							</div>
						</div>
						
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">LOGIN</button>
						</div>
					</div>
					{{ csrf.field | raw }}
				</form>

				<hr>

				<h3>Test Accounts</h3>

				<p>Admin Account: Username <code>517977</code> Password <code>password123456</code></p>
				<p>User Account: Username <code>517978</code> Password <code>password123456</code></p>
			</div>
		</div>
	</div>
	
{% endblock %}
{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
					
					<h2>Sample Reset Password Page - <small><code>app/Controllers/Auth/AuthResetPasswordController.php</code></small></h2>
					
					<hr>
					
					{% include 'includes/messages/messages.php' %}
					
					<form action="{{ path_for('postResetPassword', {email_address: user.email_address}) }}" method="post" autocomplete="on">
						<fieldset>
							<div class="row">
								<div class="col-md-12 {{ errors.password ? 'has-error' : '' }}">
									<label>New Password <span class="red">*</span></label>
									<input type="password" class="form-control" name="password" value="{{ old.password }}">
									<span class="help-block red">{{ errors.password | first }}</span>
								</div>
							</div>
						</fieldset>
						
						<hr>
						
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">RESET PASSWORD</button>
							</div>
						</div>
						
						{{ csrf.field | raw }}
					</form>
				</div>
			</div>
		</div>
	</section>
	
{% endblock %}
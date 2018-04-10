{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
					
					<h2>Sample Recover Password Page - <small><code>app/Controllers/Auth/AuthRecoverPasswordController.php</code></small></h2>
					
					<hr>
					
					{% include 'includes/messages/messages.php' %}
					
					<form action="{{ path_for('postRecoverPassword') }}" method="post" autocomplete="on">
						<fieldset>
							<div class="row">
								<div class="col-md-12 {{ errors.email_address ? 'has-error' : '' }}">
									<label>Email Address <span class="red">*</span></label>
									<input type="text" class="form-control" name="email_address" value="{{ old.email_address }}">
									<span class="help-block red">{{ errors.email_address | first }}</span>
								</div>
							</div>
						</fieldset>
						
						<hr>
						
						<div class="row">
							<div class="col-md-12">
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
	</section>
	
{% endblock %}
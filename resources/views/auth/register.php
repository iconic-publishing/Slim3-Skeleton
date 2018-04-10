{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
					
					<h2>Sample Register Page - <small><code>app/Controllers/Auth/AuthRegisterController.php</code></small></h2>
					
					<hr>
					
					{% include 'includes/messages/messages.php' %}
					
					<form action="{{ path_for('postRegister') }}" method="post" autocomplete="on">
						<fieldset>
							<div class="row">
								<div class="col-md-6 {{ errors.first_name ? 'has-error' : '' }}">
									<label>First Name <span class="red">*</span></label>
									<input type="text" class="form-control" name="first_name" value="{{ old.first_name }}">
									<span class="help-block">{{ errors.first_name | first }}</span>
								</div>

								<div class="col-md-6 {{ errors.last_name ? 'has-error' : '' }}">
									<label>Last Name <span class="red">*</span></label>
									<input type="text" class="form-control" name="last_name" value="{{ old.last_name }}">
									<span class="help-block red">{{ errors.last_name | first }}</span>
								</div>
								
								<div class="col-md-6 {{ errors.email_address ? 'has-error' : '' }}">
									<label>Email Address <span class="red">*</span></label>
									<input type="text" class="form-control" name="email_address" value="{{ old.email_address }}">
									<span class="help-block red">{{ errors.email_address | first }}</span>
								</div>
								
								<div class="col-md-6 {{ errors.mobile_number ? 'has-error' : '' }}">
									<label>Mobile Number <i>(SMS Verification)</i> <span class="red">*</span></label>
									<input type="text" class="form-control" name="mobile_number" value="{{ old.mobile_number }}">
									<span class="help-block red">{{ errors.mobile_number | first }}</span>
								</div>
								
								<div class="col-md-6 {{ errors.password ? 'has-error' : '' }}">
									<label>Password <span class="red">*</span></label>
									<input type="password" class="form-control" name="password" value="{{ old.password }}">
									<span class="help-block red">{{ errors.password | first }}</span>
								</div>
								
								<div class="col-md-6 {{ errors.confirm_password ? 'has-error' : '' }}">
									<label>Confirm Password <span class="red">*</span></label>
									<input type="password" class="form-control" name="confirm_password" value="{{ old.confirm_password }}">
									<span class="help-block red">{{ errors.confirm_password | first }}</span>
								</div>
							</div>
						</fieldset>
						
						<hr>
						
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">REGISTER</button>
							</div>
						</div>
						
						{{ csrf.field | raw }}
					</form>
				</div>
			</div>
		</div>
	</section>
	
{% endblock %}
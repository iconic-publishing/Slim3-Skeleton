{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
					
					<h2>Sample Login Page - <small><code>app/Controllers/Auth/AuthLoginController.php</code></small></h2>
					
					<hr>
					
					{% include 'includes/messages/messages.php' %}
					
					<form action="{{ path_for('postLogin') }}" method="post" autocomplete="on">
						<fieldset>
							<div class="row">
								<div class="col-md-6 {{ errors.email_or_username ? 'has-error' : '' }}">
									<label>Username or Email <span class="red">*</span></label>
									<input type="text" class="form-control" name="email_or_username" value="{{ old.email_or_username }}">
									<span class="help-block">{{ errors.email_or_username | first }}</span>
								</div>
								
								<div class="col-md-6 {{ errors.password ? 'has-error' : '' }}">
									<label>Password <span class="red">*</span></label>
									<input type="password" class="form-control" name="password">
									<span class="help-block red">{{ errors.password | first }}</span>
								</div>
								
								<div class="col-md-12">
									<label style="margin-left: 20px" class="checkbox"><input type="checkbox" name="remember" checked><i></i>Keep me logged in</label>
								</div>
							</div>
						</fieldset>
						
						<hr>
						
						<div class="row">
							<div class="col-md-12">
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
	</section>
	
{% endblock %}
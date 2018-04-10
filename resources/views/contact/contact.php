{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
					
					<h2>Sample Contact Page - <small><code>app/Controllers/ContactController.php</code></small></h2>
					
					<hr>
					
					{% include 'includes/messages/messages.php' %}
					
					<form action="{{ path_for('contactSubmit') }}" method="post" autocomplete="{{ config.app.autocomplete }}">
						<fieldset>
							<div class="row">
								<div class="col-md-12 {{ errors.full_name ? 'has-error' : '' }}">
									<label>Full Name <span class="red">*</span></label>
									<input type="text" class="form-control" name="full_name" value="{{ old.full_name }}">
									<span class="help-block">{{ errors.full_name | first }}</span>
								</div>

								<div class="col-md-6 {{ errors.mobile_number ? 'has-error' : '' }}">
									<label>Mobile Number <span class="red">*</span></label>
									<input type="text" class="form-control" name="mobile_number" value="{{ old.mobile_number }}">
									<span class="help-block red">{{ errors.mobile_number | first }}</span>
								 </div>

								<div class="col-md-6 {{ errors.email_address ? 'has-error' : '' }}">
									<label>Email Address <span class="red">*</span></label>
									<input type="text" class="form-control" name="email_address" value="{{ old.email_address }}">
									<span class="help-block red">{{ errors.email_address | first }}</span>
								</div>
							</div>
							
							<div class="row">
							   <div class="col-md-6 {{ errors.country ? 'has-error' : '' }}">
									<label>Country <span class="red">*</span></label>
									<select class="form-control pointer" name="country">
										<option class="select-placeholder" disabled selected></option>
										{% for country in select.country() %}
										<option value="{{ country }}" {{ (country == old.country) ? 'selected' : '' }}>{{ country }}</option>
										{% endfor %}
									</select>
									<span class="help-block red">{{ errors.country | first }}</span>
								</div>

								<div class="col-md-6 {{ errors.department ? 'has-error' : '' }}">
									<label>Department <span class="red">*</span></label>
									<select class="form-control pointer" name="department">
										<option class="select-placeholder" disabled selected></option>
										{% for department in select.department() %}
										<option value="{{ department }}" {{ (department == old.department) ? 'selected' : '' }}>{{ department }}</option>
										{% endfor %}
									</select>
									<span class="help-block red">{{ errors.department | first }}</span>
								</div>

								<div class="col-md-12 {{ errors.subject ? 'has-error' : '' }}">
									<label>Subject <span class="red">*</span></label>
									<input type="text" class="form-control" name="subject" value="{{ old.subject }}">
									<span class="help-block red">{{ errors.subject | first }}</span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 {{ errors.message ? 'has-error' : '' }}">
									<label>Message <span class="red">*</span></label>
									<textarea class="form-control" name="message" maxlength="500" rows="8">{{ old.message }}</textarea>
									<span class="help-block red">{{ errors.message | first }}</span>
								</div>
							</div>
						</fieldset>
						
						<hr>
						
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">SEND MESSAGE</button>
							</div>
						</div>
						
						{{ csrf.field | raw }}
					</form>
				</div>
			</div>
		</div>
	</section>

{% endblock %}
                        
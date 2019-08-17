{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>

				<h2>Sample Contact Page</h2>
				
				<code>app/Controllers/ContactController.php</code>

				<hr>

				{% include 'includes/messages/messages.php' %}
				
				<form action="{{ path_for('contactSubmit') }}" method="post" autocomplete="{{ config.app.autocomplete }}">
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
							<label>Mobile Number <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.mobile_number ? 'is-invalid' : '' }}" name="mobile_number" value="{{ old.mobile_number }}">
							<span class="invalid-feedback">{{ errors.mobile_number | first }}</span>
						</div>

						<div class="col-lg-6 mb-3">
							<label>Country <span class="red">*</span></label>
							<select class="form-control pointer {{ errors.country ? 'is-invalid' : '' }}" name="country">
								<option class="select-placeholder" disabled selected></option>
								{% for country in select.country() %}
								<option value="{{ country }}" {{ (country == old.country) ? 'selected' : '' }}>{{ country }}</option>
								{% endfor %}
							</select>
							<span class="invalid-feedback">{{ errors.country | first }}</span>
						</div>
						
						<div class="col-lg-6 mb-3">
							<label>Department <span class="red">*</span></label>
							<select class="form-control pointer {{ errors.department ? 'is-invalid' : '' }}" name="department">
								<option class="select-placeholder" disabled selected></option>
								{% for department in select.department() %}
								<option value="{{ department }}" {{ (department == old.department) ? 'selected' : '' }}>{{ department }}</option>
								{% endfor %}
							</select>
							<span class="invalid-feedback">{{ errors.department | first }}</span>
						</div>
						
						<div class="col-lg-12 mb-3">
							<label>Subject <span class="red">*</span></label>
							<input type="text" class="form-control {{ errors.subject ? 'is-invalid' : '' }}" name="subject" value="{{ old.subject }}">
							<span class="invalid-feedback">{{ errors.subject | first }}</span>
						</div>
						
						<div class="col-lg-12 mb-3">
							<label>Message <span class="red">*</span></label>
							<textarea class="form-control {{ errors.message ? 'is-invalid' : '' }}" name="message" rows="8">{{ old.message }}</textarea>
							<span class="invalid-feedback">{{ errors.message | first }}</span>
						</div>
						
						<div class="col-lg-12 mb-3">
							<div class="g-recaptcha" data-sitekey="{{ config.recaptcha.siteKey }}"></div>
						</div>
						
						<div class="col-lg-12">
							<button type="submit" class="btn btn-primary">SEND MESSAGE</button>
						</div>
					</div>
					{{ csrf.field | raw }}
				</form>
			</div>
		</div>
	</div>

{% endblock %}
                        
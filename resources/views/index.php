{% extends 'includes/layout.php' %}

{% block tags %}
<title>{{ config.tags.index.title }}</title>
<meta name="description" content="{{ config.tags.index.description }}">
{% endblock %}

{% block content %}
	
	<div class="container padding-xs">
		<div class="row">
			<div class="col-lg-8">
				<h1>{{ trans('index.welcome') }}</h1>

				<hr>

				<h2>Requirements</h2>

				<p>PHP Version 7.0 or above.</p>

				<p>Download <a href="https://getcomposer.org/" target="_blank">Composer</a></p>

				<h3>Installation</h3>

				<p>Run Globally:</p>

				<code>composer create-project iconic-publishing/slim3-skeleton YOUR_PROJECT_NAME</code>
				
				<hr>
				
				<p>Run Locally with PHP:</p>

				<code>php composer.phar create-project iconic-publishing/slim3-skeleton YOUR_PROJECT_NAME</code>
				
				<hr>
				
				<h4>Features</h4>
				
				<ul class="unstyled">
					<li>Bootstrap 4.1.0</li>
					<li>Font Awesome 4.7.0</li>
					<li>Swift Mailer</li>
					<li>Mailgun</li>
					<li>Twilio</li>
					<li>MailChimp</li>
					<li>Stripe <i class="fa fa-cc-stripe" aria-hidden="true"></i></li>
				</ul>
			</div>

			<div class="col-lg-4">
				<h2>Sample Pages</h2>

				<hr>

				<h4>Language Switcher</h4>

				{% set locales = config.locales %}

				{% for locale, name in locales %}
					{% if locale() != locale %}
						<a href="switcher/{{ locale }}">{{ name }}</a> |
					{% endif %}
				{% endfor %}

				<hr>

				<h4>Currency Converter</h4>
				
				<p>{{ currency.convert(2, 'USD', 'GBP') | json_encode() }}</p>

				<hr>

				<ul>
					<li><a href="{{ path_for('getBlogs') }}">View Sample Blog Page</a></li>
					<li><a href="{{ path_for('contact') }}">View Sample Contact Page</a></li>
					<hr>
					<li><a href="{{ path_for('getRegister') }}">View Sample Register Page</a></li>
					<li><a href="{{ path_for('getLogin') }}">View Sample Login Page</a></li>
					<li><a href="{{ path_for('getRecoverPassword') }}">View Sample Recover Password</a></li>
				</ul>
			</div>
		</div>
	</div>

{% endblock %}
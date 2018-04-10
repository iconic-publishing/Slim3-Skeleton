{% extends 'includes/layout.php' %}

{% block tags %}
<title>{{ config.tags.index.title }}</title>
<meta name="description" content="{{ config.tags.index.description }}">
{% endblock %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h1>{{ trans('index.welcome') }}</h1>
					
					<hr>
					
					<h2>Requirements</h2>
					
					<p>PHP Version 7.0 or above.</p>
					
					<p>Download <a href="https://getcomposer.org/" target="_blank">Composer</a></p>
					
					<h3>Installation</h3>
					
					<p>Run Globally:</p>
					
					<pre>composer create-project iconic-publishing/slim3-skeleton skeleton</pre>
					
					<p>Run Locally with PHP:</p>
					
					<pre>php composer.phar create-project iconic-publishing/slim3-skeleton skeleton</pre>
				</div>
				
				<div class="col-md-4">
					<h2>Sample Pages</h2>
					
					<hr>
					
					<p>Language Switcher</p>
					
					{% set locales = config.locales %}

					{% for locale, name in locales %}
						{% if locale() != locale %}
							<a href="switcher/{{ locale }}">{{ name }}</a> |
						{% endif %}
					{% endfor %}
					
					<hr>
					
					<p>Currency Converter: {{ currency.convert(2, 'USD', 'GBP') | json_encode() }}</p>
					
					<hr>
					
					<ul>
						<li><a href="{{ path_for('getPress') }}">View Sample Press Page</a></li>
						<li><a href="{{ path_for('contact') }}">View Sample Contact Page</a></li>
						<hr>
						<li><a href="{{ path_for('getRegister') }}">View Sample Register Page</a></li>
						<li><a href="{{ path_for('getLogin') }}">View Sample Login Page</a></li>
						<li><a href="{{ path_for('getRecoverPassword') }}">View Sample Recover Password</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

{% endblock %}
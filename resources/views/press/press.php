{% extends 'includes/layout.php' %}

{% block content %}

	<section class="padding-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p><a href="{{ path_for('index') }}">Back to Homepage</a></p>
				</div>
				
				<div class="col-md-8">
					<h2>Sample Press Page - <small><code>app/Controllers/PressController.php</code></small></h2>
					
					<hr>
					
					{% for press in press %}
						<h3><a href="{{ path_for('getPressDetails', {slug: press.slug}) }}">{{ press.title }}</a></h3>
						<!-- Option for Full Description -->
						<!--<p>{{ press.description | nl2br }}</p>-->
						
						<!-- Option for Partial sliced Description -->
						<p>{{ press.description | slice(0, 250) ~ ' [...]' }}</p>
					
						<a class="btn btn-primary btn-sm" href="{{ path_for('getPressDetails', {slug: press.slug}) }}">Read More</a>
							
						<p><small>Posted: {{ press.published_on | date('jS F, Y') }}</small></p>
						
						<hr>
					{% endfor %}
					
					{{ press.links | raw }}
					<br>
					<code>resources/views/pagination/pagination.php</code>
				</div>
				
				{% include 'press/side-bar/side-bar-press.php' %}
			</div>
		</div>
	</section>

{% endblock %}
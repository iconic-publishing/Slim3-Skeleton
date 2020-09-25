{% extends 'includes/layout.php' %}

{% block content %}

	<div class="container padding-xs">
		<div class="row">
			<div class="col-lg-12">
				<p><a href="{{ path_for('logout') }}">Logout</a></p>
			</div>

			<div class="col-lg-12">
				<h2>Members Area | {{ user.isUserType() }}</h2>

				<p>Hi {{ user.getFirstNameOrUsername() }}, you are now signed in.</p>
			</div>
		</div>
	</div>
	
{% endblock %}
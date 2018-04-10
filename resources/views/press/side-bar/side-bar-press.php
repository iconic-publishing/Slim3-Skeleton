				
				<div class="col-md-4">
					<h2>Recent Press</h2>
					
					<hr>
					
					<ul>
						{% for press in sideBar %}
							<li><a href="{{ path_for('getPressDetails', {slug: press.slug}) }}">{{ press.title }}</a></li>
						{% endfor %}
					</ul>
				</div>
				
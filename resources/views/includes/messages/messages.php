
{% if flash.getMessage('success') %}
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ flash.getMessage('success') | first }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
{% endif %}

{% if flash.getMessage('error') %}
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{ flash.getMessage('error') | first }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
{% endif %}

{% if flash.getMessage('info') %}
	<div class="alert alert-info alert-dismissible fade show" role="alert">
		{{ flash.getMessage('info') | first }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
{% endif %}

{% if flash.getMessage('warning') %}
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		{{ flash.getMessage('warning') | first }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
{% endif %}
                   
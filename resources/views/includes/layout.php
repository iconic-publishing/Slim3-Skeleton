<!doctype html>
<html lang="{{ config.app.locale }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{% block tags %}{% endblock %}
<meta name="robots" content="{{ config.meta.robots }}">
<meta name="copyright" content="{{ config.meta.copyright }}">
<meta name="author" content="{{ config.meta.author }}">
<link rel="stylesheet" href="{{ base_url() }}/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ base_url() }}/assets/css/custom.css">
</head>

<body oncontextmenu="{{ config.app.onContextMenu }}">
	
	{% block content %}{% endblock %}
	
	<script src="{{ base_url() }}/assets/js/jquery-2.2.3.min.js"></script>
	<script src="{{ base_url() }}/assets/js/bootstrap.min.js"></script>
	<script src="{{ base_url() }}/assets/js/custom.js"></script>
</body>
</html>
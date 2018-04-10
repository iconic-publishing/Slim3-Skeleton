
{% if flash.getMessage('success') %}
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ flash.getMessage('success') | first }}
    </div>
{% endif %}

{% if flash.getMessage('error') %}
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ flash.getMessage('error') | first }}
    </div>
{% endif %}

{% if flash.getMessage('info') %}
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ flash.getMessage('info') | first }}
    </div>
{% endif %}

{% if flash.getMessage('warning') %}
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ flash.getMessage('warning') | first }}
    </div>
{% endif %}
                    
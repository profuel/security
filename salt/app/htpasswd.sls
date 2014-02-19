# Create and manage .htpasswd files
# Note - the paths here should be aligned with paths defined in grain app config

{% if 'web' in grains.roles %}
production-zed:
  apache.useradd:
    - pwfile: /etc/nginx/htpasswd-zed
    - user: projecta
    - password: mate21mg

staging:
  apache.useradd:
    - pwfile: /etc/nginx/htpasswd-zed
    - user: projecta
    - password: mate21mg
{% endif %}
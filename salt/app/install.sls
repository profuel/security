install helper app utilities:
  pkg.installed:
    - pkgs:
      - doxygen
      - graphviz
      - libjpeg-progs
      - apache2-utils

/data/shop:
  file.directory:
    - makedirs: true
    - user: www-data
    - group: www-data
    - dir_mode: 755

/data/logs:
  file.directory:
    - makedirs: true
    - user: www-data
    - group: www-data
    - dir_mode: 755

/data/storage:
  file.directory:
    - makedirs: true
    - user: www-data
    - group: www-data
    - dir_mode: 755


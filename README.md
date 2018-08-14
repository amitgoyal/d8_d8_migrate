# d8_d8_migrate
Drupal 8 to Drupal 8 Content Migration

1) Add source database details in settings.php (or local.settings.php),

$databases['migrate']['default'] = array(
  'driver' => 'mysql',
  'database' => 'lightning',
  'username' => 'drupaluser',
  'password' => '',
  'host' => '127.0.0.1',
  'port' => 33067
);

2) Enable the module ncs_migrate

3) Migrate the content using drush,

drush ms
drush mim ncs_page

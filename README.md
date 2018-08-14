# d8_d8_migrate
Drupal 8 to Drupal 8 Content Migration

1) Add source database details in settings.php (or local.settings.php),

```
$databases['migrate']['default'] = array(
  'driver' => 'mysql',
  'database' => 'lightning',
  'username' => 'drupaluser',
  'password' => '',
  'host' => '127.0.0.1',
  'port' => 33067
);
```

2) Duplicate config/install//migrate_plus.migration.ncs_page.yml for all the other entities and make changes as per source entity.

3) Enable the module ncs_migrate

4) Migrate the content using drush,

```
drush ms
drush mim ncs_page
```

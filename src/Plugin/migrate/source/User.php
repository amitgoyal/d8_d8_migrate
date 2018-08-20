<?php

namespace Drupal\ncs_migrate\Plugin\migrate\source;
//namespace Drupal\migrate_drupal_d8\Plugin\migrate\source\d8;

use Drupal\migrate_drupal_d8\Plugin\migrate\source\d8\ContentEntity;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\State\StateInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\Row;

/**
 * Drupal 8 user source from database.
 *
 * @MigrateSource(
 *   id = "d8_ncs_user",
 *   source_provider = "ncs_migrate"
 * )
 */
class User extends ContentEntity {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration, StateInterface $state, EntityTypeManagerInterface $entity_type_manager, EntityFieldManagerInterface $entity_field_manager) {
    $configuration['entity_type'] = 'user';
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration, $state, $entity_type_manager, $entity_field_manager);
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Selects roles for given user id.
    $roles = $this->select('user__roles', 'ur')
      ->fields('ur', ['roles_target_id'])
      ->condition('ur.entity_id', $row->getSourceProperty('uid'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('roles', $roles);

    return parent::prepareRow($row);
  }

}

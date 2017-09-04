<?php

use Drupal\organization_feed\OrganizationFeed;

/**
* @file Contains the code to generate the custom drush commands.
*/
/**
* Implements hook_drush_command().
*/
function organization_feed_drush_command() {
 $items = array();
 $items['import-organization'] = [
   'description' => 'Run the organization import',
   'drupal dependencies' => ['organization_feed'],
 ];

 $items['delete-organization'] = [
   'description' => 'Run the organization delete',
   'drupal dependencies' => ['organization_feed'],
 ];
 return $items;
}

/**
* Call back function drush_custom_drush_command_say_hello()
* The call back function name in the  following format
*   drush_{module_name}_{item_id_for_command}()
*/
function drush_organization_feed_import_organization() {
  drush_print('Start Creating Organization Feed process.');
  $importer = new OrganizationFeed();
  $results = $importer->run('create');
  drush_print("Finish Creating Organization Feed process. Create $results.");
}

function drush_organization_feed_delete_organization() {
  drush_print('Start Deleting Organization Feed process.');
  $importer = new OrganizationFeed();
  $results = $importer->run('delete');
  drush_print("Finish Deleting Organization Feed process.");
}

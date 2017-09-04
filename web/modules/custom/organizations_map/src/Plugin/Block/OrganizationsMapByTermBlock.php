<?php

namespace Drupal\organizations_map\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;

/**
 * Provides a 'OrganizationsMapByTermBlock' block.
 *
 * @Block(
 *  id = "organizations_map_by_term_block",
 *  admin_label = @Translation("Organizations Map By Term Block"),
 * )
 */
class OrganizationsMapByTermBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    dpm(\Drupal::request());
    $current_term = \Drupal::request()->attributes->get('taxonomy_term');
    
    if(!empty($current_term)) {
      $current_term_tid = $current_term->id();

      return [
        '#theme' => 'organizations_map_by_term',
        '#attached' => array(
          'library' =>  array(      
            'organizations_map/libraries',
          ),
          'drupalSettings' => [
            'tid' => $current_term_tid,
          ],
        ),
      ];
    }

    return NULL;
  }
}

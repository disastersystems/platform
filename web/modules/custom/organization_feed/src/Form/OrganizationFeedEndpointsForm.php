<?php

namespace Drupal\organization_feed\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class OrganizationFeedEndpointsForm.
 *
 * @package Drupal\organization_feed\Form
 */
class OrganizationFeedEndpointsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'organization_feed.endpoints',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'organization_feed_endpoints_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('organization_feed.endpoints');
    $form['organization_endpoint'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Organization Endpoint'),
      '#description' => $this->t('Endpoint to get Organization Info.'),
      '#default_value' => $config->get('organization'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('organization_feed.endpoints')
      ->set('organization', $form_state->getValue('organization_endpoint'))
      ->save();
  }

}

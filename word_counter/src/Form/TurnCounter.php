<?php

namespace Drupal\word_counter\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the SimpleForm form controller.
 *
 * This example demonstrates a simple form with a single text input element. We
 * extend FormBase which is the simplest form base class used in Drupal.
 *
 * @see \Drupal\Core\Form\FormBase
 */
class TurnCounter extends ConfigFormBase {

  /**
   * Getter method for Form ID.
   *
   * @return string
   *   The unique ID of the form defined by this class.
   */
  public function getFormId(){
    return 'word_counter_turn_counter';
  }

  /**
   * Getter the configuration names that will be editable.
   *
   * @return array
   */
  protected function getEditableConfigNames(){
    return ['word_counter.config'];
  }

  /**
   * Build the form for enable world counter.
   *
   * @param array $form
   *   Default form array structure.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state){

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This is basic configuration enable "word counter"'),
    ];

    $form['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable word counter'),
      '#description' => $this->t('If it enable, "word counter" will seen after every articles'),
      '#default_value' => $this->config('word_counter.config')->get('enable'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['save'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * Implements form validation.
   *
   * The validateForm method is the default method called to validate.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state){
    parent::validateForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   * Save config and clear cache pages
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $enable = $form_state->getValue('enable');
    $this->messenger()->addMessage($this->t('Word counter is %enable.', [
      '%enable' => $enable ? $this->t('enable') : $this->t('disable'),
    ]));
    $this->config('word_counter.config')->set('enable', $enable)->save();

    \Drupal::service('cache.render')->invalidateAll();
    \Drupal::service("router.builder")->rebuild();
  }

}

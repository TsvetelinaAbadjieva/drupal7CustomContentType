<?php

function silverpro_theme(){
  $items = array();
  // create custom user-login.tpl.php
  $items['user_login'] = array(
  'render element' => 'form',
  'path' => drupal_get_path('theme', 'logintheme') . '/templates',
  'template' => 'user-login',
  'preprocess functions' => array(
  'your_themename_preprocess_user_login'
  ),
  $items['user_login'] = array(
  'render element' => 'form',
  'path' => drupal_get_path('theme', 'logintheme') . '/templates',
  'template' => 'user-login',
  'preprocess functions' => array(
  'your_themename_preprocess_user_login'
  ),

 );
return $items;
}

function silverpro_form(&$form, &$form_state){
  drupal_add_library('system', 'drupal.ajax');
  drupal_add_library('system', 'drupal.form');
  $form = [];
  $form['user_login'][] = array(
    'username' => array(
      '#type' => 'texfield',
      '#default_value' => isset($form_state['values']['username']) ? $form_state['values']['username']:'',
      '#length' => 30
    ),
    'pass' => array(
      '#type' => 'texfield',
      '#default_value' => isset($form_state['values']['pass']) ? $form_state['values']['pass']:'',
      '#length' => 30
    ),
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value'=> 'Login',
    '#validation' => 'validate_login',
    '#ajax' => array(
          'callback' => 'login_ajax_callback',
          'wrapper' => 'selection_form'
        ),
  );
}

/**
* Preprocess function providing values for the HTML template that will be returned for article extra info request.
*/
function silverpro_preprocess_users_extra_info(&$variables) {
 $image_options = array(
   'style_name' => 'mini',
   'path' => $variables['node']->field_main_image[LANGUAGE_NONE][0]['uri']
 );
 $variables['article_image'] = theme_image_style($image_options);
 [...]
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
// function [OUR_MODULE]_form_[OUR_CONTENT_TYPE]_node_form_alter(&$form, &$form_state, $form_id) {foreach ($form['field_sidekick_slide_reference'][LANGUAGE_NONE] as $k => &$row) {
function silverpro_form_users_node_form_alter(&$form, &$form_state, $form_id) {
  foreach ($form['users_reference'][LANGUAGE_NONE] as $k => &$row) {
   if (is_numeric($k)) {
     $row['users_reference'] = array(
       '#type' => 'markup',
       '#markup' => '',
       '#weight' => 900,
     );
   }
 }
 $module_path = drupal_get_path('module', 'silverpro');
 drupal_add_css($module_path . '/css/users_add_edit_form.css');
 drupal_add_js($module_path . '/js/users_autocomplete_form.js');
}

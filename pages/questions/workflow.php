<?php
/**
 * Workflow overview page
 *
 * @package ElggQuestions
 */

if (get_input('group_guid')) {
  elgg_set_page_owner_guid(get_input('group_guid'));
} else {
  elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}

// set breadcrumb
elgg_push_breadcrumb(elgg_echo("questions:workflow"), "questions/workflow");

$page_owner = elgg_get_page_owner_entity();
if (elgg_instanceof($page_owner, 'group')) {
  elgg_push_breadcrumb($page_owner->name);
}


// prepare options
$dbprefix = elgg_get_config("dbprefix");
$correct_answer_id = add_metastring("correct_answer");

$settings = array(
  'type' => 'object',
  'subtype' => 'question',
  'full_view' => false,
  'list_type_toggle' => false,
  'workflow' => true
); 

if (get_input('group_guid')) {
  $settings['container_guid'] = get_input('group_guid');
}

$content = elgg_view('questions/workflow/all');
$content .= elgg_list_entities($settings);

if (!$content) {
  $content = elgg_echo('questions:none');
}

$title = elgg_echo("questions:workflow");

$body = elgg_view_layout("content", array(
  "title" => $title,
  "content" => $content,
  "filter_context" => ""
));

echo elgg_view_page($title, $body);

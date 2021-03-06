<?php
/**
 * All questions page
 *
 * @package ElggQuestions
 */

elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'question',
	'full_view' => false,
	'list_type_toggle' => false,
	'order_by' => 'e.last_action desc'
)); 

if (!$content) {
	$content = elgg_echo('questions:none');
}

$title = elgg_echo('questions:everyone');

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
));

echo elgg_view_page($title, $body);

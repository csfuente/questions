<?php
/**
 * Delete question
 *
 * @package Questions
 *
 */

$guid = (int) get_input('guid');
$question = get_entity($guid);

if (!$question instanceof ElggQuestion) {
	register_error(elgg_echo("ClassException:ClassnameNotClass", array($guid, elgg_echo("item:object:question"))));
	forward(REFERER);
}

if (!$question->canEdit()) {
	register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
	forward(REFERER);
}

$question->delete();
forward(get_input('forward', "questions/all"));

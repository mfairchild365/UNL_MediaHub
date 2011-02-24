<?php
echo '{ "id":'.$context->id.',
        "url":"'.htmlspecialchars($context->url).'",
        "title":"'.htmlspecialchars($context->title).'",
        "description":"'.trim(strip_tags($context->description)).'",
        "length":'.$context->length.',
        "image":"'.UNL_MediaYak_Controller::getURL($context).'/image",
        "type":"'.htmlspecialchars($context->type).'",
        "author":"'.htmlspecialchars($context->author).'",
        "datecreated":"'.$context->datecreated.'",
        "dateupdated":"'.$context->dateupdated.'"}';
<?php

Breadcrumbs::for('frontend.single-post', function ($trail, $title) {
    $trail->push(__('strings.frontend.post'), route('frontend.single-post', $title));
});

<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->push(__('strings.backend.dashboard.categories'), route('admin.categories.index'));
});

Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->push(__('strings.backend.dashboard.news'), route('admin.news.index'));
});

Breadcrumbs::for('admin.posts.index', function ($trail) {
    $trail->push(__('strings.backend.dashboard.posts'), route('admin.posts.index'));
});

Breadcrumbs::for('admin.timebelt.index', function ($trail) {
    $trail->push(__('Timebelt'), route('admin.timebelt'));
});

Breadcrumbs::for('admin.timebelt', function ($trail) {
    $trail->push(__('Timebelt'), route('admin.timebelt'));
});

Breadcrumbs::for('admin.timebelt.create', function ($trail) {
    $trail->push(__('Timebelt  /  Create'), route('admin.timebelt.create'));
});

Breadcrumbs::for('admin.timebelt.store', function ($trail) {
    $trail->push(__('Timebelt'), route('admin.timebelt'));
});

Breadcrumbs::for('admin.timebelt.edit', function ($trail) {
    $trail->push(__('Timebelt / Update'), route('admin.timebelt'));
});

Breadcrumbs::for('admin.timebelt.update', function ($trail) {
    $trail->push(__('Timebelt / Update'), route('admin.timebelt'));
});

Breadcrumbs::for('admin.timebelt.delete', function ($trail) {
    $trail->push(__('Timebelt'), route('admin.timebelt'));
});



Breadcrumbs::for('admin.logo_setting.index', function ($trail) {
    $trail->push(__('Logo Setting'), route('admin.logo_setting'));
});

Breadcrumbs::for('admin.logo_setting', function ($trail) {
    $trail->push(__('Logo Setting'), route('admin.logo_setting'));
});

Breadcrumbs::for('admin.logo_setting.create', function ($trail) {
    $trail->push(__('Logo Setting  /  Create'), route('admin.logo_setting.create'));
});

Breadcrumbs::for('admin.logo_setting.store', function ($trail) {
    $trail->push(__('Logo Setting'), route('admin.logo_setting'));
});

Breadcrumbs::for('admin.logo_setting.edit', function ($trail) {
    $trail->push(__('Logo Setting / Update'), route('admin.logo_setting'));
});

Breadcrumbs::for('admin.logo_setting.update', function ($trail) {
    $trail->push(__('Logo Setting / Update'), route('admin.logo_setting'));
});

Breadcrumbs::for('admin.logo_setting.delete', function ($trail) {
    $trail->push(__('Logo Setting'), route('admin.logo_setting'));
});


require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

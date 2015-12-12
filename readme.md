# TPC Vendors

## **Current Version** 0.1.3

## Description
Plugin for Vendor custom post type. Styled via theme and frontend markup built with Foundation for Sites 5 markup structure.

This plugin was built specifically for Tax Preparer Connections.

## Features
* Easily create landing pages for vendors.
* Manage affiliate links from each vendor.
* Flexible content adding via repeatable modules.
* Extremely lightweight and styled via theme CSS.
* Foundation for Sites 5 markup structure.

## Release Notes

### 0.1.0

A basic set up of backend content input and frontend markup building functions. The point is so that a backend input field is not set, then they HTML used to display that value on the frontend is fully ommitted from the mark up so that no extra markup remains on the page if it is not in use.

As of now there is no archive page tempate.

## Changelog

### 0.1.3

* `textarea_name` key and value removed from WYSIWYG options array so it defaults to `$editor_id` without creating an `undefined variable` error.
* DocBlock comments updated for easier future troubleshooting.

### 0.1.2

* File header meta edited to allow use with [GitHub Updater](https://github.com/afragen/github*updater).
* readme.txt file added.

### 0.1.1

* Section title markup no longer outputs if field is left empty.
* Extra content section title now uses the same markup as the others.

## Dependancies
This plugin uses the [CMB2 framework](https://github.com/WebDevStudios/CMB2) for custom metaboxes and input field generation.


# Datasheets WordPress Plugin

**Plugin Name:** Datasheets  
**Plugin URI:** [https://github.com/H-Mahmud/datasheets](https://github.com/H-Mahmud/datasheets)  
**Description:** The Datasheets plugin allows you to create, update, and delete entries in a custom table called `data` while mapping these entries to a custom post type `data` with custom meta fields in WordPress. This integration enables you to manage custom data alongside your WordPress content.

**Version:** 1.0.0  
**Author:** Mahmudul Hasan
**Author URI:** [https://imahmud.com](https://imahmud.com)  
**License:** GPL-2.0-or-later  
**License URI:** [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)

---

## Table of Contents

-   [Description](#description)
-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Custom Post Type](#custom-post-type)
-   [Hooks & Filters](#hooks--filters)
-   [Changelog](#changelog)
-   [Contributing](#contributing)
-   [License](#license)

---

## Description

The Datasheets plugin is designed to create and manage a custom table named `data` within your WordPress database, as well as a custom post type called `data` with custom meta fields. It allows you to perform create, update, and delete operations on both the custom table and the custom post type, ensuring that your data is synchronized across your WordPress site.

### Key Features:

-   **Custom Table Creation:** Automatically creates a custom table named `data` in your WordPress database.
-   **Custom Post Type:** Creates a custom post type called `data` with custom meta fields.
-   **Data Management:** Easily create, update, and delete data entries in the custom table and custom post type.
-   **Post Mapping:** Map data entries to WordPress posts to maintain synchronized content.
-   **Admin Interface:** Manage your data entries, custom post types, and mappings directly from the WordPress admin dashboard.

## Features

-   **Custom Database Table:** Automatically creates a `data` table in the WordPress database.
-   **Custom Post Type:** Creates a custom post type called `data` with support for custom meta fields.
-   **CRUD Operations:** Allows Create, Read, Update, and Delete operations on both the custom table data and the custom post type.
-   **Mapping to WordPress Posts:** Each entry in the custom `data` table and custom post type is mapped to a WordPress post, ensuring synchronized updates.
-   **Admin Panel Integration:** Provides an intuitive admin interface for managing the custom data, post types, and their relationships with posts.

## Installation

### From the WordPress Dashboard:

1. Navigate to `Plugins > Add New`.
2. Search for "Datasheets".
3. Click "Install Now".
4. After installation, click "Activate".

### Manual Installation:

1. Download the plugin zip file.
2. Extract the zip file.
3. Upload the `datasheets` folder to the `/wp-content/plugins/` directory.
4. Activate the plugin through the "Plugins" menu in WordPress.

### After Activation:

-   The plugin will automatically create a custom table named `data` and a custom post type `data` in your WordPress database.
-   Access the Datasheets management page under the WordPress admin menu to start creating and managing data entries and custom post types.

## Usage

### Managing Datasheets

1. **Access the Datasheets Admin Page:**

    - Navigate to `Datasheets` in the WordPress admin sidebar.

2. **Creating a New Datasheet Entry:**

    - Click on "Add New".
    - Fill in the necessary fields, including data that will be stored in the custom `data` table and custom post type.
    - Map the entry to an existing WordPress post or create a new post directly from the form.

3. **Editing an Existing Datasheet Entry:**

    - Click on "Edit" next to the entry you want to modify.
    - Make changes to the data, custom meta fields, and the mapped WordPress post as needed.
    - Save your changes.

4. **Deleting a Datasheet Entry:**
    - Click on "Delete" next to the entry you want to remove.
    - The entry will be removed from both the custom `data` table, the custom post type, and the associated WordPress post.

### Shortcode Usage

You can display the data entries on your site using the following shortcode:

```php

```

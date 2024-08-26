<?php defined('ABSPATH') || exit; ?>
<div class="wrap">
    <h1><?php echo get_admin_page_title(); ?></h1>
    <div class="import-container">
        <h1 class="title">Import Data From CSV</h1>
        <hr>
        <form id="import-form">
            <table class="form-table">
                <tr>
                    <th>Insert A CSV File</th>
                    <td>
                        <div>
                            <button class="button insert-csv">Insert CSV</button>
                            <input type="hidden" required name="csv-file" id="" value="" />
                            <a href="#" class="remove-csv">Remove CSV</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p id="header-parser-error"></p>
                    </td>
                </tr>
                <tbody class="data-mapping-form">
                    <tr>
                        <th><label for="title">Title</label></th>
                        <td>
                            <select name="title" id="title">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="manufacturer_name">Manufacturer Name</label></th>
                        <td>
                            <select name="manufacturer_name" id="manufacturer_name">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="part_number">Part Number</label></th>
                        <td>
                            <select name="part_number" id="part_number">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="file_name">File Name</label></th>
                        <td>
                            <select name="file_name" id="file_name">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="description">Description</label></th>
                        <td>
                            <select name="description" id="description">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="source_url">Source Url</label></th>
                        <td>
                            <select name="source_url" id="source_url">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="file_url">File Url</label></th>
                        <td>
                            <select name="file_url" id="file_url">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Action Type</th>
                        <td>
                            <input type="radio" id="import" name="action" value="import" checked>
                            <label for="import">Import Only</label><br>
                            <input type="radio" id="import_update" name="action" value="import_update">
                            <label for="import_update">Import with Update</label><br>
                            <input type="radio" id="update" name="action" value="update">
                            <label for="update">Update Only</label>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <button type="submit" class="button button-primary">Submit</button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

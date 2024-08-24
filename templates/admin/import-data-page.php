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
            </table>
        </form>
    </div>
</div>

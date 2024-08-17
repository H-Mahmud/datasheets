<?php
/**
 * Custom search template for data search
 */

get_header();
?>
<div id="primary" class="content-area">
    <div class="content-container site-container">
        <main id="main" class="site-main" role="main">
            <div class="content-wrap">
                <?php


                // Usage
                $args = [
                    'number' => 5,
                    'offset' => 0,
                    'orderby' => 'id',
                    'order' => 'DESC',
                    'search' => 'hello',
                ];

                $data_query = new Data_Query($args);

                ?>
                <p><?php echo number_format($data_query->found_data()) ?> results found in
                    <?php echo number_format($data_query->time_taken(), 5); ?> seconds
                </p>
                <?php

                echo $data_query->pagination(get_pagenum_link());

                if ($data_query->have_data()) {

                    echo <<<HTML
                    <table class="ds-container">
                        <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Manufacturer name</th>
                                <th>Description</th>
                                <th>View PDF</th>
                                <th>Download PDF</th>
                                <th>View</th>
                            <tr>
                        </thead>
                    HTML;

                    while ($data_query->have_data()) {
                        $data_query->the_data();

                        $data_query->the_title();

                        $part_number = $data_query->get_part_number();
                        $manufacturer_name = $data_query->get_manufacturer_name();
                        $description = $data_query->get_description();
                        $view_document = '';
                        $download_document = '';
                        $file_name = $data_query->the_title();
                        $title = $data_query->the_title();

                        echo <<<HTML
                        <tr>
                            <td>$part_number</td>
                            <td>$manufacturer_name</td>
                            <td>$description</td>
                            <td>$view_document</td>
                            <td>$download_document</td>
                            <td>$title</td>
                        </tr>
                        HTML;
                    }
                    echo '</table>';
                } else {
                    get_template_part('template-parts/content/error');
                }
                ?>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>


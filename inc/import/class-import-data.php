<?php
defined('ABSPATH') || exit;
/**
 * Bulk insert Data from CSV file
 *
 * @since 1.0.0
 * @version 2.0.0
 */
class Datasheets_Import_Data
{

    /**
     * Current Class instance
     * @var Datasheets_Import_Data
     */
    private static $instance;

    /**
     * Run Class functions
     *
     */
    final private function __construct()
    {
        add_action('wp_ajax_read_csv_header', array($this, 'read_csv_header'), 10);
    }

    /**
     * Get singleton instance of the class
     *
     * @return Datasheets_Import_Data
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Datasheets_Import_Data();
        }
        return self::$instance;
    }

    /**
     * AJAX cb - CSV header response
     */
    public function read_csv_header()
    {
        $this->validate_request();

        $csv_id = $_POST['csvId'];

        $file_path = get_attached_file($csv_id);
        if (!file_exists($file_path))
            wp_send_json_error(['message' => 'File not found',], 400);



        $csvFile = fopen($file_path, 'r');
        ;
        if (!$csvFile)
            wp_send_json_error(['message' => 'Failed to read the CSV file.'], 500);

        $data = [];
        for ($i = 0; $i < 2 && ($row = fgetcsv($csvFile)) !== false; $i++) {
            $data[] = $row;
        }
        fclose($csvFile);

        if (empty($data))
            wp_send_json_error(['message' => 'Empty file no data found'], 400);

        wp_send_json_success($data);
    }

    /**
     * Verify Data Import Request
     *
     */
    public function validate_request()
    {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], '_import-csv')) {
            wp_send_json_error(array(
                'message' => 'Unauthorized request',
            ), 401); // Unauthorized
        }

        // Verify CSV ID
        if (!isset($_POST['csvId']) || empty($_POST['csvId'])) {
            wp_send_json_error(array(
                'message' => 'CSV file is not defined',
            ), 400); // Bad Request
        }
    }
}

Datasheets_Import_Data::getInstance();

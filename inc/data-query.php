<?php
defined('ABSPATH') || exit();

class Data_Query
{
    private $db;
    private $results;
    private $current_data;
    private $current_index = -1;
    private $total;
    private $time_taken;
    private $args;

    public function __construct($args = [])
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->args = wp_parse_args($args, [
            'number' => 10,
            'offset' => 0,
            'orderby' => 'id',
            'order' => 'DESC',
            'search' => '',
        ]);

        $this->query();
    }

    private function query()
    {
        $start_time = microtime(true);

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->db->prefix}data";

        $where = [];

        if (!empty($this->args['search'])) {
            $search = esc_sql($this->args['search']);
            $where[] = "(`title` LIKE '%$search%' OR `name` LIKE '%$search%')";
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $sql .= " ORDER BY {$this->args['orderby']} {$this->args['order']}";
        $sql .= " LIMIT {$this->args['offset']}, {$this->args['number']}";

        $this->results = $this->db->get_results($sql);
        $this->total = $this->db->get_var("SELECT FOUND_ROWS()");
        $this->time_taken = microtime(true) - $start_time;
    }

    public function have_data()
    {
        return $this->current_index < count($this->results);

    }

    public function the_data()
    {
        $this->current_index++;
        if ($this->current_index < count($this->results))
            $this->current_data = $this->results[$this->current_index];
    }

    public function get_title()
    {
        return isset($this->current_data->title) ? esc_html($this->current_data->title) : '';
    }

    public function get_name()
    {
        return isset($this->current_data->name) ? esc_html($this->current_data->name) : '';
    }

    public function get_manufacturer_name()
    {
        return isset($this->current_data->manufacturer_name) ? esc_html($this->current_data->manufacturer_name) : '';
    }

    public function get_part_number()
    {
        return isset($this->current_data->part_number) ? esc_html($this->current_data->part_number) : '';
    }

    public function get_file_name()
    {
        return isset($this->current_data->file_name) ? esc_html($this->current_data->file_name) : '';
    }

    public function get_description()
    {
        return isset($this->current_data->description) ? esc_html($this->current_data->description) : '';
    }

    public function found_data()
    {
        return $this->total;
    }

    public function time_taken()
    {
        return $this->time_taken;
    }

    public function pagination($base_url)
    {
        $total_pages = ceil($this->total / $this->args['number']);
        $current_page = ($this->args['offset'] / $this->args['number']) + 1;

        $pagination = paginate_links([
            'base' => $base_url . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ]);

        return $pagination;
    }
}

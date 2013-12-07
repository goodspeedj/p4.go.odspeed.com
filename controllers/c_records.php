<?php
class records_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        if(!$this->user) {
            Router::redirect('/records/index');
        }
    } 


    /**
     * Pull back the build records from the database
     */
    public function index() {

        function clean ($string) {
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }

        // Setup the view
        $this->template->content = View::instance('v_records_index');
        $this->template->title   = "Build Records";

        // Get the build records
        $sql = "SELECT components.name AS comp_name, 
                       products.name AS prod_name, 
                       builds.build_num, 
                       builds.status,
                       builds.created, 
                       builds.duration,
                       builds.job_name
                FROM builds
                INNER JOIN components
                    ON builds.component_id = components.component_id
                INNER JOIN products
                    ON components.product_id = products.product_id
                ORDER BY builds.created";

        $records = DB::instance(DB_NAME)->select_rows($sql);

        $this->template->content->records = $records;

        // Display the view
        echo $this->template;
    }


    /**
     * Add new build records to the database
     */
    public function add() {

        $this->template->content = View::instance('v_records_add');
        $this->template->title   = "Add new record";

        $sql = "SELECT name FROM products";
        $products = DB::instance(DB_NAME)->select_rows($sql);


        $sql = "SELECT name FROM components";
        $components = DB::instance(DB_NAME)->select_rows($sql);

        $this->template->content->products = $products;
        $this->template->content->components = $components;

        // Display the view
        echo $this->template;

    }


    /**
     * Process the add record form
     */
    public function p_add() {

        // Get current time
        $_POST['created']  = Time::now();

        $sql = "SELECT component_id
                FROM components
                WHERE '" . $_POST['component_id'] . "' = name";

        $comp_id = DB::instance(DB_NAME)->select_field($sql);

        $_POST['component_id'] = $comp_id;

        DB::instance(DB_NAME)->insert('builds', $_POST);

        Router::redirect('/records/index');

    }
}

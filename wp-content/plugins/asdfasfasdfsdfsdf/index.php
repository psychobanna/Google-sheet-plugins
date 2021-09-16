<?php

/**
 
 * @package Google Spreadsheet
 
 */

/*
 
Plugin Name: Error
 
Plugin URI: https://webtechbug.com/
 
Description: 
 
Version: 0.0.1
 
Author: WebTech Bug
 
Author URI: https://webtechbug.com/
 
License: later 
*/
add_action('admin_menu', 'google_sheet_plugin');

function google_sheet_plugin()
{
    $page_title = '';
    $menu_title = 'Error';
    $capability = '1';
    $menu_slug  = 'excel-import';
    $function   = 'excel_import';
    $icon_url   = 'dashicons-media-code';
    $position   = 4;
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
    $hook = add_submenu_page(
        null,
        __('Welcome', 'textdomain'),
        __('Welcome', 'textdomain'),
        'manage_options',
        'xmltoexcel-api',
        'xmltoexcel_api'
    );

    add_action('load-' . $hook, function () {
        // add your xml code here, 
        // you will get a blank page to start with
        xmltoexcel_api();
        exit;
    });

    $hook = add_submenu_page(
        null,
        __('Welcome', 'importurl'),
        __('Welcome', 'importurl'),
        'manage_options',
        'importurl-api',
        'importurl'
    );

    add_action('load-' . $hook, function () {
        // add your xml code here, 
        // you will get a blank page to start with
        importurl();
        exit;
    });
}


function excel_import()
{
?>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <div>
        <div style="width: 100%;">
            <div class="row mx-0 m-5">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h4>Import you data</h4>
                    </div>
                    <div class="col-md-12">
                        <form class="card" id="import-excel" method="post">
                            <div class="mb-3">
                                <label class="form-label">Import your Google Sheet</label>
                                <input type="text" class="form-control" name="google_sheet">
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Data</h4>
                    <div class="row m-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Excel Name</th>
                                    <th>Open</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Untitled</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Open</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Excel Name</th>
                                    <th>Open</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery("#import-excel").submit(function(event) {
            // alert();
            event.preventDefault();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo get_dashboard_url(); ?>admin.php?page=importurl-api",
                data: jQuery(this).serialize(),
                success: function(n){
                    alert(n);
                }
            });
        });
    </script>
<?php
}

function importurl(){
    require "vendor/autoload.php";
    $post = $_POST;
    $google_sheet = $post['google_sheet'];
    // print_r();
}
?>
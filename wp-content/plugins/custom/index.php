<?php
include("ExcelGenerate.php");
/**
 
 * @package XML to Excel
 
 */

/*
 
Plugin Name: XML to Excel
 
Plugin URI: https://webtechbug.com/
 
Description: 
 
Version: 0.0.1
 
Author: WebTech Bug
 
Author URI: https://webtechbug.com/
 
License: later 
*/
add_action('admin_menu', 'extra_post_info_menu');

function extra_post_info_menu()
{
    $page_title = 'XML to Excel';
    $menu_title = 'Convert Now';
    $capability = '1';
    $menu_slug  = 'xml-to-excel';
    $function   = 'xml_to_excel';
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
        __('Welcome', 'textdomain1'),
        __('Welcome', 'textdomain1'),
        'manage_options',
        'xmltoexceltable-api',
        'xmltoexcelloadtable'
    );

    add_action('load-' . $hook, function () {
        // add your xml code here, 
        // you will get a blank page to start with
        xmltoexcelloadtable();
        exit;
    });
}


function xml_to_excel()
{
?>
    <style>
        .drop-zone {
            max-width: 200px;
            height: 200px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            color: #cccccc;
            border: 4px dashed #009578;
            border-radius: 10px;
        }

        .drop-zone--over {
            border-style: solid;
        }

        .drop-zone__input {
            display: none;
        }

        .drop-zone__thumb {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #cccccc;
            background-size: cover;
            position: relative;
        }

        .drop-zone__thumb::after {
            content: attr(data-label);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 5px 0;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.75);
            font-size: 14px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <h4>XML TO EXCEL</h4>
    <div class="" style="display:flex;padding: 15px;">
        <div style="width:30%">
            <form method="post" id="xmltoexcel" enctype="multipart/form-data">
                <div class="drop-zone" style="width: 100%;">
                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                    <input type="file" id="myFile" name="myFile" accept="text/xml" class="drop-zone__input">
                </div>
                <div style="width: 100%">
                    <button type="submit" class="form-submit" style="margin: 15px;text-align:center;">Convert Now</button>

                    <button type="button" class="" id="loadtables">Load Table</button>
                </div>
            </form>

            <div class="" style="display:flex;padding: 15px;" id="tableload">
            </div>
        </div>
        <div style="width:70%;background:rgba(0, 0, 0, 1);color: white;border: 1px solid gray;padding: 5px;height:500px;overflow-y:scroll;" id="response">
        </div>
    </div>

    <script>
        jQuery("#tableload").hide();
        jQuery("#loadtables").click(function() {

            jQuery("#tableload").hide();
            jQuery("#tableload").fadeIn("slow");
            jQuery("#tableload").html("Loading...");
            jQuery.ajax({
                type: "get",
                url: "admin.php?page=xmltoexceltable-api"
            }).
            done(function(result) {
                document.getElementById("tableload").innerHTML = result;
            }).
            fail(function(error) {
                console.log(error);
            });

        });
        jQuery("#xmltoexcel").submit(function(e) {
            e.preventDefault();
            jQuery("#response").fadeIn("slow");
            jQuery("#response").html("Loading...");
            jQuery.ajax({
                type: "post",
                url: "admin.php?page=xmltoexcel-api",
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData(this)
            }).
            done(function(result) {
                // jQuery("#response").html(result);
                document.getElementById("response").innerHTML = "<pre><code>" + result + "</code></pre>";
            }).
            fail(function(error) {
                console.log(error);
            });
            jQuery(".drop-zone__input").html("Drop file here or click to upload");
        });

        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");

            dropZoneElement.addEventListener("click", (e) => {
                inputElement.click();
            });

            inputElement.addEventListener("change", (e) => {
                if (inputElement.files.length) {
                    updateThumbnail(dropZoneElement, inputElement.files[0]);
                }
            });

            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });

            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });

            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();

                if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
                }

                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        /**
         * Updates the thumbnail on a drop zone element.
         *
         * @param {HTMLElement} dropZoneElement
         * @param {File} file
         */
        function updateThumbnail(dropZoneElement, file) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

            // First time - remove the prompt
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }

            // First time - there is no thumbnail element, so lets create it
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }

            thumbnailElement.dataset.label = file.name;

            // Show thumbnail for image files
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }
    </script>
<?php

    global $wpdb;

    $table_name = $wpdb->prefix . "xmltoexcel";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
time datetime DEFAULT '0000-00-00 00:00:00' NULL,
name text NULL,
url varchar(55) DEFAULT '' NULL,
PRIMARY KEY  (id)
) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    // print_r($table_name);
}

function xmltoexcel_api()
{

    global $wpdb;

    $table_name = $wpdb->prefix . "xmltoexcel";

    define('ALLOW_UNFILTERED_UPLOADS', true);

    $uploadfile = $_FILES['myFile'];

    $tempdatafile = array('test_form' => FALSE);

    $xmlupload = wp_handle_upload($uploadfile, $tempdatafile);

    if ($xmlupload && !isset($xmlupload['error'])) {
        $xml = '';
        $xmlparser = xml_parser_create();

        $fp = fopen($xmlupload['url'], "r");
        $xmldata = fread($fp, 4096);

        // Parse XML data into an array
        xml_parse_into_struct($xmlparser, $xmldata, $values);

        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);

        xml_parser_free($xmlparser);
        $books = $values;
        $xlsx = SimpleXLSXGen::fromArray($books);
        $month = date("m");
        $year = date("Y");
        $name = pathinfo($uploadfile['name'], PATHINFO_FILENAME);
        $url = '../wp-content/uploads/' . $year . '/' . $month . '/' . $name . '.xlsx';
        $xlsx->saveAs($url);
        if ($result =
            $wpdb->insert($table_name, array(
                'name' => $name,
                'url' => $url
            ))
        ) {

            print_r($values);
        } else {
            print_r($result);
        }
        fclose($fp);
    } else {
        /**
         * Error generated by _wp_handle_upload()
         * @see _wp_handle_upload() in wp-admin/includes/file.php
         */
        print_r($xmlupload);
    }
}

function xmltoexcelloadtable()
{
?>

    <div style="width:100%;overflow-x:auto;">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php

                global $wpdb;

                $table_name = $wpdb->prefix . "xmltoexcel";

                $result = $wpdb->get_results("SELECT * FROM " . $table_name);
                foreach ($result as $print) {
                ?>
                    <tr>
                        <td><?php echo $print->id; ?></td>
                        <td><?php echo $print->name; ?></td>
                        <td><a href="<?php echo $print->url; ?>">Download</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}

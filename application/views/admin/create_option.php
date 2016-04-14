<!DOCTYPE html>
<html lang="en">
    
    <script src="<?php echo ASSETS_PATH; ?>dropzone-master/dist/dropzone.js"></script>
    <script type="text/javascript">var item_id = "<?= $option_id ?>";</script>
    <script type="text/javascript">var delete_thumbnail_link = "<?= site_url('admin/delete_thumbnail') ?>";</script>
    <script type="text/javascript">var delete_image_link = "<?= site_url('admin/delete_image') ?>";</script>
    <script src="<?php echo ASSETS_PATH; ?>js/my_file_upload.js"></script>
    <link href="<?php echo ASSETS_PATH; ?>dropzone-master/dist/dropzone.css" rel="stylesheet"> 
    
    <script type="text/javascript">
    
        $(function(){
            $('.demo2').colorpicker();
        });


        function MenuChanged(){

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {

                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                        $("#submenu").empty();

                        var json_array =  JSON.parse(xmlhttp.responseText);

                        for (var key in json_array) {

                            $('#submenu')
                            .append($("<option></option>")
                            .attr("value",json_array[key]['id'])
                            .text(json_array[key]['name'])); 

                        }

                        $("#submenu").val('<?php if(isset($option)) echo $option->submenu_id; else echo 0; ?>');

                }
            };

            var site_url = "<?php echo site_url('admin/get_submenus') ?>";

            site_url = site_url.concat("/").concat($( "#product" ).val()).concat("/").concat($( "#menu" ).val());

            xmlhttp.open("GET", site_url, true);

            xmlhttp.send();
        } 

        $(document).ready(function() {


            $("#product option[value='<?php if(isset($option)) echo $option->product_id; else echo 0; ?>']").prop('selected', true);
            $("#menu option[value='<?php if(isset($option)) echo $option->menu_id; else echo 0; ?>']").prop('selected', true);

            MenuChanged();

            $("#type option[value='<?php if(isset($option)) echo $option->type; else echo 0; ?>']").prop('selected', true);
            $("#applied_to option[value='<?php if(isset($option)) echo $option->applied_to; else echo 0; ?>']").prop('selected', true);

            $('.demo2').colorpicker('setValue', '<?php if(isset($option)) echo $option->color; else echo '#000000'; ?>');
            
            var is_edit = <?php if (isset($option_images)&& !empty($option_images)) echo json_encode(true); else echo json_encode(false); ?>;
            
            var multi_uploader = new My_Uploader({
            
                item_id: "<?= $option_id ?>",
                delete_link: "<?= site_url('admin/delete_image') ?>",
                table_name: "shmyde_images",
                tmp_table_name : "shmyde_temp_images",
                image_dir : "design/",
                tmp_image_dir : "design/tmp/",
                root : $( "#images" ),
                mode : "multiple", 
                image_name : "option_image",
                file_name : "file",
                form : $( "#multiple_image_upload_form" ),
            });
    
            var single_uploader = new My_Uploader({
            
                item_id: "<?= $option_id ?>",
                delete_link: "<?= site_url('admin/delete_image') ?>",
                table_name: "shmyde_option_thumbnail",
                tmp_table_name : "shmyde_secondary_temp_images",
                image_dir : "design/thumbnail/",
                tmp_image_dir : "design/thumbnail/tmp/",
                root : $( "#image" ),
                form : $( "#single_image_upload_form" ),
                mode : "single",
                image_name : "option_thumbnail",
                file_name : "file"
            });
                        
            if(is_edit === true){
                
                
                var images_json = '<?php  if (isset($option_images) && !empty($option_images)) {echo $option_images;}  ?>';
                
                
                if(images_json !== ''){
                
                
                    var option_images =  JSON.parse('<?php  if (isset($option_images) && !empty($option_images)) {echo $option_images;}  ?>');

                    for (var key in option_images) {

                        var id = "#".concat(multi_uploader.image_name).concat("_").concat(option_images[key]['id']);

                        multi_uploader.add_upload_button(option_images[key]['id']);

                        var base_path = "<?php echo ASSETS_PATH;  ?>".concat("images/design/");

                        var image_path = base_path.concat(option_images[key]['name']);

                        $(id).attr("src", image_path);

                    }
                }
                
                var thumbnail_json = '<?php  if (isset($option_thumbnails) && !empty($option_thumbnails)) {echo $option_thumbnails;}   ?>';
                                
                if(thumbnail_json !== ''){
                
                    var thumbnail_images =  JSON.parse('<?php  if (isset($option_thumbnails) && !empty($option_thumbnails)) {echo $option_thumbnails;}   ?>');

                    for (var key in thumbnail_images) {
                            
                           
                        var id = "#".concat(single_uploader.image_name).concat("_").concat(thumbnail_images[key]['id']);
                                                                        
                        single_uploader.add_upload_button(thumbnail_images[key]['id']);

                        var base_path = "<?php echo ASSETS_PATH;  ?>".concat("images/design/thumbnail/");

                        var image_path = base_path.concat(thumbnail_images[key]['name']);
                        
                        $(id).attr("src", image_path);

                    }
                }
                
                
            }
                      
            ///Add a new upload button with a preview image space and a delete button
            $( "#add_image" ).click(function() {

                var undefined;
                multi_uploader.add_upload_button(undefined);

            });
            
            ///Add a new upload button with a preview image space and a delete button
            $( "#add_thumbnail" ).click(function() {

                var undefined;
                single_uploader.add_upload_button(undefined);

            });
                       
            multi_uploader.form.submit(function (ev) {
                                                          
                ev.preventDefault();
                
                submit_upload_form(multi_uploader);
                              
            });
            
            single_uploader.form.submit(function (ev) {
                                                          
                ev.preventDefault();
                
                submit_upload_form(single_uploader);
                              
            });
                                  
        });
 
    </script>

    <body>


        <div style="margin-left:5%; margin-top:5%;">
            <span><a href="<?php echo site_url('admin/view/option'); ?>">View All</a> </span>
        </div>

        <div class="container">

            <h2><?php echo $title; ?> OPTION</h2>

            <!-- IMAGE UPLOAD SECTION -->

            <button type="button" id="add_image" class="btn btn-primary" style="margin-top: 25px;">Add Image</button>

            <form action="<?php echo site_url('admin/upload_image/'.$option_id);  ?>" role="form" method="post" enctype="multipart/form-data" style="margin-top: 20px; margin-bottom: 20px;" id="multiple_image_upload_form">
                
                <span id="images" name="front_image">

                </span>
                
                <input type="text" id="param_0" name="params[0]" hidden="true" />
                <input type="text" id="param_1" name="params[1]" hidden="true" />
                <input type="text" id="param_2" name="params[2]" hidden="true" />
                <input type="text" id="param_3" name="params[3]" hidden="true" />
                <input type="text" id="param_4" name="params[4]" hidden="true" />
                
                

                <button type="submit" class="btn btn-success btn-block">Upload Images</button>

            </form>

            <button type="button" id="add_thumbnail" class="btn btn-primary" style="margin-top: 25px;">Add Thumbnail</button>

            <form action="<?php echo site_url('admin/upload_image/'.$option_id);  ?>" role="form" method="post" enctype="multipart/form-data" style="margin-top: 20px; margin-bottom: 20px;" id="single_image_upload_form">
                
                
                <span id="image" name="back_image">

                </span>
                
                <input type="text" id="param_0" name="params[0]" hidden="true" />
                <input type="text" id="param_1" name="params[1]" hidden="true" />
                <input type="text" id="param_2" name="params[2]" hidden="true" />
                <input type="text" id="param_3" name="params[3]" hidden="true" />
                <input type="text" id="param_4" name="params[4]" hidden="true" />
                
                

                <button type="submit" class="btn btn-success btn-block">Upload Thumbnail</button>

            </form>

            <!-- IMAGE UPLOAD SECTION END -->

            <!-- OPTION PARAMETERS SECTION -->

            <form action="<?php if($title == 'CREATE') echo site_url('admin/create/option'); else echo site_url('admin/edit/option/'.$option->id);  ?>" role="form" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="product">Product:</label>
                    <select class="form-control" id="product" name="product" onchange="MenuChanged();">
                        <?php foreach ($products->result() as $row) {?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu">Menu:</label>
                    <select class="form-control" id="menu" name="menu" onchange="MenuChanged();">
                        <?php foreach ($menus->result() as $row) {?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="submenu">Sub Menu:</label>
                    <select class="form-control" id="submenu" name="submenu">
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php  if(isset($option)) echo $option->name; ?>">
                </div>

                <div class="form-group">
                    <label for="type">Option Type:</label>
                    <select class="form-control" id="type" name="type">
                        <option value="0">Style</option>
                        <option value="1">Fabric</option>
                        <option value="2">Checkbox</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="applied_to">Option Type:</label>
                    <select class="form-control" id="applied_to" name="applied_to">
                        <option value="0">Applied to Front</option>
                        <option value="1">Applied to Back</option>
                        <option value="2">Doesn't Matter</option>
                    </select>
                </div>

                <label for="color-input">Color (Overrides Image):</label>
                <div class="input-group demo2" name="color-input" id="color-input" style="padding-bottom: 10px">
                    <input type="text" value="" class="form-control" name="color" id="color" />
                    <span class="input-group-addon"><i></i></span>
                </div>


                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php  if(isset($option)) echo $option->price; else echo '0'; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="description" name="description"><?php  if(isset($option)) echo $option->description; ?></textarea>
                </div>

                <div class="form-group">
                    <label><input type="checkbox" class="form-control" id="is_default" name="is_default" <?php if(isset($option) && $option->is_default) echo 'checked'; ?>>Is Default Value</label>
                </div>

                <button type="submit" class="btn btn-danger btn-block"><?php echo $title; ?></button>
            </form>

        </div>

    </body>

</html>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function get_insert_id(array){
    
    for (var i = 0; i < array.length; i++) {
        
        if(array[i] === -1)
            return i;
        
    }
    
    
}


function My_Uploader(parameters)
{
    
    
    this.image_ids = [-1,-1,-1,-1,-1,-1,-1,-1,-1,-1 ];
            
    this.item_id = parameters.item_id;
    
    this.delete_link =  parameters.delete_link;
    
    this.table_name = parameters.table_name;
    
    this.tmp_table_name = parameters.tmp_table_name;
    
    this.image_dir = parameters.image_dir;
    
    this.tmp_image_dir = parameters.tmp_image_dir;
    
    this.root = parameters.root;
        
    this.mode = parameters.mode;
    
    this.form = parameters.form;
    
    this.image_name = parameters.image_name;
    
    this.file_name = parameters.file_name;
    
    this.get_caller = function(){
      
        return this;
        
    };
    
    this.delete_image = function(image_id){
        
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {

                

            }
        };
        
        var parameters = "item_id=".concat(this.item_id).concat("&image_id=").concat(image_id).concat("&table_name=").concat(this.table_name).concat("&tmp_table_name=").concat(this.tmp_table_name).concat("&image_dir=").concat(this.image_dir).concat("&tmp_image_dir=").concat(this.tmp_image_dir);
        
        var site_url = this.delete_link;

        //site_url = site_url.concat("/").concat(this.item_id).concat("/").concat(image_id).concat("/").concat(this.table_name).concat("/").concat(this.tmp_table_name).concat("/").concat(this.image_dir).concat("/").concat(this.tmp_image_dir);

        xmlhttp.open("POST", site_url, true);
        
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.send(parameters);
    };
    
    this.add_upload_button = function(image_id){
        
                
        if(this.mode === 'single'){
            
            
            if(typeof image_id === 'undefined'){
                
                image_id = 0;
            }
            
            if(this.image_ids[image_id] === -1){
                                   
                var container = this.create_image_upload_element(image_id, this.image_name, this.file_name);

                this.root.append(container);

                this.image_ids[image_id] = image_id;
            
            }

            
        }
        
        if(this.mode === 'multiple'){
            
            
            var insert_id = get_insert_id(this.image_ids);
                                   
            var container;
                        
            if(typeof image_id === 'undefined'){
                
                container = this.create_image_upload_element(insert_id, this.image_name, this.file_name);
            }
            else{
                container = this.create_image_upload_element(image_id, this.image_name, this.file_name);
            }
            
            this.image_ids[insert_id] = insert_id;
                      
            this.root.append(container);
            
        }
        
    };
    
    ///curr_element is the id of the image that is inserted
    this.create_image_upload_element = function(curr_element, image_name, file_name){
        
        var caller = this.get_caller();
        
        var container = document.createElement("DIV");
        container.setAttribute("display", "inline-block");
        container.setAttribute("id", curr_element);
                
        var upload_button_container = document.createElement("DIV");
        upload_button_container.setAttribute("style", "margin-top : 5px; margin-bottom : 5px;");
        var upload_button = document.createElement("INPUT");
        upload_button.setAttribute("type", "file");
        upload_button.setAttribute("name", file_name.concat("_").concat(curr_element));
        upload_button.setAttribute("id", file_name.concat("_").concat(curr_element));
        upload_button.onchange = function() {

           var parent = this.parentElement.parentElement;

           var image_element = parent.childNodes[1].childNodes[0];

           if (this.files && this.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        image_element.setAttribute("src", e.target.result);
                    };


                    reader.readAsDataURL(this.files[0]);
            }

        };
        upload_button_container.appendChild(upload_button);

        var image_container = document.createElement("DIV");
        image_container.setAttribute("style", "margin-top : 5px; margin-bottom : 5px;");
        var image = document.createElement("img");
        image.setAttribute("style", "width : 150px; height : 150px;");
        image.setAttribute("id", image_name.concat("_").concat(curr_element)); 
        image_container.appendChild(image);

        var delete_button_container = document.createElement("DIV");
        delete_button_container.setAttribute("style", "margin-top : 5px; margin-bottom : 5px;");
        var delete_button = document.createElement("BUTTON");
        delete_button.setAttribute("type", "button");
        delete_button.setAttribute("class", "btn btn-danger");
        delete_button.setAttribute("id", "current_index");

        var text = document.createTextNode("Delete");   
        delete_button.appendChild(text);
        delete_button.onclick = function(){

            var parent = this.parentElement.parentElement;
            
            var parent_container = parent.parentElement;
                        
            caller.image_ids[parent.id] = -1;
                                    
            caller.delete_image(parent.id);

            parent_container.removeChild(parent);

        };
        delete_button_container.appendChild(delete_button);

        container.appendChild(upload_button_container);
        container.appendChild(image_container);
        container.appendChild(delete_button_container);

        return container;
    };
    
}

function delete_image(image_id){
    
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {



        }
    };

    var site_url = this.delete_link;

    site_url = site_url.concat("/").concat(this.item_id).concat("/").concat(image_id).concat("/").concat(this.table_name).concat("/").concat(this.tmp_table_name).concat("/").concat(this.image_dir).concat("/").concat(this.tmp_image_dir);

    xmlhttp.open("GET", site_url, true);

    xmlhttp.send();
}

function submit_upload_form(uploader){
    
    var form_id = uploader.form.attr('id');
        
    $("#".concat(form_id).concat(" #param_0")).val(uploader.tmp_image_dir);
    $("#".concat(form_id).concat(" #param_1")).val(uploader.tmp_table_name);
    $("#".concat(form_id).concat(" #param_2")).val(uploader.file_name);
    $("#".concat(form_id).concat(" #param_3")).val(uploader.image_name);

    var mu_formData = new FormData();

    var other_data = uploader.form.serializeArray();

    $.each(other_data,function(key,input){
                
        mu_formData.append(input.name,input.value);
        
    });

     for (var i = 0; i < uploader.image_ids.length; i++) { 

        if(uploader.image_ids[i] === -1)
            continue;

        var id = "#".concat(uploader.file_name).concat("_").concat(uploader.image_ids[i]);

        var filename = (uploader.file_name).concat("_").concat(i);

        if($(id).length > 0 && $(id)[0].files.length > 0){

            mu_formData.append(filename, $(id)[0].files[0]);
        }

    }



    $.ajax({
           url : uploader.form.attr('action'),
           type : 'POST',
           data : mu_formData,
           processData: false,  
           contentType: false,  
           success : function(data) {

               alert(data);

           }
    });

}

    





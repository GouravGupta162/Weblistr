<div class="main-content">
    <div class="main-content-inner">
        <?php include 'breadcrumb_view.php';
        ?>

        <div class="page-content">
            
            <div class="row">
                <div class="col-xs-6">
                    <!-- PAGE CONTENT BEGINS -->

                    <!--custom content start-->
                    <div class="row">
                        <div class="col-xs-12">

                            <form class="form_style"  

                                  id='categoryaddForm' >
                                      <?php
//var_dump($getSelectedcategoryForAdmin);
//                                      foreach ($getSelectedcategoryForAdmin as $categoryValue) {
//                                          $cat_id = $categoryValue['cat_id'];
//                                          $cat_name = $categoryValue['cat_name'];
//                                          $adm_id = $categoryValue['adm_id'];
//                                          $banner = $categoryValue['banner'];
//                                          $icon = $categoryValue['icon'];
//                                          $bgcolor = $categoryValue['bg_color'];
//                                          $cat_desctiption = $categoryValue['cat_desctiption'];
//                                          $catedate = $categoryValue['date'];
//                                          $status = $categoryValue['status'];
                                      ?>
                                <div class="widget-box">


                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div>
                                                <label for="form-field-8">Name</label>

                                                <input type="text" class="form-control" placeholder="Category Name" name="cat_name" required  >
                                            </div>

                                            <hr />

                                            <div>
                                                <label for="form-field-9">Description <span class='small red'>(500 Character Limit)</span></label>
                                                <textarea class="form-control limited" id="cat_desc" name="cat_desc" maxlength="500" required></textarea>
												<label  id="character-count">500 characters remaining</label>
                                            </div>

                                            <hr />

                                            <div>
                                                <label for="form-field-8">Banner Image</label>
                                                <input type='file' name='file' id='file' />
                                                <div id="imagePreview"> </div>


                                            </div>
                                            <hr />


                                            <div>
                                                <label for="form-field-8">Icon Image</label>
                                                <input type='file' name='iconfile' id='iconfile' />
                                                <div id="iconimagePreview"> </div>

                                            </div>
                                            <hr />
                                            <div>
                                                <label for="form-field-8">Background Color</label>
                                                <br/>
                                                <input type='text'class="form-control" name='bgcolor' required placeholder="#ffffff color code"/>
                                            </div>
                                            <hr />


                                            <div>
                                                <div id='status'> </div> 
                                                <button type="submit" class="btn btn-sm btn-success update">
                                                    Submit
                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                </div>






                                <?php
//                                }
                                ?>
                            </form>
                        </div><!-- /.span -->
                    </div><!-- /.row -->
                    <!--custom content end-->



                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript" src="js/jquery.js"></script>

<script>

$(document).ready(function() {
    var text_max = 500;
    $('#character-count').html(text_max + ' characters remaining');

    $('#cat_desc').keyup(function() {
        var text_length = $('#cat_desc').val().length;
        var text_remaining = text_max - text_length;

        $('#character-count').html(text_remaining + ' characters remaining');
    });
});


    $("form#categoryaddForm").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        var baseHref = document.getElementsByTagName('base')[0].href;
        $.ajax({
            url: baseHref + "admin/category/categoryadd",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                if (returndata == "")
                {
                    alert("Category Name Already in Database");
                } else if (returndata == "1")
                {
                    alert("Category Added Succesfully");
                    window.location.href = baseHref + "admin/category/index";
                } else
                {
                    alert("Please try again later");
                }
                //console.log(returndata);
            }
        });
        return false;
    });

    //Class Click Event Jquery
    //$(".update00").click(function () {     });
    //*
    $("#file").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#imagePreview");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    //"width": "100px",
                    "style": "width:100px; border:1px solid grey;"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
//*
//*
    $("#iconfile").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#iconimagePreview");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    //"width": "100px",
                    "style": "width:100px; border:1px solid grey;"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
//*
</script>
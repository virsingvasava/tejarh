
var customurl = SITE_URL;

$(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#faq_create").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
             
            "category_id":{
                required:true,
            },

            "title":{
                required:true,
            },

            "subtitle":{
                required:true,
            },

            "slug":{
                required:true,
            },

            "short_description":{
                required:true,
            },
            
            "status":{
                required:true,
            },
        },
        messages: {
          
            "category_id":{
                
                required:'{{__("messages.faq.create.validation.please_select_category")}}',
            },

            "title":{
                required:'{{__("messages.faq.create.validation.please_enter_title")}}',
            },
            "subtitle":{
                required:'{{__("messages.faq.create.validation.please_enter_sub_title")}}',
            },

            "slug":{
                required:'{{__("messages.faq.create.validation.please_enter_slug")}}',
            },

            "short_description":{
                required:'{{__("messages.faq.create.validation.please_enter_description")}}',
            },

            "status":{
                required:'{{__("messages.faq.create.validation.please_select_status")}}',
            },

        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
        }
    });
    
    $.validator.addMethod("emailCheck", function (value, element, param) {
        var check_result = false;
        result = this.optional( element ) || /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/.test( value );
        return result;
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than 40MB');

    $.validator.addMethod("extension", function (value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    }, "Please enter a value with a valid extension.");

});
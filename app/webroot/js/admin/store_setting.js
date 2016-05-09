$(function () {

$('#update_settings_ac').validate({
rules: {
"data[store_settings][MangopayLegal][LegalEmail]": {
required: true,
        email: true,
},
        'data[store_settings][bank_detail][IBAN]': {
        required: true,
        },
        'data[store_settings][bank_detail][BIC]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][LegalPersonType]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][Name]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][FirstName]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][LastName]': {
        required: true
        },
        'data[store_settings][MangopayLegal][Address]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][Email]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][FirstName]': {
        required: true,
        },
        'data[store_settings][MangopayLegal][FirstName]': {
        required: true,
        },
},
        messages: {
        'data[store_settings][bank_detail][IBAN]': {
        required: 'Please Enter IBAN.',
        },
                'data[store_settings][bank_detail][BIC]': {
                required: 'Please Enter BIC.',
                },
                'data[store_settings][MangopayLegal][LegalPersonType]': {
                required: 'Please Select Person Type.',
                },
                'data[store_settings][MangopayLegal][Name]': {
                required: 'Please Enter Business Name.',
                },
                'data[store_settings][MangopayLegal][FirstName]': {
                required: 'Please Enter Legal Representative First Name.',
                },
                'data[store_settings][MangopayLegal][LastName]': {
                required: 'Please Enter Legal Representative Last Name.',
                },
                'data[store_settings][MangopayLegal][Address]': {
                required: 'Please Enter Legal Representative Address.',
                },
                'data[store_settings][MangopayLegal][Email]': {
                required: 'Please Enter Email.',
                },
        },
        submitHandler : function() {
        $("#loading_img").show();
                var postData = $('#update_settings_ac').serializeArray();
                var formURL = $('#update_settings_ac').attr("action");
                $.ajax({
                url : formURL,
                        data: postData,
                        dataType : 'json',
                        type: 'post',
                        success: function(response){
                        $("#loading_img").hide();
                                if (response.status == "true")
                        {
                        $("#store_detail").css("opacity", "0.5");
                                $("#form_confirmation").modal('show');
                        }
                        if (response.status == "false")
                        {
                        $("#form_msg").text(response.bank_account_status);
                        }
                        console.log(response);
                        }
                });
        }
});
        $.validator.messages.required = "<?php echo __('This field is required');?>";
        $('.take_away_payment_options input[type="checkbox"]').change(function(){
if ($(this).attr("value") == 'Online credit card' && $(this).is(":checked") == true){
$('.bank_detail_div').show();
}
else{
$('.bank_detail_div').hide();
}
});
        $('.delevary_payment_options input[type="checkbox"]').change(function(){
if ($(this).attr("value") == 'Online credit card' && $(this).is(":checked") == true){
$('.bank_detail_div').show();
}
else{
$('.bank_detail_div').hide();
}
});
        $('#takeawayservice').val($('#ostatus').val());
        $('.loyalty_activeSwitch').val($('#loyalty_active').val());
        $('.loyalty_displaySwitch').val($('#loyalty_display').val());
        $('.take_away_activeSwitch').val($('#take_active').val());
        $('.take_away_displaySwitch').val($('#take_display').val());
        $('.catalog_activeSwitch').val($('#catalog_active').val());
        $('.catalog_displaySwitch').val($('#catalog_display').val());
        $('.delivery_activeSwitch').val($('#delivery_active').val());
        $('.delivery_displaySwitch').val($('#delivery_display').val());
        $('.coupon_activeSwitch').val($('#coupon_active').val());
        $('.coupon_displaySwitch').val($('#coupon_display').val());
        $('.push_activeSwitch').val($('#push_active').val());
        $('.push_displaySwitch').val($('#push_display').val());
        // $('.facebook_activeSwitch').val($('#coupon_display').val());
        $('.events_activeSwitch').val($('#events_active').val());
        $('.events_displaySwitch').val($('#events_display').val());
        $('.facebook_activeSwitch').val($('#facebook_active_switch').val());
        if ($('.take_away_activeSwitch').val() == 1) {
$('#take_away').show();
        //$('#app_active').parent().addClass('switch-on').removeClass('switch-off');
} else {
$('#take_away').hide();
}

if ($('.delivery_activeSwitch').val() == 1) {
$('#delivery').show();
} else {
$('#delivery').hide();
}

// loyalty switch
$('.loyaltyactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.loyalty_activeSwitch').val("1");
        $('.loyalty_displaySwitch').val("1");
        $('.loyaltydisplaySwitch').find(".loyalty_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
        $('.validate_er').remove();
} else {
$('.loyalty_activeSwitch').val("0");
        $('.loyalty_displaySwitch').val("0");
        $('.loyaltydisplaySwitch').find(".loyalty_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
        $('#validatedStep').val('0');
        $.ajax({
        url: '<?php echo SITE_URL; ?>StoreSettings/validate_step',
                data: 'store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>',
                type: 'POST',
                success: function(response) {
                $('.takeawayvalidateSwitch .switch-animate').removeClass('switch-on').addClass('switch-off');
                }
        });
}
$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.loyalty_activeSwitch').val() + '&displayValue=' + $('.loyalty_displaySwitch').val() + '&id=' + v.id + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&key=loyalty',
        type: 'POST',
        success: function(response) {
        $('.loyalty_activeSwitch').attr("id", response);
                $('.loyalty_displaySwitch').attr("id", response);
        }
});
});
});
        $('.loyaltydisplaySwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.loyalty_displaySwitch').val("1");
} else {
$('.loyalty_displaySwitch').val("0");
}
$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.loyalty_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=loyalty',
        type: 'POST',
        success: function(response) {
        $('.loyalty_displaySwitch').attr("id", response);
        }
});
});
});
        // ONLINE ORDER
        $('.takeAwayactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('#take_away').show();
        $('.take_away_activeSwitch').val("1");
        //$('.take_away_displaySwitch').val("1");
        //$('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('#take_away').hide();
        $('.take_away_activeSwitch').val("0");
        // $('.take_away_displaySwitch').val("0");
        //$('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.take_away_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=take_away',
        type: 'POST',
        success: function(response) {
        $('.take_away_activeSwitch').attr("id", response);
                // $('.take_away_displaySwitch').attr("id", response);
                $('#take_away_storeID').attr("id", response);
        }
});
});
});
        $('.takeAwaydisplaySwitch').on('switch-change', function(e, data) {
var payment_method_cnt = $('.take_away_payment_options :checkbox:checked').length;
        if (payment_method_cnt > 0) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.take_away_displaySwitch').val("1");
} else {
$('.take_away_displaySwitch').val("0");
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.take_away_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=take_away',
        type: 'POST',
        success: function(response) {
        if (response == "No Product") {
        $('#take_away_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Store should have at least one product to enable display delivery option."); ?></p>');
                $('.take_away_displaySwitch').val("0");
                $('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
        }
        else if (response == 'close') {
        $('#take_away_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Store should open at least one day in the week to enable display delivery option."); ?></p>');
                $('.take_away_displaySwitch').val("0");
                $('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
        }
        else {
        $('.take_away_displaySwitch').attr("id", response);
                $('#take_away_storeID').attr("id", response);
                $('#take_away_displaySwitch_validation').html('');
        }
        }
});
});
} else {
$('.take_away_displaySwitch').val("0");
        $('#take_away_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Please select at least one payment option to enable display delivery option."); ?></p>');
        $('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
});
        $('.take_away_payment_options :checkbox').change(function() {
var payment_method_cnt = $('.take_away_payment_options :checked').length;
        if (payment_method_cnt > 0) {
('.take_away_displaySwitch').val("1");
        if ($('.takeAwaydisplaySwitch :hidden').val() == '1') {
$('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
}
$('#take_away_displaySwitch_validation').html('');
} else {
$('.take_away_displaySwitch').val("0");
        $('.takeAwaydisplaySwitch').find(".take_away_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
});
        $('#take_away_update_settings').validate();
        jQuery.validator.addMethod("take_away_to_date", function(value, element) {
        var fdt = $('.take_away_from_date').val();
                fdt = fdt.split('/');
                var tdt = $('.take_away_to_date').val();
                tdt = tdt.split('/');
                if (fdt[2] > tdt[2]) {
        return false;
        } else if (fdt[1] > tdt[1]) {
        return false;
        } else if ((fdt[1] >= tdt[1]) && (fdt[0] > tdt[0])) {
        return false;
        } else {
        return true;
        }


        }, "To date must be greater than the from date");
        //catalog
        $('.catalogactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.catalog_activeSwitch').val("1");
        $('.catalog_displaySwitch').val("1");
        $('.catalogdisplaySwitch').find(".catalog_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('.catalog_activeSwitch').val("0");
        $('.catalog_displaySwitch').val("0");
        $('.catalogdisplaySwitch').find(".catalog_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.catalog_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&displayValue=' + $('.catalog_displaySwitch').val() + '&id=' + v.id + '&key=catalog',
        type: 'POST',
        success: function(response) {
        $('.catalog_activeSwitch').attr("id", response);
                $('.catalog_displaySwitch').attr("id", response);
        }
});
});
});
        $('.catalogdisplaySwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.catalog_displaySwitch').val("1");
} else {
$('.catalog_displaySwitch').val("0");
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.catalog_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=catalog',
        type: 'POST',
        success: function(response) {
        $('.catalog_displaySwitch').attr("id", response);
        }
});
});
});
        //Delivery
        $('.deliveryactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('#delivery').show();
        $('.delivery_activeSwitch').val("1");
        //$('.delivery_displaySwitch').val("1");
        // $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('#delivery').hide();
        $('.delivery_activeSwitch').val("0");
//                                $('.delivery_displaySwitch').val("0");
//                                $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.delivery_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=delivery',
        type: 'POST',
        success: function(response) {
        $('.delivery_activeSwitch').attr("id", response);
//                                                $('.delivery_displaySwitch').attr("id", response);
                $('#delivery_storeID').attr("id", response);
        }
});
});
});
        //Delivery dispaly
        $('.deliverydisplaySwitch').on('switch-change', function(e, data) {
var payment_method_cnt = $('.delevary_payment_options :checkbox:checked').length;
        if (payment_method_cnt > 0) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.delivery_displaySwitch').val("1");
} else {
$('.delivery_displaySwitch').val("0");
}
$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.delivery_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=delivery',
        type: 'POST',
        success: function(response) {
        if (response == "No Product") {
        $('#delivery_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Store should have at least one product to enable display delivery option."); ?></p>');
                $('.delivery_displaySwitch').val("0");
                $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
        }
        else if (response == 'close') {
        $('#delivery_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Store should open at least one day in the week to enable display delivery option."); ?></p>');
                $('.delivery_displaySwitch').val("0");
                $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
        }
        else {
        $('.delivery_displaySwitch').attr("id", response);
                $('#delivery_storeID').attr("id", response);
                $('#delivery_displaySwitch_validation').html('');
        }
        }
});
});
} else {
$('.delivery_displaySwitch').val("0");
        $('#delivery_displaySwitch_validation').html('<p class="text-danger" style="margin-top: 9px;"><?php echo __("Please select at least one payment option to enable display delivery option."); ?></p>');
        $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
});
        $('.delevary_payment_options :checkbox').change(function() {
var payment_method_cnt = $('.delevary_payment_options :checked').length;
        if (payment_method_cnt > 0) {
$('.delivery_displaySwitch').val("1");
        if ($('.deliverydisplaySwitch :hidden').val() == '1') {
$('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
}
$('#delivery_displaySwitch_validation').html('');
} else {
$('.delivery_displaySwitch').val("0");
        $('.deliverydisplaySwitch').find(".delivery_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
});
        $('#delivery_update_settings').validate();
        jQuery.validator.addMethod("delivery_to_date", function(value, element) {
        var fdt = $('.delivery_from_date').val();
                fdt = fdt.split('/');
                var tdt = $('.delivery_to_date').val();
                tdt = tdt.split('/');
                if (fdt[2] > tdt[2]) {
        return false;
        } else if (fdt[1] > tdt[1]) {
        return false;
        } else if ((fdt[1] >= tdt[1]) && (fdt[0] > tdt[0])) {
        return false;
        } else {
        return true;
        }
        }, "To date must be greater than the from date");
        //Coupons
        $('.couponsactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.coupon_activeSwitch').val("1");
        $('.coupon_displaySwitch').val("1");
        $('.couponsdisplaySwitch').find(".coupon_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('.coupon_activeSwitch').val("0");
        $('.coupon_displaySwitch').val("0");
        $('.couponsdisplaySwitch').find(".coupon_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.coupon_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&displayValue=' + $('.coupon_displaySwitch').val() + '&id=' + v.id + '&key=coupon',
        type: 'POST',
        success: function(response) {
        $('.coupon_activeSwitch').attr("id", response);
                $('.coupon_displaySwitch').attr("id", response);
        }
});
});
});
        $('.couponsdisplaySwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.coupon_displaySwitch').val("1");
} else {
$('.coupon_displaySwitch').val("0");
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.coupon_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=coupon',
        type: 'POST',
        success: function(response) {
        $('.coupon_displaySwitch').attr("id", response);
        }
});
});
});
        $('.coupon_onlinePaymentSwitch').on('change', function(e, data) {
// var el = $(data.el)
// , value = data.value;

// if (value == true) {
// $('.coupon_onlinePaymentSwitch').val("1");
// $('.bank_detail_div').show();
// } else {
// $('.coupon_onlinePaymentSwitch').val("0");
// $('.bank_detail_div').hide();
// }

// $.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'online_payment=' + $(".coupon_onlinePaymentSwitch").val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + $(".coupon_onlinePaymentSwitch").attr("id") + '&key=coupon',
        type: 'POST',
        success: function(response) {
        $('.coupon_onlinepayment_Switch').attr("id", response);
        }
});
        // });
});
        //Push
        $('.pushactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.push_activeSwitch').val("1");
        $('.push_displaySwitch').val("1");
        $('.pushdisplaySwitch').find(".push_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('.push_activeSwitch').val("0");
        $('.push_displaySwitch').val("0");
        $('.pushdisplaySwitch').find(".push_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.push_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&displayValue=' + $('.push_displaySwitch').val() + '&id=' + v.id + '&key=push',
        type: 'POST',
        success: function(response) {
        $('.push_activeSwitch').attr("id", response);
                $('.push_displaySwitch').attr("id", response);
        }
});
});
});
        $('.pushdisplaySwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.push_displaySwitch').val("1");
} else {
$('.push_displaySwitch').val("0");
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.push_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=push',
        type: 'POST',
        success: function(response) {
        $('.push_displaySwitch').attr("id", response);
        }
});
});
});
        //Events
        $('.EventsactiveSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.events_activeSwitch').val("1");
        $('.events_displaySwitch').val("1");
        $('.EventsdisplaySwitch').find(".events_displaySwitch").parent().removeClass('switch-off').addClass('switch-on');
} else {
$('.events_activeSwitch').val("0");
        $('.events_displaySwitch').val("0");
        $('.EventsdisplaySwitch').find(".events_displaySwitch").parent().removeClass('switch-on').addClass('switch-off');
}
$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'activeValue=' + $('.events_activeSwitch').val() + '&displayValue=' + $('.events_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=events',
        type: 'POST',
        success: function(response) {
        $('.events_activeSwitch').attr("id", response);
                $('.events_displaySwitch').attr("id", response);
        }
});
});
});
        $('.EventsdisplaySwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
$('.events_displaySwitch').val("1");
} else {
$('.events_displaySwitch').val("0");
}

$.each(el, function(i, v) {
$.ajax({
url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
        data: 'displayValue=' + $('.events_displaySwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=events',
        type: 'POST',
        success: function(response) {
        $('.events_displaySwitch').attr("id", response);
        }
});
});
});
        $('.EventsFacebookSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
window.location.href = '<?php echo SITE_URL; ?>StoreSettings/link_with_facebook/<?php echo $appId; ?>/<?php echo $storeId; ?>';
        $('.facebook_activeSwitch').val("1");
} else {
$('.facebook_activeSwitch').val("0");
        $.each(el, function(i, v) {
        $.ajax({
        url: '<?php echo SITE_URL; ?>StoreSettings/index/<?php echo $this->params['pass'][0]."/".$this->params['pass'][1];?>',
                data: 'facebookValue=' + $('.facebook_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=facebook_link',
                type: 'POST',
                success: function(response) {
                $('.facebook_activeSwitch').attr("id", response);
                }
        });
        });
}
/*$.each(el, function(i, v) {
 $.ajax({
 url: '<?php echo SITE_URL; ?>StoreSettings/index',
 data: 'facebookValue=' + $('.facebook_activeSwitch').val() + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + v.id + '&key=facebook_link',
 type: 'POST',
 success: function(response) {
 $('.facebook_activeSwitch').attr("id", response);
 }
 });
 });*/
});
        $('.takeawayvalidateSwitch').on('switch-change', function(e, data) {
var el = $(data.el)
        , value = data.value;
        if (value == true) {
if ($('.loyalty_activeSwitch').val() == '1') {
$('#validatedStep').val("1");
        $('.validate_er').remove();
} else {
$('.takeawayvalidateSwitch .switch-animate').removeClass('switch-on').addClass('switch-off');
        $('#validatedStep').val("0");
        $('.validate_er').remove();
        $(this).after('<label class="mlm text-danger validate_er">Please activate loyality settings.</label>');
}

} else {
$('#validatedStep').val("0");
}
});
        $('.takeawayserviceSwitch').on('switch-change', function(e, data) {
$('.before_09').toggle();
});
        $('.deliveryserviceSwitch').on('switch-change', function(e, data) {
$('.del_before_09').toggle();
        /*if (value == true) {
         $('#deliveryservice').val("1");
         $('.delivery_hours_service').show();
         } else {
         $('#deliveryservice').val("0");
         $('.delivery_hours_service').hide();
         }*/
});
        $('.opening').on('change', function() {
var day = $(this).attr('data-day');
        var opn = this.value;
        if (opn == 2) {
$('.' + day + '_colsed_09').hide();
} else if (opn == 1) {
$('.' + day + '_colsed_09').show();
        $('.' + day + '_before_09').hide();
} else if (opn == 0) {
$('.' + day + '_colsed_09').show();
        $('.' + day + '_before_09').show();
}
//$('.' + day + '_before_09').toggle();
})

        /*$('.opening').on('switch-change', function(e, data) {
         var day = $(this).attr('data-day');
         $('.' + day + '_before_09').toggle();
         });*/

        $('.delopening').on('change', function() {
var day = $(this).attr('data-day');
        var opn = this.value;
        if (opn == 2) {
$('.' + day + '_del_closed_09').hide();
} else if (opn == 1) {
$('.' + day + '_del_closed_09').show();
        $('.' + day + '_del_before_09').hide();
} else if (opn == 0) {
$('.' + day + '_del_closed_09').show();
        $('.' + day + '_del_before_09').show();
}
//$('.' + day + '_before_09').toggle();
})

//                $('.delopening').on('switch-change', function(e, data) {
//                        var day = $(this).attr('data-day');
//                        $('.' + day + '_del_before_09').toggle();
//                });

        /*$('.storeCurrency').change(function() {
         var currency = $(this).val();
         var id = $(this).attr('id');
         $.ajax({
         url: '<?php echo SITE_URL; ?>StoreSettings/index',
         data: 'activeValue=1' + '&displayValue=1' + '&currency=' + currency + '&store_id=' + '<?php echo $storeId; ?>' + '&app_id=' + '<?php echo $appId; ?>' + '&id=' + id + '&key=currency',
         type: 'POST',
         success: function(response) {
         $(this).attr('id', response);
         }
         });
         });*/
        jQuery('.settings_timepicker-fromloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_morning_hours(id, parent_id, e.time.value);
});
        jQuery('.settings_timepicker-pickupfromloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_morning_hours(id, parent_id, e.time.value);
});
        jQuery('.settings_timepicker-pickuptoloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_morning_hours(id, parent_id, e.time.value);
});
        jQuery('.settings_timepicker-orderfromloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_evening_hours(id, parent_id, e.time.value);
});
        jQuery('.settings_timepicker-orderpickupfromloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_evening_hours(id, parent_id, e.time.value);
});
        jQuery('.settings_timepicker-orderpickuptoloyalty').timepicker().on('hide.timepicker', function(e) {
var id = this.id;
        var parent_id = $(this).closest('.tab-pane.active').attr('id');
        check_evening_hours(id, parent_id, e.time.value);
});
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate() + 1, 0, 0, 0, 0);
        $('.settings_datetimepicker-fromloyalty,.settings_datetimepicker-toloyalty,.settings_datetimepicker-deliveryfrom,.settings_datetimepicker-deliveryto').datetimepicker({
dateFormat: '<?php echo Configure::read('app_settings.datepicker_date_format'); ?>',
        startDate: today,
        language: '<?php echo $lang ?>',
});
        // jQuery('.btn-popup').on("click",function(){
        //     jQuery("#store_detail").modal("show").addClass("fade");
        // });


});
        function check_morning_hours(id, parent_id, time) {
        //var $obj = jQuery('.settings_timepicker-pickuptoloyalty');
        //var id = $obj.attr('id');
        var pf, pt, diff = 0;
                var day = id.split("_");
                var before = parent_id.split('_');
                var pick_from = $('#' + parent_id + ' #' + day[0] + '_pickupfromDate').val();
                var pic_to = $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').val();
                if (pick_from != '0' && pick_from != undefined) {
        pf = pick_from.split(':');
        }
        if (pic_to != '0' && pic_to != undefined) {
        pt = pic_to.split(':');
        }

        var befor = '.before_09';
                if (before[2] == 'delivery') {
        befor = '.del_before_09';
        }

        if (pt != '0' && pf != '0') {
        diff = parseInt(pt[0] + pt[1]) - parseInt(pf[0] + pf[1]);
        }

        if (diff != 0) {
        if ($('#' + parent_id + ' ' + befor).is(':visible')) {

        var before = $('#' + parent_id + ' #' + day[0] + '_servicefromDate').val().split(':');
                diff1 = parseInt(before[0] + before[1]) - parseInt(pf[0] + pf[1]);
                diff2 = parseInt(before[0] + before[1]) - parseInt(pt[0] + pt[1]);
                //alert(diff1 +' '+diff2);
                /*if (diff1 < 0) {
                 $('#' + parent_id + ' #' + day[0] + '_pickupfromDate').next('label').remove();
                 $('#' + parent_id + ' #' + day[0] + '_pickupfromDate').after('<label class="text-danger">Time must be less then before time</label>');
                 return false;
                 } else {
                 $('#' + parent_id + ' #' + day[0] + '_pickupfromDate').next('label').remove();
                 }*/

                if (diff2 > 0) {

        $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').next('label').remove();
                $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').after('<label class="text-danger">Time must be greater than before time</label>');
                return false;
        } else {
        $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').next('label').remove();
        }

        }
        if (diff < 0) {
        $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').next('label').remove();
                $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').after('<label class="text-danger">Time must be greater than pick from time</label>');
        } else {
        $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').next('label').remove();
        }
        }
        }

function check_evening_hours(id, parent_id, time) {

//var $obj = jQuery('.settings_timepicker-orderpickuptoloyalty');
//var id = $obj.attr('id');

var day = id.split("_");
        var before = parent_id.split('_');
        var ipickup_date = $('#' + parent_id + ' #' + day[0] + '_pickupfromDate').val();
        var ipic_to = $('#' + parent_id + ' #' + day[0] + '_pickuptoDate').val();
        var pick_from = $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').val();
        var pic_to = $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').val();
        var pf, pt, ipf, ipt, idiff, idiff1 = 0;
        if (ipickup_date != '0' && ipickup_date != undefined) {
ipf = ipickup_date.split(':');
}
if (ipic_to != '0' && ipic_to != undefined) {
ipt = ipic_to.split(':');
}

if (pick_from != '0' && pick_from != undefined) {
pf = pick_from.split(':');
}
if (pic_to != '0' && pic_to != undefined) {
pt = pic_to.split(':');
}

if (ipt != '0' && ipf != '0') {

idiff = parseInt(pf[0] + pf[1]) - parseInt(ipt[0] + ipt[1]);
        if (idiff < 0) {
$('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
        $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').after('<label class="text-danger">Time must be greater than first time period</label>');
        return false;
} else {
$('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
}
/*idiff1 = parseInt(pt[0] + pt[1]) - parseInt(ipt[0] + ipt[1]);
 idiff = parseInt(pf[0] + pf[1]) - parseInt(ipf[0] + ipf[1]);
 if (idiff < 0) {
 $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
 $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').after('<label class="text-danger">Time must be greater than inferior pick from time</label>');
 return false;
 } else {
 $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
 }
 
 if (idiff1 < 0) {
 $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
 $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').after('<label class="text-danger">Time must be greater than inferior pick to time</label>');
 return false;
 } else {
 $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
 }*/
}


var befor = '.before_09';
        if (before[2] == 'delivery') {
befor = '.del_before_09';
}

var diff = 0;
        if (pt != '0' && pf != '0') {
diff = parseInt(pt[0] + pt[1]) - parseInt(pf[0] + pf[1]);
}

if (diff != 0) {
if ($('#' + parent_id + ' ' + befor).is(':visible')) {
var before = $('#' + parent_id + ' #' + day[0] + '_serviceorderfromDate').val().split(':');
        diff1 = parseInt(before[0] + before[1]) - parseInt(pf[0] + pf[1]);
        diff2 = parseInt(before[0] + before[1]) - parseInt(pt[0] + pt[1]);
        /*if (diff1 < 0) {
         $('#' + parent_id + ' #' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
         $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').after('<label class="text-danger">Time must be less then before time</label>');
         return false;
         } else {
         $('#' + parent_id + ' #' + day[0] + '_orderpickupfromDate').next('label').remove();
         }*/

        if (diff2 > 0) {
$('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
        $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').after('<label class="text-danger">Time must be greater than before time</label>');
        return false;
} else {
$('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
}

}
if (diff < 0) {
$('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
        $('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').after('<label class="text-danger">Time must be greater than pick from time</label>');
} else {
$('#' + parent_id + ' #' + day[0] + '_orderpickuptoDate').next('label').remove();
}
}
}

function addSeparatorsNF(nStr, inD, outD, sep) {
nStr += '';
        var dpos = nStr.indexOf(inD);
        var nStrEnd = '';
        alert(dpos);
        if (dpos != - 1) {
nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
        nStr = nStr.substring(0, dpos);
}
var rgx = /(\d+)(\d{3})/;
        while (rgx.test(nStr)) {
nStr = nStr.replace(rgx, '$1' + sep + '$2');
}
return nStr + nStrEnd;
        }

function set_price_value(id)
        {
        var price = $("#" + id).val();
                if (price != "") {
        var value = parseFloat($('#' + id).val());
                var final_val = addSeparatorsNF(value, '.', '.', '.');
                $("#" + id).val(final_val);
        }
        }
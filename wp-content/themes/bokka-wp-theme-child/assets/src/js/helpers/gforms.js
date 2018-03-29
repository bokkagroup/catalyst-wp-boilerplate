var productTypeData = $('.product-type-data .product-type');
var requestInfoForm = $('#request_info_form, #campaign_vip_form, #formModal, #modal_gallery_form');
var neighborhoodSelectInput = $('.neighborhood-select');
var hiddenProductDataInput = requestInfoForm.find('.neighborhood-product-data');
var hiddenProductDataInputSingle = requestInfoForm.find('.product-type-data');
var hiddenNeighborhoodNameInput = requestInfoForm.find('.neighborhood-name-data');

var gformHelpers = module.exports = {
    setProductTypes: function() {
        // Populate product type input based on user selection
        if (productTypeData.length > 0 && requestInfoForm.length > 0) {
            var productDataInput = hiddenProductDataInput.find('input[type=text]');

            if (productTypeData.length === 1) {
                productDataInput.val($(productTypeData[0]).text());
            } else {
                var productSelect  = '<li class="gfield checkbox-group product-types">';
                    productSelect += '<label class="gfield_label">Type of home you\'re interested in:</label>';
                    productSelect += '<div class="ginput_container ginput_container_checkbox"><ul class="gfield_checkbox">';
                    productTypeData.each(function(index) {
                        var type = $(productTypeData[index]).text();
                        var typeId = type.toLowerCase().replace(/ /g,"_");
                        productSelect += '<li>';
                        productSelect += '<input name="input_' + typeId + '" type="checkbox" value="' + type + '" id="choice_' + typeId + '">';
                        productSelect += '<label for="choice_' + typeId + '" id="id_' + typeId + '">' + type + '</label>';
                        productSelect += '</li>';
                    });
                    productSelect += '</ul></div>';
                    productSelect += '</li>';

                $(productSelect).insertBefore(hiddenProductDataInput);

                $('.gform_wrapper form input[type="submit"]').on('click', function(e) {
                    e.preventDefault();

                    var selectedProducts = $('.product-types').find('input[type=checkbox]:checked');
                    var productValues = '';

                    if (selectedProducts.length > 0) {
                        selectedProducts.each(function(index) {
                            productValues += (index === 0) ? $(this).val() : ', ' + $(this).val();
                        });
                    }
                    productDataInput.val(productValues);

                    // Manually submit the form
                    $('.gform_wrapper form').submit();
                });
            }
        }
    },
    setSingleProductType: function() {
        // Populate product type single line text hidden field
        if (requestInfoForm.length > 0) {
            if (requestInfoForm.data('product-type')) {
                var productType = requestInfoForm.data('product-type');
                var productDataInput = hiddenProductDataInputSingle.find('input[type=text]');

                productDataInput.val(productType);
            }
        }
    },
    setNeighborhoodName: function() {
        // Populate neighborhood name single line text hidden field
        if (requestInfoForm.length > 0) {
            if (requestInfoForm.data('community-name')) {
                var communityName = requestInfoForm.data('community-name');
                var neighborhoodNameInput = hiddenNeighborhoodNameInput.find('input[type=text]');

                neighborhoodNameInput.val(communityName);
            }
        }
    },
    setNeighborhoodNameSelect: function(neighborhoodName) {
        // Format neighborhood names as needed to match select option
        if (neighborhoodName == 'Delo') {
            neighborhoodName = 'DELO';
        }

        // Populate neighborhood select input
        if (neighborhoodName && neighborhoodSelectInput.length > 0) {
            neighborhoodSelectInput.find('select option[value="' + neighborhoodName + '"]').prop('selected', true);
        }
    }
}

gformHelpers.setProductTypes();
gformHelpers.setNeighborhoodName();
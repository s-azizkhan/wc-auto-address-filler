(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    // Function to check if user has given consent
    function hasUserGivenConsent() {
        return localStorage.getItem('adffw_location_consent') === 'true';
    }

    // Function to set user consent in local storage
    function setUserConsent() {
        localStorage.setItem('adffw_location_consent', 'true');
    }
    // Function to ask for user consent before auto filling
    function askForConsentAndAutofill() {
        if (hasUserGivenConsent() || confirm('Do you want to autofill the details based on your location?')) {
            // If user confirms or has given consent, proceed with autofill and update state list
            autofillUserLocation();
            setUserConsent(); // Set user consent in local storage
        }
        // If user denies consent, do not proceed with autofill
    }

    // Function to trigger the WooCommerce AJAX call & autofill
    async function autofillUserLocation() {
        try {
            const data = await getUserLocation();
            if (!data) {
                return;
            }

            // List of input elements
            const city = $('#billing_city');
            const countryCode = $('#billing_country');
            const regionCode = $('#billing_state');
            const postcode = $('#billing_postcode');
            const billingAddress1 = $('#billing_address_1');
            const streetAddress = `${data.address.leisure || ''}, ${data.address.road || ''}, ${data.address.suburb || ''}`;

            // Update only if the fields are empty
            if (!countryCode.val()) countryCode.val(data.countryCode).trigger('change');
            if (!regionCode.val()) regionCode.val(data.regionCode).trigger('change');
            if (!city.val()) city.val(data.city).trigger('change');
            if (!postcode.val()) postcode.val(data.address.postcode).trigger('change');
            if (!billingAddress1.val()) billingAddress1.val(streetAddress.trim()).trigger('change');

            // Fire the 'updated_checkout' WooCommerce trigger call
            $(document.body).trigger('updated_checkout');
            return;
        } catch (e) {
            console.error("Error while autofilling address", e);
            return;
        }
    }


    // Function to fetch user location data from the server-side AJAX endpoint
    async function getUserLocation() {
        const res = await $.ajax({
            url: ajax_object.ajax_url, // Use the global AJAX URL provided by WordPress
            type: 'post',
            dataType: 'json',
            data: {
                action: ajax_object.action
            },
            success: function (response) {
                return response;
            },
            error: function (error) {
                // Handle error if the server-side request fails
                console.error("adffw_Error while fetching user's location", error);
                return false
            }
        });
        return res.data;
    }

    // Call the function after the page is fully loaded
    $(window).on('load', function () {
        if ($('body').hasClass('woocommerce-checkout')) {
            askForConsentAndAutofill();
        }
    });

})(jQuery);

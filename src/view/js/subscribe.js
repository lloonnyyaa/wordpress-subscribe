jQuery(document).ready(function ($) {
    var VDSubscribe = function (config) {
        var that = this;
        this.config = config;
        this.modal = $("#subscribe-modal");
        this.form = that.modal.find('form');

        this.init = function () {
            if (that.config.hasOwnProperty('selector')) {
                that.modalAction();
                that.formSubmit();
            }
        };

        this.modalAction = function () {
            var open_buttons = document.querySelectorAll(that.config.selector);
            var close_btn = that.modal.find(".close-modal")[0];

            $.each(open_buttons, function (k, button) {
                button.onclick = function () {
                    that.modal.show();
                };
            });

            close_btn.onclick = function () {
                that.modal.hide();
            };

            window.onclick = function (event) {
                if (event.target == that.modal[0]) {
                    that.modal.hide();
                }
            };
        };

        this.formSubmit = function () {
            that.form.on('submit', function (e) {
                e.preventDefault();
                $.post(that.config.ajaxurl, that.form.serialize(), function (data) {
                    that.form[0].reset();
                    that.modal.find('#response').html(data.data);
                });
            });
        };

        return this;
    };

    var vds = new VDSubscribe(vd_subscribe_data);
    vds.init();
});
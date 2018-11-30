jQuery(function () {
    $('body').delegate('[data-action="remove_thumb"]', 'click', function () {
        console.log('adssad');
        $(this).parents('.thumb-container').remove();
        $('input[name="' + this.dataset.field + '"]').val('');
    });
    if ($('.wysihtml5-default').length)
        $('.wysihtml5-default').wysihtml5({
            parserRules: wysihtml5ParserRules,
            stylesheets: ["http://minisite.local/assets/css/components.css"]
        });
    if ($('.select').length)
        $('.select').select({minimumResultsForSearch: Infinity});
    if ($('.file-input-overwrite').length) {
        //
        // Define variables
        //

        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
                '  <div class="modal-content">\n' +
                '    <div class="modal-header">\n' +
                '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
                '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
                '    </div>\n' +
                '    <div class="modal-body">\n' +
                '      <div class="floating-buttons btn-group"></div>\n' +
                '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
                '    </div>\n' +
                '  </div>\n' +
                '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: 'btn btn-link btn-xs btn-icon',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'btn btn-link btn-xs btn-icon',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: 'btn btn-link btn-icon btn-xs',
            removeIcon: '<i class="icon-trash"></i>',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };
        $(".file-input-overwrite").each(function () {
            var field = this.dataset.field;
            var images_str = $('input[name="' + field + '"]').data('value');
            var url = [];
            var file_size = [];
            var file_name = [];
            var images = [];
            var image_info = [];
            if (images_str) {
                url = images_str.split('|');
                file_size = this.dataset.size.split('|');
                file_name = this.dataset.name.split('|');
            }
            if (url && url.length) {
                for (i = 0; i < url.length; i++) {
                    images.push('/' + url[i]);
                    image_info.push({caption: file_name[i], size: file_size[i], key: (i + 1)});
                }
            }
            $(this).fileinput({
                browseLabel: 'Browse',
                browseIcon: '<i class="icon-file-plus"></i>',
                uploadIcon: '<i class="icon-file-upload2"></i>',
                removeIcon: '<i class="icon-cross3"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                showUpload: false,
                initialPreview: images,
                initialPreviewConfig: image_info,
                initialPreviewAsData: true,
                overwriteInitial: true,
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings
            });
        });
        $('.file-input-overwrite').on('change', function (event) {
            var field = this.dataset.field;
            $('input[name="' + field + '_old"]').val('');
        });
        $('.fileinput-remove').on('click', function (event) {
            $('input[name="icon_url_old"]').val('');
        });

        // Checkboxes/radios (Uniform)
        // ------------------------------

        // Default initialization
        $(".styled, .multiselect-container input").uniform({
            radioClass: 'choice'
        });

        // File input
        $(".file-styled").uniform({
            wrapperClass: 'bg-blue',
            fileButtonHtml: '<i class="icon-file-plus"></i>'
        });

        

    }
});
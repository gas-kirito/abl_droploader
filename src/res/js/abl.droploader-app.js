(function($) {

	var default_options = {
		widget_id: 'abl-droploader',
		select_files_class: 'select-files',
		image_categories_select: '',
		filedrop: {
			paramname: 'thefile',
			maxfiles: image_max_files,
			maxfilesize: image_max_upload_size,
			url: 'index.php',
			fallback_id: 'image-upload',
			headers: {
				'charset': 'utf-8'
			}
		},
		l10n: {
			'close': '&#x00d7;',
			'close_title': 'Close DropLoader',
			'error_method': 'Method {{method}} does not exist in abl.droploader-app.js.'
		}
	};
	var opts,
		droploader_hidden = true,
		droploader = null;

	$.fn.ablDropLoaderApp = function(method) {

		var methods = {
			init : function(options) {
				if (!methods.isSupported()) return false;
				opts = $.extend({}, default_options, options);
				if ($('#page-article').length > 0) {
					article_image_field = new Array();
					for (var i = 0; i < article_image_field_ids.length; ++i) {
						article_image_field[i] = $(article_image_field_ids[i]);
					}
				}
				if ($('#hidden_cat').length == 0) {
					$('.upload-form')
						.append('<input type="hidden" id="abl_droploader" name="abl_droploader" value="1" />\n')
						.append('<input type="hidden" id="hidden_cat" name="category" value="" />');
				}
				if (opts.image_categories_select == '') {
					$.ajax({
						url: '?event=abl_droploader&step=get_form_data&items=image_cat_select,l10n',
						dataType: 'json',
						async: false,
						success: function(data) {
							if (data.status == '1') {
								opts.image_categories_select = data.image_cat_select;
								opts.l10n = data.l10n;
							}
						}
					});
				}
				$('body').delegate('#abl-droploader-close', 'click.droploader', function(e) {
					methods.close();
					return false;
				});
				$('body').delegate('#abl-droploader-image-cat-sel *', 'click.droplader', function(e) {
					return false;
				});
				$('body').delegate('#abl-droploader-image-cat-sel select', 'change.droplader', function(e) {
					$('#hidden_cat').val($(this).val());
					return false;
				});
				droploader = $('.upload-form').droploader(opts);
				$('#abl-droploader').hide();

	       		return this.each(function() {});
			},
			isSupported: function() {
				return ('draggable' in document.createElement('span')) && (typeof FileReader != 'undefined');
			},
			open: function() {
        		return this.each(function() {
					if ($('.upload-form').length > 0) {
						droploader.droploader('reset');
						$('#abl-droploader').slideDown(function() {
							$('#abl-droploader .select-files').addClass('abl-fixed-pos');
							droploader_hidden = false;
							$('html').bind('keyup.droploader', function(e) {
								if (e.which == 27) {
									methods.close();
									return false;
								}
							});
						});
					}
				});
			},
			close: function() {
				$('#abl-droploader .select-files').removeClass('abl-fixed-pos');
				$('#abl-droploader').slideUp(function() {
					droploader_hidden = true;
					$('html').unbind('.droploader');
					droploader = null;
					if ($('#page-image').length > 0 && reload_image_tab != 0) {
						location.reload();
					}
				});
				return false;
			},
			destroy : function() {
				return methods.close();
			}
		};

		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || ! method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error(getText(opts.l10n.error_method, { 'method': method }));
		}

		/* show error or completion message */
		function getText(text, values, nl2br){
			if (values !== undefined && values != '') {
				for (var entry in values) {
					var regexp = new RegExp('{{' + entry + '}}', 'gi');
					text = text.replace(regexp, values[entry]);
				}
			}
			if (nl2br === true) {
				text = text.replace(/\\n/g, '<br />');
			} else {
				text = text.replace(/\\n/g, String.fromCharCode(10));
			}
			return text;
		}

	};

})(jQuery);


$(function(){

	var droploader_options = {
		afterAll: function(files) {
			if (files.length > 0 && article_image_field != null) {
				for (var i = 0; i < article_image_field.length; ++i) {
					var v = $(article_image_field[i]).val();
					if (v == '') {
						v = files.join(',');
					} else {
						v += ',' + files.join(',');
					}
					$(article_image_field[i]).val(v);
					$(article_image_field[i]).change();
				}
			}
		},
		l10n: {}
	};

	if ($.fn.ablDropLoaderApp('isSupported')) {

		var doc_language = $('html').attr('lang'),
			image_upload_link = '',
			image_upload_form = '';

		if (image_upload_form == '') {
			$.getJSON(
				'?event=abl_droploader&step=get_form_data&items=all',
				function(data) {
					if (data.status == '1') {
						image_upload_link = data.image_upload_link;
						image_upload_form = data.image_upload_form;
						droploader_options.image_categories_select = data.image_cat_select;
						droploader_options.l10n = data.l10n;
						ablDropLoaderSetup();
					}
				}
			);
		} else {
			ablDropLoaderSetup();
		}

		function ablDropLoaderSetup() {
			if ($('#page-article').length > 0 && $('.upload-form').length == 0) {
				$('body').append(image_upload_form);
			}
			$('.upload-form').hide();
			if ($('#page-image').length > 0) {
				$('body').append($('.upload-form')); // move form
			//	$('#image_control').prepend(image_upload_link); // insert link
                                $('.txp-control-panel').prepend(image_upload_link); // insert link
			}
			$('body').delegate('.abl-droploader-open', 'click.droploader', function(e) {
				$('.upload-form')
					.ablDropLoaderApp('init', droploader_options)
					.ablDropLoaderApp('open');
				return false;
			});
		}

	}

});

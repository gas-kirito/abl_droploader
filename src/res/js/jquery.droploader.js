(function($) {

	var defaults = {
		filedrop: {
			paramname: 'pic',
			maxfiles: 10,
			maxfilesize: 2,
			url: 'droploader.php',
			fallback_id: 'fileInput',
			data: {},
			headers: {}
		},
		image_categories_select: '',
		drop: empty,
		beforeEach: function() { return true; },
		afterAll: empty,
		error: empty,
		uploadStarted: empty,
		uploadFinished: empty,
		progressUpdated: empty,
		l10n: {
			info_text: 'Drop files here<br /><br />\nor click to select files',
			err_invalid_filetype: 'Cannot upload {{filename}}. Only images are allowed (jpg, jpeg, gif, png)!',
			err_browser_not_supported: 'Your browser does not support HTML5 file uploads!',
			err_too_many_files: 'Too many files! Please select {{maxfiles}} at most!',
			err_file_too_large: '{{filename}}<br />too large!',
			all_files_uploaded: '{{uploaded_files}} of {{filecount}} files uploaded.',
			no_files_uploaded: 'There are {{errors}} errors. No files where uploaded.',
			some_files_uploaded: 'There are {{errors}} errors. {{uploaded_files}} of {{filecount}} files uploaded.'
		}
	};

	var selectors = {
		widget: this,
		widget_id: 'droploader',
		form: null,
		dropbox: null,
		select_files: null,
		select_files_class: 'select-files',
		info: null,
		info_class: 'upload-info',
		preview_images: null,
		preview_images_class: 'img-preview',
		progressbar: null,
		progressbar_class: 'files-progress',
		messagebox: null,
		messagebox_class: 'message-box'
	};

	var stats = {
		filecount: 0,
		uploaded: 0,
		errors: 0
	};
	var self,
		opts,
		uploaded_files = [],
		msgs = [];

	var select_template = '<div class="select-files">\n' +
								'<p></p>\n' +
								'<span id="abl-droploader-close"></span>\n' +
							'</div>\n';

	var preview_template = '<div class="preview">\n' +
								'<div class="image-box">\n' +
									'<img />\n' +
								'</div>\n' +
								'<div class="image-progress">\n' +
									'<div class="progress"></div>\n' +
								'</div>\n' +
							'</div>\n';


	$.fn.droploader = function(options) {

		if (this.get(0).nodeName == 'FORM') {
			/* invoked on form: wrap upload-form */
			if (options.widget_id !== undefined) {
				if ($('#' + options.widget_id).length == 0) {
					this.wrapAll('<div id="' + options.widget_id + '" />');
				}
				self = $('#' + options.widget_id);
			} else {
				if ($('#' + selectors.widget_id).length == 0) {
					this.wrapAll('<div id="' + selectors.widget_id + '" />');
				}
				self = $('#' + selectors.widget_id);
			}
		} else {
			/* invoked on upload-form-container */
			self = this;
		}
		selectors.form = $('form', self);
		selectors.form.hide();

		if (options === 'reset') {
			reset();
			return self;
		}

		selectors.widget = $('#' + options.widget_id);

		/* setup widget and filedrop plugin */
		opts = $.extend({}, defaults, selectors, options);
		opts.dropbox = $('html');
		if (!$('#' + opts.filedrop.fallback_id).prop('multiple')) {
			$('#' + opts.filedrop.fallback_id).attr('multiple', 'multiple');
		}

		if ($('.' + opts.select_files_class).length == 0) {
			opts.form.after(select_template);
			$('.' + opts.select_files_class + ' p', self).html(getText(opts.l10n.info_text, '', true));
			$('.' + opts.select_files_class + ' span', self)
				.html(getText(opts.l10n.close))
				.attr('title', getText(opts.l10n.close_title));
			$('.' + opts.select_files_class, self).append(opts.image_categories_select);
		}
		opts.select_files = $('.' + opts.select_files_class, self);

		/* show file selection dialog */
		$('body').delegate('.' + opts.select_files_class, 'click.droploader', function(e) {
			$('#' + opts.filedrop.fallback_id).click();
			e.stopImmediatePropagation();
			return false;
		});

		/*  filedrop plugin */
		opts.dropbox.filedrop({

			paramname: opts.filedrop.paramname,		// The name of the $_FILES entry
			maxfiles: opts.filedrop.maxfiles,
			maxfilesize: opts.filedrop.maxfilesize,
			url: opts.filedrop.url,
			fallback_id: opts.filedrop.fallback_id,
			headers: opts.filedrop.headers,

			drop: function(e) {
				reset();
				var files;
				if (e.target.files !== undefined) {
					files = e.target.files;
					stats.filecount = files.length;
				} else if (e.dataTransfer !== undefined && e.dataTransfer.files !== undefined) {
					files = e.dataTransfer.files;
					stats.filecount = files.length;
				} else {
					files = e.target.value;
					stats.filecount = 1;
				}
				opts.widget.append('<div class="' + opts.info_class + '">\n' +
								'<div class="' + opts.progressbar_class + '">\n<div class="progress"></div>\n</div>\n' +
								'<div class="' + opts.messagebox_class + '"></div>\n' +
								'<div class="' + opts.preview_images_class + '"></div>\n' +
								'</div>\n');
				opts.info = $('.' + opts.info_class, self);
				opts.preview_images = $('.' + opts.preview_images_class, self);
				opts.progressbar = $('.' + opts.progressbar_class, self);
				opts.messagebox = $('.' + opts.messagebox_class, self);
				// send form-data too
				this.data = $(opts.form).serializeArray();
				opts.progressbar.find('.progress').width('0%');
				showMessage('');
				opts.drop(e);
				return false;
			},

			uploadStarted: function(i, file, len) {
				showImage(file);
				opts.uploadStarted(i, file, len);
			},

			beforeEach: function(file) {
				return opts.beforeEach(file);
			},

			progressUpdated: function(i, file, progress) {
				$.data(file).find('.progress').width(progress + '%');
				opts.progressUpdated(i, file, progress);
			},

			uploadFinished: function(i, file, response, timediff) {
				stats.uploaded++;
				$.data(file).find('.progress').width('100%');
				$.data(file).addClass('done');
				var percentage = Math.round(((stats.uploaded + stats.errors) * 100) / stats.filecount);
				opts.progressbar.find('.progress').width(percentage + '%');
				uploaded_files.push(response.image_id);
				opts.uploadFinished(i, file, response, timediff);
			},

			error: function(err, file) {
				if ($('.abl-fixed-pos').length == 0) return false;
				stats.errors++;
				var percentage = Math.round(((stats.uploaded + stats.errors) * 100) / stats.filecount);
				switch(err) {
					case 'BrowserNotSupported':
						msgs.push(getText(opts.l10n.err_browser_not_supported));
						return this.afterAll();
						break;
					case 'TooManyFiles':
						msgs.push(getText(opts.l10n.err_too_many_files, { maxfiles: opts.filedrop.maxfiles }));
						return this.afterAll();
						break;
					case 'FileTooLarge':
						msgs.push(getText(opts.l10n.err_file_too_large, { filename: file.name }));
						opts.progressbar.find('.progress').width(percentage + '%');
						break;
					default:
						opts.progressbar.find('.progress').width(percentage + '%');
						break;
				}
				opts.error(err, file);
				if (stats.errors + stats.uploaded == stats.filecount) {
					return this.afterAll();
				}
			},

			afterAll: function() {
				setTimeout("$('." + opts.info_class + "').remove();", 1000);
				if (stats.errors == 0) {
					msgs.push(getText(opts.l10n.all_files_uploaded, { errors: stats.errors, uploaded_files: stats.uploaded, filecount: stats.filecount }));
					var m = msgs.join('<br />');
					showMessage(m);
				} else {
					if (stats.uploaded == 0 || stats.errors == stats.filecount) {
						msgs.push('<br />' . getText(opts.l10n.no_files_uploaded, { errors: stats.errors }));
					} else {
						msgs.push('<br />' . getText(opts.l10n.some_files_uploaded, { errors: stats.errors, uploaded_files: stats.uploaded, filecount: stats.filecount }));
					}
					var m = msgs.join(String.fromCharCode(10));
					alert(m);
				}
				return opts.afterAll(uploaded_files);
			}

		});

		function removePreview() {
			$(opts.preview_images).remove();
		}

		/* reset widget and statistics */
		function reset() {
			$('.' + opts.info_class).remove();
			stats.filecount = 0;
			stats.uploaded = 0;
			stats.errors = 0;
			uploaded_files = [];
			msgs = [];
		}

		/* show preview of local file */
		function showImage(file){

			var preview = $(preview_template),
				image = $('img', preview);

			var reader = new FileReader();

			image.width = 100;
			image.height = 100;

			reader.onload = function(e){
				image.attr('src', e.target.result);
			};

			reader.readAsDataURL(file);
			preview.appendTo(opts.preview_images);

			$.data(file, preview);
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

		/* show error or completion message */
		function showMessage(message, values){
			if (values !== undefined) message = getText(message, values, true);
			opts.messagebox.html(message);
		}

		/* allow chaining */
		return self.each(function(){ reset(); });
	}

	function empty() {}

})(jQuery);

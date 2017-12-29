<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'abl_droploader';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.20.1-gas';
$plugin['author'] = 'Andreas Blaser / Leonardo Gaudino';
$plugin['author_uri'] = 'https://github.com/gas-kirito/abl_droploader';
$plugin['description'] = 'Drag & drop file upload utility';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '9';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '3';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '3';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

$plugin['textpack'] = <<<EOT
#@abl
abl_droploader_all_files_uploaded => {{filecount}} files uploaded.
abl_droploader_close => &#x00d7;
abl_droploader_close_title => Close DropLoader
abl_droploader_err_browser_not_supported => Your browser does not support HTML5 file uploads!
abl_droploader_err_file_too_large => {{filename}} is too large!
abl_droploader_err_invalid_filetype => Cannot upload {{filename}}. Only images are allowed (jpg, jpeg, gif, png)!
abl_droploader_err_too_many_files => Too many files!<br />Please select {{maxfiles}} at most!
abl_droploader_error_method => Method {{method}} does not exist in abl.droploader-app.js.
abl_droploader_info_text => Drop files here<br /><br />or click to select files
abl_droploader_no_files_uploaded => No files where uploaded.
abl_droploader_open => Upload Images
abl_droploader_open_title => Open drag & drop multiple image uploader
abl_droploader_prefs_article_image_fields => Article-image field(s) (comma separated list of CSS fieldnames, use #custom-n for custom field names)
abl_droploader_prefs_custom_stylesheet => Custom stylesheet (path/filename)
abl_droploader_prefs_file_max_upload_count => Maximum file count of file uploads
abl_droploader_prefs_image_max_upload_count => Maximum file count of image uploads
abl_droploader_prefs_reload_image_tab => Images-Tab: Close Droploader and reload image list after upload
abl_droploader_prefs_use_default_stylesheet => Use default styles
abl_droploader_some_files_uploaded => {{uploaded_files}} of {{filecount}} files uploaded.
#@abl
#@language en-gb
abl_droploader_all_files_uploaded => {{filecount}} files uploaded.
abl_droploader_close => &#x00d7;
abl_droploader_close_title => Close DropLoader
abl_droploader_err_browser_not_supported => Your browser does not support HTML5 file uploads!
abl_droploader_err_file_too_large => {{filename}} is too large!
abl_droploader_err_invalid_filetype => Cannot upload {{filename}}. Only images are allowed (jpg, jpeg, gif, png)!
abl_droploader_err_too_many_files => Too many files!<br />Please select {{maxfiles}} at most!
abl_droploader_error_method => Method {{method}} does not exist in abl.droploader-app.js.
abl_droploader_info_text => Drop files here<br /><br />or click to select files
abl_droploader_no_files_uploaded => No files where uploaded.
abl_droploader_open => Upload Images
abl_droploader_open_title => Open drag & drop multiple image uploader
abl_droploader_prefs_article_image_fields => Article-image field(s) (comma separated list of CSS fieldnames, use #custom-n for custom field names)
abl_droploader_prefs_custom_stylesheet => Custom stylesheet (path/filename)
abl_droploader_prefs_file_max_upload_count => Maximum file count of file uploads
abl_droploader_prefs_image_max_upload_count => Maximum file count of image uploads
abl_droploader_prefs_reload_image_tab => Images-Tab: Close Droploader and reload image list after upload
abl_droploader_prefs_use_default_stylesheet => Use default styles
abl_droploader_some_files_uploaded => {{uploaded_files}} of {{filecount}} files uploaded.
#@abl
#@language de-de
abl_droploader_all_files_uploaded => {{filecount}} Dateien hochgeladen.
abl_droploader_close => &#x00d7;
abl_droploader_close_title => DropLoader schliessen
abl_droploader_err_browser_not_supported => Ihr Browser unterstützt keine HTML5 Datei Uploads!
abl_droploader_err_file_too_large => {{filename}} ist zu gross!
abl_droploader_err_invalid_filetype => {{filename}} nicht hochgeladen. Es sind nur Bilder erlaubt (jpg, jpeg, gif, png)!
abl_droploader_err_too_many_files => Zu viele Dateien ausgewählt!<br /><br />Es können maximal {{maxfiles}} Dateien gleichzeitig hochgeladen werden!
abl_droploader_error_method => Methode {{method}} existiert in abl.droploader-app.js nicht.
abl_droploader_info_text => Bilder hier ablegen<br />oder klicken um auszuwählen
abl_droploader_no_files_uploaded => Es wurden keine Dateien hochgeladen.
abl_droploader_open => Bilder hochladen
abl_droploader_open_title => Drag & Drop Bild Uploader öffnen
abl_droploader_prefs_article_image_fields => Feldnamen für Artikelbilder (Komma-getrennte Liste von Feldnamen, #custom-n für Benutzerdefinierte Felder)
abl_droploader_prefs_custom_stylesheet => Eigenes Stylesheet (Pfad/Dateiname)
abl_droploader_prefs_file_max_upload_count => Maximale Anzahl Dateien beim Datei-Upload
abl_droploader_prefs_image_max_upload_count => Maximale Anzahl Dateien beim Bild-Upload
abl_droploader_prefs_reload_image_tab => Bilder Register: Droploader nach dem upload schliessen und Bildliste neu laden
abl_droploader_prefs_use_default_stylesheet => Standarddarstellung verwenden
abl_droploader_some_files_uploaded => {{uploaded_files}} von {{filecount}} Dateien wurden hochgeladen.
#@abl
#@language it-it
abl_droploader_all_files_uploaded => {{filecount}} file caricati.
abl_droploader_close => &#x00d7;
abl_droploader_close_title => Chiudi DropLoader
abl_droploader_err_browser_not_supported => Il tuo browser non supporta l'upload tramite HTML5!
abl_droploader_err_file_too_large => {{filename}} è troppo grande!
abl_droploader_err_invalid_filetype => Non è possibile caricare {{filename}}. Sono consentite solo immagini (jpg, jpeg, gif, png)!
abl_droploader_err_too_many_files => Troppi file!<br />Per favore, seleziona al massimo {{maxfiles}} file!
abl_droploader_error_method => Method {{method}} non esiste in abl.droploader-app.js.
abl_droploader_info_text => Rilascia i file qui<br /><br />o clicca per selezionare i file
abl_droploader_no_files_uploaded => Nessun file caricato.
abl_droploader_open => Carica immagini
abl_droploader_open_title => Apri caricatore trascina & rilascia di immagini multiple
abl_droploader_prefs_article_image_fields => Campo/i Article-image (lista separata da virgole di nomi di campo CSS, usare #custom-n per i nomi di campi personalizzati)
abl_droploader_prefs_custom_stylesheet => Foglio di stile personalizzato (percorso/nomefile)
abl_droploader_prefs_file_max_upload_count => Numero massimo di file in upload
abl_droploader_prefs_image_max_upload_count => Numero massimo di immagini in upload
abl_droploader_prefs_reload_image_tab => Tab Imagini: ricarica la pagina alla chiusura di Droploader
abl_droploader_prefs_use_default_stylesheet => Usa gli stili di default
abl_droploader_some_files_uploaded => {{uploaded_files}} di {{filecount}} file caricati.
#@abl
#@language ja-jp
abl_droploader_all_files_uploaded => {{filecount}}このファイルをアップロードしました。
abl_droploader_close => &#x00d7;
abl_droploader_close_title => ヅロップローダを閉じる
abl_droploader_err_browser_not_supported => 君のブラウザーはＨＴＭＬ５アップロードできません！
abl_droploader_err_file_too_large => {{filename}}大きすぎる！
abl_droploader_err_invalid_filetype => {{filename}}をアップロードできません。画像だけでいいです「jpg, jpeg, gif, png」！
abl_droploader_err_too_many_files => ファイル多すぎ!<br />{{maxfiles}}このファイルを選んで下さい！
abl_droploader_error_method => Method {{method}} does not exist in abl.droploader-app.js.
abl_droploader_info_text => ファイルをここに<br /><br />ファイルを選ぶのため、クリックして下さい
abl_droploader_no_files_uploaded => なんもアップロードしてません。
abl_droploader_open => 画像のアップロード
abl_droploader_open_title => 多重画像を「Drag&drop」アップローダ
abl_droploader_prefs_article_image_fields => Article-image field(s) (comma separated list of CSS fieldnames, use #custom-n for custom field names)
abl_droploader_prefs_custom_stylesheet => Custom stylesheet (path/filename)
abl_droploader_prefs_file_max_upload_count => Maximum file count of file uploads
abl_droploader_prefs_image_max_upload_count => Maximum file count of image uploads
abl_droploader_prefs_reload_image_tab => Images-Tab: Close Droploader and reload image list after upload
abl_droploader_prefs_use_default_stylesheet => Use default styles
abl_droploader_some_files_uploaded => {{uploaded_files}} of {{filecount}} アップロードしました。.
EOT;

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
if (@txpinterface == 'admin') {

	// privs
    add_privs('abl_droploader', '1,2,3,4,6');
	add_privs('plugin_lifecycle.abl_droploader', '1,2');
	add_privs('plugin_prefs.abl_droploader', '1,2');

	// inject js & css in html-header
	register_callback('abl_droploader_head_end', 'admin_side', 'head_end');
	// trigger (button/link) elements
	register_callback('abl_droploader_article_ui', 'article_ui', 'extend_col_1');
	// following callback has been replaced by javascript!
	//register_callback('abl_droploader_image_ui', 'image_ui', 'extend_controls');
	// ajax interface
    register_callback('abl_droploader_ajax', 'abl_droploader');
	// intercept image_uploaded-event from txp_image
    register_callback('abl_droploader_image_uploaded', 'image_uploaded', 'image');
	// lifecycle
	register_callback('abl_droploader_lifecycle', 'plugin_lifecycle.abl_droploader');
	// prefs
	$abl_droploader_prefs = abl_droploader_load_prefs(); // load hard-coded defaults
	@require_plugin('soo_plugin_pref');
	register_callback('abl_droploader_prefs', 'plugin_prefs.abl_droploader');

}


	/**
	 * handle plugin lifecycle events
	 *
	 * @param string $event (plugin_lifecycle.abl_droploader)
	 * @param string $step (enabled, disabled, installed, deleted)
	 */
	function abl_droploader_lifecycle($event, $step) {
		global $prefs;

		$msg = '';
		$msg1 = '';
		switch ($step) {
			case 'enabled':
				// setup plugin: prefs, textpacks, load order
				if (!function_exists('soo_plugin_pref')) {
					$msg1 = 'Please install <em>soo_plugin_pref</em> to edit preferences (Default preferences apply).';
				}
				$rc = abl_droploader_enable($event, $step);
				break;
			case 'installed':
				// install resources: css, js
				$rc = abl_droploader_install($event, $step);
				break;
			case 'disabled':
				return '';
				break;
			case 'deleted':
				// remove prefs, textpacks and other resources
				$rc = abl_droploader_uninstall($event, $step);
				break;
		}
		if ($rc == E_ERROR) {
			$msg = '<strong>An error occurred. Please check the servers error-log.</strong>';
		} elseif ($rc == E_WARNING || $rc == E_NOTICE) {
			$msg = '<em>abl_droploader</em> successfully ' . $step . '. Please check the servers error-log.';
		} else {
			$msg = '<em>abl_droploader</em> successfully ' . $step . '.';
		}
		$msg .=  ($msg1 != '') ? ' ' . $msg1 : '';
		return $msg;

	}

	/**
	 * add plugin prefs to database
	 *
	 * @param string $event (plugin_prefs.abl_droploader)
	 * @param string $step (-)
	 */
    function abl_droploader_prefs($event, $step) {
		if (function_exists('soo_plugin_pref')) {
			soo_plugin_pref($event, $step, abl_droploader_defaults());
			return true;
		} else {
			$msg = 'Please install <em>soo_plugin_pref</em> to edit preferences (Default preferences apply).';
			pagetop(gTxt('edit_preferences') . " &#8250; abl_droploader", $msg);
			$default_prefs = abl_droploader_defaults();
			$html = '<table id="list" align="center" border="0" cellpadding="3" cellspacing="0">
<thead>
<tr>
<th colspan="2"><h1>DropLoader default preferences</h1></th>
</tr>
<tr>
<th>Option</th>
<th>Value</th>
</tr>
</thead>
<tbody>
';
			foreach ($default_prefs as $key => $pref) {
				$html .= '<tr>
<td>' . htmlspecialchars($pref['text']) . '</td>
<td>' . htmlspecialchars($pref['val']) . '</td>
</tr>
';
			}
			$html .= '</tbody>
</table>
';
			echo $html;
			return false;
		}
	}

	/**
	 * get plugin prefs default values
	 *
	 * @param string $values_only
	 */
	function abl_droploader_defaults($values_only = false) {

		$defaults = array(
			'imageMaxUploadCount' => array(
				'val'	=> '10',
				'html'	=> 'text_input',
				'text'	=> gTxt('abl_droploader_prefs_image_max_upload_count'),
			),
			'reloadImagesTab' => array(
				'val'	=> '0',
				'html'	=> 'yesnoradio',
				'text'	=> gTxt('abl_droploader_prefs_reload_image_tab'),
			),
			'useDefaultStylesheet' => array(
				'val'	=> '1',
				'html'	=> 'yesnoradio',
				'text'	=> gTxt('abl_droploader_prefs_use_default_stylesheet'),
			),
			'customStylesheet' => array(
				'val'	=> '',
				'html'	=> 'text_input',
				'text'	=> gTxt('abl_droploader_prefs_custom_stylesheet'),
			),
			'articleImageFields' => array(
				'val'	=> '#article-image',
				'html'	=> 'text_input',
				'text'	=> gTxt('abl_droploader_prefs_article_image_fields'),
			),
			//'fileMaxUploadCount' => array(
			//	'val'	=> '10',
			//	'html'	=> 'text_input',
			//	'text'	=> gTxt('abl_droploader_prefs_file_max_upload_count'),
			//),
		);
		if ($values_only)
			foreach ($defaults as $name => $arr)
				$defaults[$name] = $arr['val'];
		return $defaults;
	}


	/**
	 * Load plugin prefs
	 *
	 */
	function abl_droploader_load_prefs() {
		return function_exists('soo_plugin_pref_vals')
			? array_merge(abl_droploader_defaults(true), soo_plugin_pref_vals('abl_droploader'))
			: abl_droploader_defaults(true);
	}

	/**
	 * install plugin resources (css, js)
	 *
	 * @param string $event (plugin_lifecycle.abl_droploader)
	 * @param string $step (installed)
	 * @param mixed $resources
	 * @param string $path
	 */
	function abl_droploader_install($event, $step, $resources=null, $path='') {
		global $prefs;

		$state = 0;
		if ($resources === null) {
			$path = $prefs['path_to_site'];
			$resources = array();
			$resources['/res/css/abl.droploader-app.css'] =  'Ym9keSB7CglvdmVyZmxvdy14OiBoaWRkZW47CglvdmVyZmxvdy15OiBzY3JvbGw7Cn0KLyogaW1h
Z2UgbGlzdCAqLwovKiNpbWFnZV9jb250cm9sIC5hYmwtZHJvcGxvYWRlci1vcGVuIHsKCWZsb2F0
OiByaWdodDsKCW1hcmdpbi1yaWdodDogMWVtOwoJZm9udDogMWVtIFZlcmRhbmEsIEFyaWFsLCBz
YW5zLXNlcmlmOwoJZm9udC13ZWlnaHQ6IGJvbGQ7Cn0qLwoKI2FibC1kcm9wbG9hZGVyLWNsb3Nl
IHsKCWRpc3BsYXk6IGJsb2NrOwoJcG9zaXRpb246IGFic29sdXRlOwoJdG9wOiAyZW07CglyaWdo
dDogLjVlbTsKCXBhZGRpbmc6IDNweCAxMHB4IDZweCAxMHB4OwoJYm9yZGVyOiAxcHggc29saWQg
I2NjYzsKCXRleHQtZGVjb3JhdGlvbjogbm9uZTsKCXZlcnRpY2FsLWFsaWduOiBib3R0b207Cgl0
ZXh0LWFsaWduOiBjZW50ZXI7Cglmb250OiAyZW0gVmVyZGFuYSwgQXJpYWwsIHNhbnMtc2VyaWY7
Cglmb250LXdlaWdodDogYm9sZDsKCWNvbG9yOiAjMjIyOwoJYmFja2dyb3VuZDogI2ZmZjsKCXot
aW5kZXg6IDMzMzM7CgljdXJzb3I6IHBvaW50ZXI7Cn0KI2FibC1kcm9wbG9hZGVyLWNsb3NlOmhv
dmVyIHsKCWNvbG9yOiAjZjIyOwp9CgojYWJsLWRyb3Bsb2FkZXIgewoJcG9zaXRpb246IGFic29s
dXRlOwoJdG9wOiAwOwoJbGVmdDogMDsKCXdpZHRoOiAxMDAlOwoJaGVpZ2h0OiAxMDAlOwp9Cgov
KiAjYWJsLWRyb3Bsb2FkZXIgZm9ybSBpbnB1dCB7ICovCiNhYmwtZHJvcGxvYWRlciBmb3JtIGRp
diB7CglkaXNwbGF5OiBub25lOwp9CiNhYmwtZHJvcGxvYWRlciAudXBsb2FkLWluZm8gewoJcG9z
aXRpb246IGFic29sdXRlOwoJdG9wOiAwOwoJbGVmdDogMDsKCXdpZHRoOiAxMDAlOwoJaGVpZ2h0
OiAxMDAlOwoJdGV4dC1hbGlnbjogY2VudGVyOwoJZm9udC1zaXplOiAxLjVlbTsKCWZvbnQtd2Vp
Z2h0OiBub3JtYWw7Cgljb2xvcjogIzIyMjsKCWJhY2tncm91bmQ6IHJnYmEoMjU1LCAyNTUsIDI1
NSwgMC44NSk7Cgl6LWluZGV4OiAzMzMzOwp9CiNhYmwtZHJvcGxvYWRlciAuc2VsZWN0LWZpbGVz
IHsKCXBvc2l0aW9uOiBhYnNvbHV0ZTsKCXRvcDogMDsKCWxlZnQ6IDA7Cgl3aWR0aDogMTAwJTsK
CWhlaWdodDogMTAwJTsKCWNvbG9yOiAjNjY2OwoJYmFja2dyb3VuZDogcmdiYSgyNDAsIDI0MCwg
MjQwLCAwLjc1KTsKCXotaW5kZXg6IDMzMzM7Cn0KI2FibC1kcm9wbG9hZGVyIC5hYmwtZml4ZWQt
cG9zIHsKCXBvc2l0aW9uOiBmaXhlZDsKfQojYWJsLWRyb3Bsb2FkZXIgLnNlbGVjdC1maWxlcyBw
IHsKCWRpc3BsYXk6IGJsb2NrOwoJcG9zaXRpb246IGFic29sdXRlOwoJdG9wOiA1MCU7CglsZWZ0
OiAwOwoJd2lkdGg6IDEwMCU7CgltYXJnaW46IGF1dG8gMDsKCXRleHQtYWxpZ246IGNlbnRlcjsK
CWZvbnQtc2l6ZTogM2VtOwoJZm9udC13ZWlnaHQ6IG5vcm1hbDsKCXZlcnRpY2FsLWFsaWduOiBt
aWRkbGU7Cn0KI2FibC1kcm9wbG9hZGVyLWltYWdlLWNhdC1zZWwgewoJZGlzcGxheTogYmxvY2s7
Cglwb3NpdGlvbjogYWJzb2x1dGU7Cgl0b3A6IDhlbTsKCXJpZ2h0OiAxZW07CgliYWNrZ3JvdW5k
LWNvbG9yOiAjY2NjOwoJcGFkZGluZzogMWVtOwp9CiNhYmwtZHJvcGxvYWRlci1pbWFnZS1jYXQt
c2VsIHNlbGVjdCB7CgltYXJnaW4tdG9wOiAwLjVlbTsKfQojYWJsLWRyb3Bsb2FkZXIgLmltZy1w
cmV2aWV3IHsKCXBvc2l0aW9uOiByZWxhdGl2ZTsKCXRvcDogMDsKCWxlZnQ6IDA7Cgl3aWR0aDog
MTAwJTsKCWhlaWdodDogMjQwcHg7CgltYXJnaW46IDMwcHggYXV0bzsKCW92ZXJmbG93OiBoaWRk
ZW47CglsaXN0LXN0eWxlLXR5cGU6IG5vbmU7CglwYWRkaW5nOiAwOwoJdGV4dC1hbGlnbjogY2Vu
dGVyOwp9CiNhYmwtZHJvcGxvYWRlciAuaW1hZ2UtYm94IHsKCWhlaWdodDogMTg2cHg7Cgl2ZXJ0
aWNhbC1hbGlnbjogbWlkZGxlOwoJbGluZS1oZWlnaHQ6IDE4MHB4Owp9CiNhYmwtZHJvcGxvYWRl
ciAuaW1hZ2UtYm94IGltZyB7CgltYXgtd2lkdGg6IDI0MHB4OwoJbWF4LWhlaWdodDogMTgwcHg7
Cglib3JkZXI6IDNweCBzb2xpZCAjZmZmOwoJLW1vei1ib3gtc2hhZG93OiAwIDAgMnB4ICMwMDA7
Cgktd2Via2l0LWJveC1zaGFkb3c6IDAgMCAycHggIzAwMDsKCWJveC1zaGFkb3c6IDAgMCAycHgg
IzAwMDsKfQojYWJsLWRyb3Bsb2FkZXIgLmltZy1wcmV2aWV3IC5wcmV2aWV3IHsKCXBvc2l0aW9u
OiByZWxhdGl2ZTsKCXdpZHRoOiA1MDBweDsKCWhlaWdodDogMjA2cHg7CgltYXJnaW46IDEwcHgg
YXV0bzsKCXRleHQtYWxpZ246IGNlbnRlcjsKfQojYWJsLWRyb3Bsb2FkZXIgLmltZy1wcmV2aWV3
IC5wcmV2aWV3LmRvbmUgewoJb3ZlcmZsb3c6IGhpZGRlbjsKCWhlaWdodDogMDsKCXRyYW5zaXRp
b246IGhlaWdodCAwLjc1czsKCS1tb3otdHJhbnNpdGlvbjogaGVpZ2h0IDAuNzVzOwoJLXdlYmtp
dC10cmFuc2l0aW9uOiBoZWlnaHQgMC43NXM7Cgktby10cmFuc2l0aW9uOiBoZWlnaHQgMC43NXM7
Cn0KLyogcGVyIGltYWdlIHByb2dyZXNzICovCiNhYmwtZHJvcGxvYWRlciAuaW1hZ2UtcHJvZ3Jl
c3MgewoJcG9zaXRpb246IHJlbGF0aXZlOwoJaGVpZ2h0OiAxMnB4OwoJd2lkdGg6IDI0NnB4OwoJ
bWFyZ2luOiA1cHggYXV0bzsKCXZlcnRpY2FsLWFsaWduOiBtaWRkbGU7Cn0KI2FibC1kcm9wbG9h
ZGVyIC5pbWFnZS1wcm9ncmVzcyAucHJvZ3Jlc3MgewoJcG9zaXRpb246IGFic29sdXRlOwoJbGVm
dDogMDsKCWhlaWdodDogMTAwJTsKCXdpZHRoOiAwOwoJYmFja2dyb3VuZC1jb2xvcjogIzI1ODZk
MDsKfQoKLyogb3ZlcmFsbCBwcm9ncmVzcyAqLwojYWJsLWRyb3Bsb2FkZXIgLmZpbGVzLXByb2dy
ZXNzIHsKCXBvc2l0aW9uOiByZWxhdGl2ZTsKCXRvcDogMzUwcHg7CgloZWlnaHQ6IDI0cHg7Cgl3
aWR0aDogNTAwcHg7CgltYXJnaW46IDEwcHggYXV0bzsKfQojYWJsLWRyb3Bsb2FkZXIgLmZpbGVz
LXByb2dyZXNzIC5wcm9ncmVzcyB7Cglwb3NpdGlvbjogYWJzb2x1dGU7CglsZWZ0OiAwOwoJaGVp
Z2h0OiAxMDAlOwoJd2lkdGg6IDA7CgliYWNrZ3JvdW5kLWNvbG9yOiAjMjU4NmQwOwp9CgovKiBl
cnJvciBvciBjb21wbGV0aW9uIG1lc3NhZ2UgKi8KI2FibC1kcm9wbG9hZGVyIC5tZXNzYWdlLWJv
eCB7Cglwb3NpdGlvbjogcmVsYXRpdmU7Cgl0b3A6IDM1MHB4OwoJd2lkdGg6IDUwMHB4OwoJbWFy
Z2luOiAxMHB4IGF1dG87Cgl0ZXh0LWFsaWduOiBjZW50ZXI7Cglmb250LXNpemU6IHNtYWxsOwp9
Cg==';
			$resources['/res/js/abl.droploader-app.js'] =  'KGZ1bmN0aW9uKCQpIHsKCgl2YXIgZGVmYXVsdF9vcHRpb25zID0gewoJCXdpZGdldF9pZDogJ2Fi
bC1kcm9wbG9hZGVyJywKCQlzZWxlY3RfZmlsZXNfY2xhc3M6ICdzZWxlY3QtZmlsZXMnLAoJCWlt
YWdlX2NhdGVnb3JpZXNfc2VsZWN0OiAnJywKCQlmaWxlZHJvcDogewoJCQlwYXJhbW5hbWU6ICd0
aGVmaWxlJywKCQkJbWF4ZmlsZXM6IGltYWdlX21heF9maWxlcywKCQkJbWF4ZmlsZXNpemU6IGlt
YWdlX21heF91cGxvYWRfc2l6ZSwKCQkJdXJsOiAnaW5kZXgucGhwJywKCQkJZmFsbGJhY2tfaWQ6
ICdpbWFnZS11cGxvYWQnLAoJCQloZWFkZXJzOiB7CgkJCQknY2hhcnNldCc6ICd1dGYtOCcKCQkJ
fQoJCX0sCgkJbDEwbjogewoJCQknY2xvc2UnOiAnJiN4MDBkNzsnLAoJCQknY2xvc2VfdGl0bGUn
OiAnQ2xvc2UgRHJvcExvYWRlcicsCgkJCSdlcnJvcl9tZXRob2QnOiAnTWV0aG9kIHt7bWV0aG9k
fX0gZG9lcyBub3QgZXhpc3QgaW4gYWJsLmRyb3Bsb2FkZXItYXBwLmpzLicKCQl9Cgl9OwoJdmFy
IG9wdHMsCgkJZHJvcGxvYWRlcl9oaWRkZW4gPSB0cnVlLAoJCWRyb3Bsb2FkZXIgPSBudWxsOwoK
CSQuZm4uYWJsRHJvcExvYWRlckFwcCA9IGZ1bmN0aW9uKG1ldGhvZCkgewoKCQl2YXIgbWV0aG9k
cyA9IHsKCQkJaW5pdCA6IGZ1bmN0aW9uKG9wdGlvbnMpIHsKCQkJCWlmICghbWV0aG9kcy5pc1N1
cHBvcnRlZCgpKSByZXR1cm4gZmFsc2U7CgkJCQlvcHRzID0gJC5leHRlbmQoe30sIGRlZmF1bHRf
b3B0aW9ucywgb3B0aW9ucyk7CgkJCQlpZiAoJCgnI3BhZ2UtYXJ0aWNsZScpLmxlbmd0aCA+IDAp
IHsKCQkJCQlhcnRpY2xlX2ltYWdlX2ZpZWxkID0gbmV3IEFycmF5KCk7CgkJCQkJZm9yICh2YXIg
aSA9IDA7IGkgPCBhcnRpY2xlX2ltYWdlX2ZpZWxkX2lkcy5sZW5ndGg7ICsraSkgewoJCQkJCQlh
cnRpY2xlX2ltYWdlX2ZpZWxkW2ldID0gJChhcnRpY2xlX2ltYWdlX2ZpZWxkX2lkc1tpXSk7CgkJ
CQkJfQoJCQkJfQoJCQkJaWYgKCQoJyNoaWRkZW5fY2F0JykubGVuZ3RoID09IDApIHsKCQkJCQkk
KCcudXBsb2FkLWZvcm0nKQoJCQkJCQkuYXBwZW5kKCc8aW5wdXQgdHlwZT0iaGlkZGVuIiBpZD0i
YWJsX2Ryb3Bsb2FkZXIiIG5hbWU9ImFibF9kcm9wbG9hZGVyIiB2YWx1ZT0iMSIgLz5cbicpCgkJ
CQkJCS5hcHBlbmQoJzxpbnB1dCB0eXBlPSJoaWRkZW4iIGlkPSJoaWRkZW5fY2F0IiBuYW1lPSJj
YXRlZ29yeSIgdmFsdWU9IiIgLz4nKTsKCQkJCX0KCQkJCWlmIChvcHRzLmltYWdlX2NhdGVnb3Jp
ZXNfc2VsZWN0ID09ICcnKSB7CgkJCQkJJC5hamF4KHsKCQkJCQkJdXJsOiAnP2V2ZW50PWFibF9k
cm9wbG9hZGVyJnN0ZXA9Z2V0X2Zvcm1fZGF0YSZpdGVtcz1pbWFnZV9jYXRfc2VsZWN0LGwxMG4n
LAoJCQkJCQlkYXRhVHlwZTogJ2pzb24nLAoJCQkJCQlhc3luYzogZmFsc2UsCgkJCQkJCXN1Y2Nl
c3M6IGZ1bmN0aW9uKGRhdGEpIHsKCQkJCQkJCWlmIChkYXRhLnN0YXR1cyA9PSAnMScpIHsKCQkJ
CQkJCQlvcHRzLmltYWdlX2NhdGVnb3JpZXNfc2VsZWN0ID0gZGF0YS5pbWFnZV9jYXRfc2VsZWN0
OwoJCQkJCQkJCW9wdHMubDEwbiA9IGRhdGEubDEwbjsKCQkJCQkJCX0KCQkJCQkJfQoJCQkJCX0p
OwoJCQkJfQoJCQkJJCgnYm9keScpLmRlbGVnYXRlKCcjYWJsLWRyb3Bsb2FkZXItY2xvc2UnLCAn
Y2xpY2suZHJvcGxvYWRlcicsIGZ1bmN0aW9uKGUpIHsKCQkJCQltZXRob2RzLmNsb3NlKCk7CgkJ
CQkJcmV0dXJuIGZhbHNlOwoJCQkJfSk7CgkJCQkkKCdib2R5JykuZGVsZWdhdGUoJyNhYmwtZHJv
cGxvYWRlci1pbWFnZS1jYXQtc2VsIConLCAnY2xpY2suZHJvcGxhZGVyJywgZnVuY3Rpb24oZSkg
ewoJCQkJCXJldHVybiBmYWxzZTsKCQkJCX0pOwoJCQkJJCgnYm9keScpLmRlbGVnYXRlKCcjYWJs
LWRyb3Bsb2FkZXItaW1hZ2UtY2F0LXNlbCBzZWxlY3QnLCAnY2hhbmdlLmRyb3BsYWRlcicsIGZ1
bmN0aW9uKGUpIHsKCQkJCQkkKCcjaGlkZGVuX2NhdCcpLnZhbCgkKHRoaXMpLnZhbCgpKTsKCQkJ
CQlyZXR1cm4gZmFsc2U7CgkJCQl9KTsKCQkJCWRyb3Bsb2FkZXIgPSAkKCcudXBsb2FkLWZvcm0n
KS5kcm9wbG9hZGVyKG9wdHMpOwoJCQkJJCgnI2FibC1kcm9wbG9hZGVyJykuaGlkZSgpOwoKCSAg
ICAgICAJCXJldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKSB7fSk7CgkJCX0sCgkJCWlzU3VwcG9y
dGVkOiBmdW5jdGlvbigpIHsKCQkJCXJldHVybiAoJ2RyYWdnYWJsZScgaW4gZG9jdW1lbnQuY3Jl
YXRlRWxlbWVudCgnc3BhbicpKSAmJiAodHlwZW9mIEZpbGVSZWFkZXIgIT0gJ3VuZGVmaW5lZCcp
OwoJCQl9LAoJCQlvcGVuOiBmdW5jdGlvbigpIHsKICAgICAgICAJCXJldHVybiB0aGlzLmVhY2go
ZnVuY3Rpb24oKSB7CgkJCQkJaWYgKCQoJy51cGxvYWQtZm9ybScpLmxlbmd0aCA+IDApIHsKCQkJ
CQkJZHJvcGxvYWRlci5kcm9wbG9hZGVyKCdyZXNldCcpOwoJCQkJCQkkKCcjYWJsLWRyb3Bsb2Fk
ZXInKS5zbGlkZURvd24oZnVuY3Rpb24oKSB7CgkJCQkJCQkkKCcjYWJsLWRyb3Bsb2FkZXIgLnNl
bGVjdC1maWxlcycpLmFkZENsYXNzKCdhYmwtZml4ZWQtcG9zJyk7CgkJCQkJCQlkcm9wbG9hZGVy
X2hpZGRlbiA9IGZhbHNlOwoJCQkJCQkJJCgnaHRtbCcpLmJpbmQoJ2tleXVwLmRyb3Bsb2FkZXIn
LCBmdW5jdGlvbihlKSB7CgkJCQkJCQkJaWYgKGUud2hpY2ggPT0gMjcpIHsKCQkJCQkJCQkJbWV0
aG9kcy5jbG9zZSgpOwoJCQkJCQkJCQlyZXR1cm4gZmFsc2U7CgkJCQkJCQkJfQoJCQkJCQkJfSk7
CgkJCQkJCX0pOwoJCQkJCX0KCQkJCX0pOwoJCQl9LAoJCQljbG9zZTogZnVuY3Rpb24oKSB7CgkJ
CQkkKCcjYWJsLWRyb3Bsb2FkZXIgLnNlbGVjdC1maWxlcycpLnJlbW92ZUNsYXNzKCdhYmwtZml4
ZWQtcG9zJyk7CgkJCQkkKCcjYWJsLWRyb3Bsb2FkZXInKS5zbGlkZVVwKGZ1bmN0aW9uKCkgewoJ
CQkJCWRyb3Bsb2FkZXJfaGlkZGVuID0gdHJ1ZTsKCQkJCQkkKCdodG1sJykudW5iaW5kKCcuZHJv
cGxvYWRlcicpOwoJCQkJCWRyb3Bsb2FkZXIgPSBudWxsOwoJCQkJCWlmICgkKCcjcGFnZS1pbWFn
ZScpLmxlbmd0aCA+IDAgJiYgcmVsb2FkX2ltYWdlX3RhYiAhPSAwKSB7CgkJCQkJCWxvY2F0aW9u
LnJlbG9hZCgpOwoJCQkJCX0KCQkJCX0pOwoJCQkJcmV0dXJuIGZhbHNlOwoJCQl9LAoJCQlkZXN0
cm95IDogZnVuY3Rpb24oKSB7CgkJCQlyZXR1cm4gbWV0aG9kcy5jbG9zZSgpOwoJCQl9CgkJfTsK
CgkJaWYgKG1ldGhvZHNbbWV0aG9kXSkgewoJCQlyZXR1cm4gbWV0aG9kc1ttZXRob2RdLmFwcGx5
KHRoaXMsIEFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKGFyZ3VtZW50cywgMSkpOwoJCX0gZWxz
ZSBpZiAodHlwZW9mIG1ldGhvZCA9PT0gJ29iamVjdCcgfHwgISBtZXRob2QpIHsKCQkJcmV0dXJu
IG1ldGhvZHMuaW5pdC5hcHBseSh0aGlzLCBhcmd1bWVudHMpOwoJCX0gZWxzZSB7CgkJCSQuZXJy
b3IoZ2V0VGV4dChvcHRzLmwxMG4uZXJyb3JfbWV0aG9kLCB7ICdtZXRob2QnOiBtZXRob2QgfSkp
OwoJCX0KCgkJLyogc2hvdyBlcnJvciBvciBjb21wbGV0aW9uIG1lc3NhZ2UgKi8KCQlmdW5jdGlv
biBnZXRUZXh0KHRleHQsIHZhbHVlcywgbmwyYnIpewoJCQlpZiAodmFsdWVzICE9PSB1bmRlZmlu
ZWQgJiYgdmFsdWVzICE9ICcnKSB7CgkJCQlmb3IgKHZhciBlbnRyeSBpbiB2YWx1ZXMpIHsKCQkJ
CQl2YXIgcmVnZXhwID0gbmV3IFJlZ0V4cCgne3snICsgZW50cnkgKyAnfX0nLCAnZ2knKTsKCQkJ
CQl0ZXh0ID0gdGV4dC5yZXBsYWNlKHJlZ2V4cCwgdmFsdWVzW2VudHJ5XSk7CgkJCQl9CgkJCX0K
CQkJaWYgKG5sMmJyID09PSB0cnVlKSB7CgkJCQl0ZXh0ID0gdGV4dC5yZXBsYWNlKC9cXG4vZywg
JzxiciAvPicpOwoJCQl9IGVsc2UgewoJCQkJdGV4dCA9IHRleHQucmVwbGFjZSgvXFxuL2csIFN0
cmluZy5mcm9tQ2hhckNvZGUoMTApKTsKCQkJfQoJCQlyZXR1cm4gdGV4dDsKCQl9CgoJfTsKCn0p
KGpRdWVyeSk7CgoKJChmdW5jdGlvbigpewoKCXZhciBkcm9wbG9hZGVyX29wdGlvbnMgPSB7CgkJ
YWZ0ZXJBbGw6IGZ1bmN0aW9uKGZpbGVzKSB7CgkJCWlmIChmaWxlcy5sZW5ndGggPiAwICYmIGFy
dGljbGVfaW1hZ2VfZmllbGQgIT0gbnVsbCkgewoJCQkJZm9yICh2YXIgaSA9IDA7IGkgPCBhcnRp
Y2xlX2ltYWdlX2ZpZWxkLmxlbmd0aDsgKytpKSB7CgkJCQkJdmFyIHYgPSAkKGFydGljbGVfaW1h
Z2VfZmllbGRbaV0pLnZhbCgpOwoJCQkJCWlmICh2ID09ICcnKSB7CgkJCQkJCXYgPSBmaWxlcy5q
b2luKCcsJyk7CgkJCQkJfSBlbHNlIHsKCQkJCQkJdiArPSAnLCcgKyBmaWxlcy5qb2luKCcsJyk7
CgkJCQkJfQoJCQkJCSQoYXJ0aWNsZV9pbWFnZV9maWVsZFtpXSkudmFsKHYpOwoJCQkJCSQoYXJ0
aWNsZV9pbWFnZV9maWVsZFtpXSkuY2hhbmdlKCk7CgkJCQl9CgkJCX0KCQl9LAoJCWwxMG46IHt9
Cgl9OwoKCWlmICgkLmZuLmFibERyb3BMb2FkZXJBcHAoJ2lzU3VwcG9ydGVkJykpIHsKCgkJdmFy
IGRvY19sYW5ndWFnZSA9ICQoJ2h0bWwnKS5hdHRyKCdsYW5nJyksCgkJCWltYWdlX3VwbG9hZF9s
aW5rID0gJycsCgkJCWltYWdlX3VwbG9hZF9mb3JtID0gJyc7CgoJCWlmIChpbWFnZV91cGxvYWRf
Zm9ybSA9PSAnJykgewoJCQkkLmdldEpTT04oCgkJCQknP2V2ZW50PWFibF9kcm9wbG9hZGVyJnN0
ZXA9Z2V0X2Zvcm1fZGF0YSZpdGVtcz1hbGwnLAoJCQkJZnVuY3Rpb24oZGF0YSkgewoJCQkJCWlm
IChkYXRhLnN0YXR1cyA9PSAnMScpIHsKCQkJCQkJaW1hZ2VfdXBsb2FkX2xpbmsgPSBkYXRhLmlt
YWdlX3VwbG9hZF9saW5rOwoJCQkJCQlpbWFnZV91cGxvYWRfZm9ybSA9IGRhdGEuaW1hZ2VfdXBs
b2FkX2Zvcm07CgkJCQkJCWRyb3Bsb2FkZXJfb3B0aW9ucy5pbWFnZV9jYXRlZ29yaWVzX3NlbGVj
dCA9IGRhdGEuaW1hZ2VfY2F0X3NlbGVjdDsKCQkJCQkJZHJvcGxvYWRlcl9vcHRpb25zLmwxMG4g
PSBkYXRhLmwxMG47CgkJCQkJCWFibERyb3BMb2FkZXJTZXR1cCgpOwoJCQkJCX0KCQkJCX0KCQkJ
KTsKCQl9IGVsc2UgewoJCQlhYmxEcm9wTG9hZGVyU2V0dXAoKTsKCQl9CgoJCWZ1bmN0aW9uIGFi
bERyb3BMb2FkZXJTZXR1cCgpIHsKCQkJaWYgKCQoJyNwYWdlLWFydGljbGUnKS5sZW5ndGggPiAw
ICYmICQoJy51cGxvYWQtZm9ybScpLmxlbmd0aCA9PSAwKSB7CgkJCQkkKCdib2R5JykuYXBwZW5k
KGltYWdlX3VwbG9hZF9mb3JtKTsKCQkJfQoJCQkkKCcudXBsb2FkLWZvcm0nKS5oaWRlKCk7CgkJ
CWlmICgkKCcjcGFnZS1pbWFnZScpLmxlbmd0aCA+IDApIHsKCQkJCSQoJ2JvZHknKS5hcHBlbmQo
JCgnLnVwbG9hZC1mb3JtJykpOyAvLyBtb3ZlIGZvcm0KCQkJLy8JJCgnI2ltYWdlX2NvbnRyb2wn
KS5wcmVwZW5kKGltYWdlX3VwbG9hZF9saW5rKTsgLy8gaW5zZXJ0IGxpbmsKICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAkKCcudHhwLWNvbnRyb2wtcGFuZWwnKS5wcmVwZW5kKGltYWdl
X3VwbG9hZF9saW5rKTsgLy8gaW5zZXJ0IGxpbmsKCQkJfQoJCQkkKCdib2R5JykuZGVsZWdhdGUo
Jy5hYmwtZHJvcGxvYWRlci1vcGVuJywgJ2NsaWNrLmRyb3Bsb2FkZXInLCBmdW5jdGlvbihlKSB7
CgkJCQkkKCcudXBsb2FkLWZvcm0nKQoJCQkJCS5hYmxEcm9wTG9hZGVyQXBwKCdpbml0JywgZHJv
cGxvYWRlcl9vcHRpb25zKQoJCQkJCS5hYmxEcm9wTG9hZGVyQXBwKCdvcGVuJyk7CgkJCQlyZXR1
cm4gZmFsc2U7CgkJCX0pOwoJCX0KCgl9Cgp9KTsK';
			$resources['/res/js/jquery.droploader.js'] =  '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';
			$resources['/res/js/jquery.filedrop.js'] =  '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';
		}

		foreach($resources as $file => $resource) {
			$newfile = $path . $file;
			if (is_array($resource)) {
				abl_droploader_install($event, $step, $resource, $newfile . '/');
			} else {
				$ok = is_dir(dirname($newfile));
				if (!$ok) {
					$ok = mkdir(dirname($newfile), 0755, true);
				}
				if ($ok) {
					$temp = base64_decode($resource);
					if (strncmp($temp, "\x1F\x8B", 2) === 0) {
						$temp = gzinflate(substr($temp, 10));
					}
					if (file_exists($newfile)) unlink($newfile);
					$handle = fopen($newfile, 'w');
					if ($handle !== false) {
						fwrite($handle, $temp);
						chmod($newfile, 0644);
						fclose($handle);
					} else {
						$state = E_ERROR;
						error_log('abl_droploader: ERROR: Creating file \'' . $newfile . '\' failed.');
					}
				} else {
					$state = E_ERROR;
					error_log('abl_droploader: ERROR: Creating directory \'' . dirname($newfile) . '\' failed.');
				}
			}
		}
		return $state;

	}

	/**
	 * activate plugin
	 *
	 * @param string $event (plugin_lifecycle.abl_droploader)
	 * @param string $step (enabled)
	 */
	function abl_droploader_enable($event, $step) {
		global $prefs;

		$state = 0;
		// install prefs
		$pref_prefix = 'abl_droploader.';
		$pi_pref_defaults = abl_droploader_defaults();
		$pi_prefs = array();
		$rs = safe_rows('name, val, position', 'txp_prefs',
			"name like '" . $pref_prefix . "%' order by position asc");
		foreach ($rs as $rec) {
			$name = str_replace($pref_prefix, '', $rec['name']);
			$pi_prefs[$name] = $rec['val'];
		}
		$prefs_add = array_diff_key($pi_pref_defaults, $pi_prefs);
		$prefs_remove = array_diff_key($pi_prefs, $pi_pref_defaults);
		foreach ($prefs_add as $name => $pref) {
			$rc = set_pref(
				$pref_prefix . $name,
				$pref['val'],
				'plugin_prefs',
				2,
				$pref['html']
			);
			if ($rc === false) {
				$state = E_ERROR;
				error_log('abl_droploader: WARNING: Preference \'' . $pref_prefix . $name . '\' not created.');
			}
		}
		// remove obsolete prefs
		foreach ($prefs_remove as $name => $val) {
			if (!safe_delete('txp_prefs', "name = '" . $pref_prefix . $name . "'")) {
				if ($state == 0) $state = E_NOTICE;
				error_log('abl_droploader: Notice: Removal of obsolete preference \'' . $pref_prefix . $name . '\' failed.');
			}
		}
		// update position values
		foreach (array_keys($pi_pref_defaults) as $i => $name) {
			safe_update('txp_prefs', 'position = ' . $i,
				"name = '" . $pref_prefix . $name . "'");
		}
/*
		$pi_pref_defaults = abl_droploader_defaults();
		$max_pos = safe_field('position', 'txp_prefs', "name like '" . $pref_prefix . "%' ORDER BY position DESC");
		if ($max_pos === false) {
			$max_pos = 0;
		} else {
			$max_pos++;
		}
		foreach ($pi_pref_defaults as $name => $pref) {
			if (get_pref($pref_prefix . $name, 'nope', 1) == 'nope') {
				$rc = set_pref(
					$pref_prefix . $name,
					$pref['val'],
					'plugin_prefs',
					2,
					$pref['html'],
					$max_pos
				);
				if ($rc === false) {
					$state = E_ERROR;
					error_log('abl_droploader: WARNING: Preference \'' . $pref_prefix . $name . '\' not created.');
				}
				$max_pos++;
			}
		}
		// delete obsolete prefs (if any)
		$current_prefs = safe_column('name', 'txp_prefs', "name like '" . $pref_prefix . "%'");
		foreach ($current_prefs as $current_pref) {
			$p = substr($current_pref, strlen($pref_prefix));
			if (!array_key_exists($p, $pi_pref_defaults)) {
				if (!safe_delete('txp_prefs', "name = '" . $pref_prefix . $p ."'")) {
					if ($state == 0) $state = E_NOTICE;
					error_log('abl_droploader: Notice: Removal of obsolete preference \'' . $pref_prefix . $name . '\' failed.');
				}
			}
		}
		// order prefs
		$pos = 0;
		foreach ($pi_pref_defaults as $name => $pref) {
			safe_update('txp_prefs', "position = '" . $pos . "'", "name = '" . $pref_prefix . $name . "'");
			$pos++;
		}
*/
		// remove obsolete textpack entries
		$old_textpack_keys = array('abl_droploader_prefs_custom_stylesheetb');
		$where = 'name in ("' . implode('", "', $old_textpack_keys) . '")';
		if (!safe_delete('txp_lang', $where)) {
			error_log('abl_droploader: WARNING: Removal of obsolete textpack entries failed.');
		}

		// set load order to 9 (important!)
		if (!safe_update('txp_plugin', 'load_order = 9', "name='abl_droploader'")) {
			if ($state == 0 or $state == E_NOTICE) $state = E_WARNING;
			error_log('abl_droploader: WARNING: Setting the plugin load order to 9 failed.');
		}

		// set txp's thumb prefs if they are not set (fresh install)
		if (!isset($prefs['thumb_w'])) set_pref('thumb_w', '100', 'image', PREF_HIDDEN);
		if (!isset($prefs['thumb_h'])) set_pref('thumb_h', '100', 'image', PREF_HIDDEN);
		if (!isset($prefs['thumb_crop'])) set_pref('thumb_crop', '1', 'image', PREF_HIDDEN);

		return $state;

	}

	/**
	 * uninstall plugin resources (css, js)
	 *
	 * @param string $event (plugin_lifecycle.abl_droploader)
	 * @param string $step (deleted)
	 */
	function abl_droploader_uninstall($event, $step) {
		global $prefs;

		$state = 0;
		// uninstall prefs
		if (!safe_delete('txp_prefs', "name LIKE 'abl_droploader.%'")) {
			if ($state == 0) $state = E_WARNING;
			error_log('abl_droploader: WARNING: Removal of plugin preferences failed.');
		}

		// remove textpack entries
		if (!safe_delete('txp_lang', "name LIKE 'abl_droploader%'")) {
			if ($state == 0) $state = E_WARNING;
			error_log('abl_droploader: WARNING: Removal of obsolete textpack entries failed.');
		}

		// remove css, javascript, etc.
		$path = $prefs['path_to_site'];
		$resources = array(
			'/res/css/abl.droploader-app.css',
			'/res/js/abl.droploader-app.js',
			'/res/js/jquery.droploader.js',
			'/res/js/jquery.filedrop.js',
			'/res/css/',
			'/res/js/',
			'/res/',
		);
		foreach ($resources as $res) {
			$f = $path . $res;
			if (is_dir($f)) {
				if (!rmdir($f)) {
					if ($state == 0 or $state == E_NOTICE) $state = E_WARNING;
					error_log('abl_droploader: WARNING: Cannot remove directory \'' . $f . '\'.');
				}
			} elseif (is_file($f)) {
				if (!unlink($f)) {
					if ($state == 0 or $state == E_NOTICE) $state = E_WARNING;
					error_log('abl_droploader: WARNING: Cannot remove file \'' . $f . '\'.');
				}
			}
		}

		return $state;
	}

	/**
	 * inject css & js in html-header
	 *
	 * @param string $evt (admin_side)
	 * @param string $stp (head_end)
	 */
	function abl_droploader_head_end($evt, $stp) {
		global $event, $step, $prefs, $abl_droploader_prefs;

		if (($event == 'image'
			&& (in_array($step, array('list', 'image_list', 'image_multi_edit', 'image_change_pageby', 'image_save', ''))))
		|| ($event == 'article'
			&& (in_array($step, array('create', 'edit'))))) {
			$abl_droploader_prefs = abl_droploader_load_prefs();
			$css = '';
			if (intval($abl_droploader_prefs['useDefaultStylesheet']) != 0) {
				$css .= '<link rel="stylesheet" href="../res/css/abl.droploader-app.css" type="text/css" media="screen,projection" />' . n;
			}
			if ($abl_droploader_prefs['customStylesheet'] != '') {
				$css .= '<link rel="stylesheet" href="' . $abl_droploader_prefs['customStylesheet'] . '" type="text/css" media="screen,projection" />' . n;
			}
			if ($css == '') {
				$css = '<link rel="stylesheet" href="../res/css/abl.droploader-app.css" type="text/css" media="screen,projection" />' . n;
			}
			$article_image_field_ids = '"' . implode('", "', explode(',', $abl_droploader_prefs['articleImageFields'])) . '"';
			$script = '<script type="text/javascript">
	var file_max_upload_size = ' . sprintf('%F', (intval($prefs['file_max_upload_size']) / 1048576)) . ';
	var file_max_files = 5;
	var image_max_upload_size = 1;
	var image_max_files = ' . intval($abl_droploader_prefs['imageMaxUploadCount']) . ';
	var reload_image_tab = ' . intval($abl_droploader_prefs['reloadImagesTab']) . ';
	var article_image_field_ids = new Array(' . $article_image_field_ids . ');
	var article_image_field = null;
</script>
<script src="../res/js/jquery.filedrop.js" type="text/javascript"></script>
<script src="../res/js/jquery.droploader.js" type="text/javascript"></script>
<script src="../res/js/abl.droploader-app.js" type="text/javascript"></script>' . n;
			echo $css . $script;
		}

	}


	/**
	 * Insert DropLoader link in column 1 on the write-tab
	 *
	 * @param string $event (article_ui)
	 * @param string $step (extend_col_1)
	 */
	function abl_droploader_article_ui($event, $step, $data) {
		$content = '
<ul class="abl_droploader plain-list">
<li><a id="abl-droploader-open" class="abl-droploader-open" href="#" title="' . gTxt('abl_droploader_open_title') . '">' . gTxt('abl_droploader_open') . '</a></li>
</ul>';
		if (is_callable('wrapRegion')) { // new in txp 4.6
			return $data.wrapRegion('abl_droploader_group', $content, 'abl_droploader_link', 'upload', 'article_abl_droploader');
		} else {
			return $data.'
<div id="abl_droploader_group"><h3 class="plain lever"><a href="#abl_droploader-link">' . gTxt('upload') . '</a></h3>
<div id="abl_droploader-link" class="toggle" style="display:none">' .
$content . '
</div>
</div>
';
		}
	}

	/**
	 * Insert DropLoader link above the image-list on the image-tab
	 *
	 * @param string $event (image_ui)
	 * @param string $step (extend_controls)
	 */

/* modified by kirito (gas) */
  function abl_droploader_image_ui($event, $step) {
        $content = '<div class="abl-droploader-file-uploader">
    <a id="abl-droploader-open" class="abl-droploader-open txp-button" href="#" title="' . gTxt('abl_droploader_open_title') . '">' . gTxt('abl_droploader_open') . '</a>
  </div>';
        return $content.n;
    }
/* following commented by kirito
   function abl_droploader_image_ui($event, $step) {
		return '<p class="plain"><a id="abl-droploader-open" class="abl-droploader-open" href="#" title="' . gTxt('abl_droploader_open_title') . '">' . gTxt('abl_droploader_open') . '</a></p>' . n;
	}*/

	/**
	 * handle AJAX requests
	 * return JSON and exit
	 *
	 * @param string $event (abl_droploader)
	 * @param string $step (get_form_data, get_image_data)
	 */
	function abl_droploader_ajax($event, $step) {

		if ($event == 'abl_droploader') {
			switch ($step) {
				case 'get_form_data':
					$response = array(
						'status' => 0,
						'image_upload_link' => '',
						'image_upload_form' => '',
						'image_cat_select' => '',
						'l10n' => ''
					);
					$items = explode(',', gps('items'));
					foreach ($items as $item) {
						switch ($item) {
							case 'image_upload_link':
								$response['image_upload_link'] = abl_droploader_image_ui('', '');
								break;
							case 'image_upload_form':
								$response['image_upload_form'] = abl_droploader_get_image_upload_form();
								break;
							case 'image_cat_select':
								$response['image_cat_select'] = abl_droploader_get_image_cat_select();
								break;
							case 'l10n':
								$response['l10n'] = abl_droploader_get_localisation();
								break;
							case 'all':
								$response['image_upload_link'] = abl_droploader_image_ui('', '');
								$response['image_upload_form'] = abl_droploader_get_image_upload_form();
								$response['image_cat_select'] = abl_droploader_get_image_cat_select();
								$response['l10n'] = abl_droploader_get_localisation();
								break;
						}
					}
					$response['status'] = 1;
					break;
			}
			echo json_encode($response);
			exit;
		}

	}

	/**
	 * get image category-selector form element
	 */
	function abl_droploader_get_image_cat_select() {
		$image_categories = getTree('root', 'image');
		//$image_categories_select = str_ireplace("\n", '', tag('<label for="image-category">' . gTxt('image_category') . '</label>' . br .
		//	treeSelectInput('category', $image_categories, '', 'image-category'), 'div', ' id="abl-droploader-image-cat-sel" class="category"'));
		//$alt_caption =	tag('<label for="alt-text">'.gTxt('alt_text').'</label>'.br.
		//		fInput('text', 'alt', '', 'edit', '', '', 50, '', 'alt-text'), 'div', ' class="alt text"').
		//	tag('<label for="caption">'.gTxt('caption').'</label>'.br.
		//		'<textarea id="caption" name="caption"></textarea>'
		//		, 'div', ' class="caption description text"');
		$image_categories_select = str_ireplace("\n", '', tag(tag('<label for="image-category">'.gTxt('image_category').'</label>'.br.
				treeSelectInput('category', $image_categories, '', 'image-category'), 'div', ' class="category"'), 'div', ' id="abl-droploader-image-cat-sel"'));
		return $image_categories_select;
	}

	/**
	 * get image upload-form
	 */
	function abl_droploader_get_image_upload_form() {
		$upload_form = upload_form(gTxt('upload_image'), 'upload_image', 'image_insert', 'image', '');
		//return '<div id="droploader">' . n . $upload_form . n . '</div>' . n;
		return $upload_form;
	}

	/**
	 * get localised items from textpack
	 */
	function abl_droploader_get_localisation() {
		$l10n = array(
			'open' => '',
			'open_title' => '',
			'close' => '',
			'close_title' => '',
			'error_method' => '',
			'info_text' => '',
			'err_invalid_filetype' => '',
			'err_browser_not_supported' => '',
			'err_too_many_files' => '',
			'err_file_too_large' => '',
			'all_files_uploaded' => '',
			'no_files_uploaded' => '',
			'some_files_uploaded' => '',
		);
		foreach ($l10n as $k => $v) {
			$l10n[$k] = gTxt('abl_droploader_' . $k);
		}
		return $l10n;
	}

	/**
	 * image_uploaded callback (txp_image.php)
	 * return JSON (image-id) and exit
	 *
	 * @param string $event (image_uploaded)
	 * @param string $step (image)
	 * @param string $id (image_id)
	 */
	function abl_droploader_image_uploaded($event, $step, $id) {
		if (ps('abl_droploader') == '') return;
		$response = array(
			'status' => 1,
			'image_id' => $id,
		);
		echo json_encode($response);
		exit;
	}
# --- END PLUGIN CODE ---
if (0) {
?>
# --- BEGIN PLUGIN HELP ---
h1. abl_droploader

DropLoader for "Textpattern CMS":http://textpattern.com/ allows you to upload multiple images at once, simply by dragging files from the desktop onto the browser window. The user interface of DropLoader is a transparent area, shown above Textpatterns own UI.

A special feature of DropLoder is the fact, that it hides the standard upload-form, but uses it in the background for sending the data to server. The form-data will therefore be processed by Textpatterns regular image upload-script, txp_image.php.

DropLoader is enabled in two places. On the image-tab (Menu: Content > Images), where it replaces the standard upload-form, but also on the write-tab (Content > Write). This makes it possible to upload images right from there, without a need to switch between the write- and image-tabs. Uploaded images will be automatically assigned to the current article (field article image), if DropLoader is opened directly from the write-tab.

It is also possible to automatically assign a category to the uploaded images. Simply select a category, _before_ files are dropped or selected.

Both, "Drag & Drop" and the upload functionality is based on the jQuery plugin "jquery.filedrop.js":https://github.com/weixiyen/jquery-filedrop by Weixi Yen. Thanks!

h2. Browser Support

The jQuery-plugin filedrop requires the "File Reader API" and the "Drag & Drop API". *DropLoader disables itself, if these API's are not supported.*

Recent versions of *Firefox* and *Google Chrome* supports all features and work perfectly. However, Internet Explorer (incl. IE9), Opera and Safari currently do not support all of the required API's, so DropLoader will not be available with these browsers.

h2. Features

* Enables uploading of multiple images at once
* File selection using drap & drop or the file open-dialog
* Hides the standard upload-form in the images-tab
* Automatically assign image-category to each uploaded image (optional)
* Automatically create thumbnail, if thumbnail dimensions are available
* Fully compatible to the standard image upload-form: Form data is posted to the same script (txp_image.php) for processing
* Enables image uploads directly from the write-tab (Article detail/edit view)
* Automatically assign uploaded images to the current article's images-field (only if DropLoader has been opened directly from the write-tab)
* Supports localisation (l10n) using textpacks.
* DropLoader can also be used by other Textpattern plugins, e.g. from file- or image-pickers/selectors.

h2. Requirements

Textpattern 4.6+.

*Important:* To be able to edit preferences, the plugin _soo_plugin_pref_ is required. Hard coded default preferences apply, if soo_plugin_pref is not installed.

h2. Author

* Original author: Andreas Blaser ("web":http://www.blaser-it.ch/)
* Leonardo Gaudino ("web":https://github.com/gas-kirito)

h2. Installation

This plugin can be installed and activated as usual on the plugins-tab.

DropLoader requires some additional resources (jQuery plugins, stylesheet), which are installed when the plugin is activated.

*Note:*
When upgrading abl_droploader from a previous version, you may need to clear the browser cache.

The following files will be installed on plugin activation:

* / (site-root)
** res/
*** css/
**** abl.droploader-app.css
*** js/
**** jquery.filedrop.js
**** jquery.droploader.js
**** abl.droploader-app.js

h2. Localisation

DropLoader uses textpacks for localisation. The distribution package already contains textpacks in english (en-gb) and german (de-de).

The name of all language strings begins with 'abl_droploader_'.

*Note:* Starting with Version 0.13, the english textpack will also be installed under the language-key for the current site language, if this is *not* en-gb or de-de. These strings can then be translated to the desired language, for example using the snippet editor of the MLP (Multi-Language Pack).

Thanks to Stef Dawson for this tip!

h2. Changelog

h4. Version 0.20.1-gas (2017-12-28)
* Very small fix to better integrate in txp-4.6+

h4. Version 0.20 (2013-03-27)

* Improved installation procedures:
** SECURITY: changes filemode for created directories from 777 to 755.
** Log errors, warnings and notices in error-log if something goes wrong.
** Set plugin load-order to 9 in database table txp_plugin.
** Remove textpack entry 'abl_droploader_prefs_custom_stylesheetb' from table txp_lang (misspelled key)

* Uninstallation procedure added (executed when the plugin has been deleted):
** Remove preferences, textpacks and filesystem resources (js, css, directories)

h4. Version 0.19 (2013-02-21)

* Write Pane: Rendering of the droploader open-link changed. Function 'wrapRegion' will be used, if available (Txp 4.6).
* Correction in jquery.droploader.js: Ignore drop-events when the drop-area is not visible.
* Cleanup php and javascripts (remove commented code).

h4. Version 0.18 (2013-02-19)

* Resolved a compatibility issue with jQuery 1.9 (Txp 4.6-SVN): Use 'delegate' instead of 'live' for event-handler attachment (live-method has been removed in jQuery 1.9). The delegate-method is available in jQuery Versions 1.4.2 or newer.

h4. Version 0.17 (2013-01-26)

* Changed plugin load order from 5 (default) to 9 (low priority). The reason is, that there may be other plugins (like *smd_thumbnail*), that uses the callback *image_uploaded* from txp_image.php. Because DropLoader does a PHP exit within that callback, other plugins *must be called before DropLoader*. Otherwise the callback-event is not fired for these plugins.
* Added a new option 'article-image fields', which is a comma separated list of article-image CSS field-id's (default: #article-image). When multiple fields are given, the image-ids's are inserted into all of these fields. Use #custom-n for the article custom fields, where "n" is the field-number.
* Corrected a typo in the textpack: _abl_droploader_prefs_custom_stylesheetb_ renamed to _abl_droploader_prefs_custom_stylesheet_.
* New entry added to the textpack for the new option in the prefs-panel.
* Correction in installation procedure: properly add new options to the prefs. Version 0.16 failed to do that correctly.

h4. Version 0.16 (2013-01-16)

* Enable DropLoader also after editing an image. I forget to change this in 0.15.
* Added two new options for a more flexible UI styling. Option 'use default styles' (default: yes) and 'custom stylesheet' (default: empty) which is a stylesheet (path/filename) of your own. The custom stylesheet will be included _after_ the default stylesheet, if this is also enabled.
* Two entries added to the textpack for the new options in the prefs-panel.
* Added an installation note concerning upgrading DropLoader and browser caching.
* Cleaned up jquery.droploader.js (comments removed)

h4. Version 0.15 (2013-01-07)

* Do not override thumb dimensions on installation if they are already set.
* -Enable DropLoader also after editing an image.-
* Better error handling in JavaScript after upload error.
* Default for option "reload image list after upload" changed to false, because pages may contain post-data.

h4. Version 0.14 (2013-01-02)

* Avoid display of a JSON-String like '{"status": 1,"image_id": 123}', for example after editing a single image.
* Enable DropLoader also on empty image-list (no images, no search result), after doing list operations (multi-edit) and after changing the page-size.
* Better integration with admin themes:
** Avoid overlay of the close-button for the *Hive* admin-theme (Txp 4.5.x).
** Write Tab: Rendering of open-link changed.

h3. Version 0.13 (2012-05-25)

* Installation procedure corrected for international users (see 'Localisation' above).

h3. Version 0.12 (2012-05-22)

* Edit preferences: Show default values (not editable) if soo_plugin_pref is not installed.
* Thumbnail size not set: If thumbnail defaults where never set (e.g. in a fresh Txp-install), DropLoader sets default values (thumb_w/h: 100/100, thumb_crop: 1) for these preferences upon installation.

h3. Version 0.11 (2012-05-21)

* fix for "white screen" if soo_plugin_pref is not installed: Use hard-coded defaults.
* Text of Open trigger changed from DropLoader to Upload Images

h3. Version 0.1 (2012-05-18)

* Initial release
# --- END PLUGIN HELP ---
<?php
}
?>

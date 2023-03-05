CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
    config.colorButton_foreStyle = {
        element: 'font',
        attributes: { 'color': '#(color)' }
    };
    
    config.colorButton_backStyle = {
        element: 'font',
        styles: { 'background-color': '#(color)' }
    };

    config.urlFileManager = _base_url+'/assets/plugin/ckeditor/flmngr/flmngr.php';
    config.urlFiles = _base_url+'/assets/plugin/ckeditor/flmngr/files/';
    config.height = '500px';
	config.removeButtons = 'Save,Preview,NewPage,Print,Select,Textarea,Radio,TextField,ImageButton,HiddenField,Replace,About,ShowBlocks,BGColor,Anchor,Unlink,Language,Button,Checkbox,Indent,Outdent,BidiLtr,BidiRtl,Scayt,Form,Iframe,Flash';
    config.extraPlugins = "N1ED-editor";
    config.apiKey = "F1LRDFLT";
    config.skin = "n1theme";

	// config.removePlugins = 'CreateDiv';

    // // config.removePlugins = "iframe";
};


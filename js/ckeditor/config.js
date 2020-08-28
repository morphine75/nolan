/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'es';
	config.filebrowserUploadMethod  = "form";
	// config.uiColor = '#AADC6E';
};

CKEDITOR.plugins.add('etiquetas',
{
	requires : ['richcombo'],
	init : function( editor )
	{
	//  array of strings to choose from that'll be inserted into the editor
	var strings = [];
	strings.push(['{numero_expediente}', 'Nro. de Expediente', 'Nro. de Expediente']);
	strings.push(['{iniciador}', 'Iniciador', 'Iniciador']);
	strings.push(['{fecha_inicio_expediente}', 'Fecha', 'Fecha']);
	strings.push(['{caratula}', 'Caratula', 'Caratula']);
	strings.push(['{oficio}', 'Oficio', 'Oficio']);
	// add the menu to the editor
	editor.ui.addRichCombo('etiquetas',
	{
		label: 		'Expediente',
		title: 		'Agregar Etiquetas',
		voiceLabel: 'Agregar Etiquetas',
		className: 	'cke_format',
		multiSelect:false,
		panel:
		{
			css: [ editor.config.contentsCss, CKEDITOR.skin.getPath('editor') ],
			voiceLabel: editor.lang.panelVoiceLabel
		},

		init: function()
		{
			this.startGroup( "Etiquetas" );
			for (var i in strings)
			{
				this.add(strings[i][0], strings[i][1], strings[i][2]);
			}
		},

		onClick: function( value )
		{
			editor.focus();
			editor.fire( 'poner_etiqueta' );
			editor.insertHtml(value);
			editor.fire( 'poner_etiqueta' );
		}
	});
}
});

CKEDITOR.plugins.add('etiquetas_ti',
{
	requires1 : ['richcombo'],
	init : function( editor )
	{
	//  array of strings to choose from that'll be inserted into the editor
	var strings = [];
	strings.push(['{numero_ti}', 'Nro. de TI', 'Nro. de TI']);
	strings.push(['{iniciador_ti}', 'Iniciador', 'Iniciador']);
	strings.push(['{fecha_inicio_ti}', 'Fecha', 'Fecha']);
	strings.push(['{caratula_ti}', 'Caratula', 'Caratula']);
	strings.push(['{titulo_ti}', 'Titulo', 'Titulo']);
	// add the menu to the editor
	editor.ui.addRichCombo('etiquetas_ti',
	{
		label: 		'Trátes Int.',
		title: 		'Agregar Etiquetas',
		voiceLabel: 'Agregar Etiquetas',
		className: 	'cke_format',
		multiSelect:false,
		panel:
		{
			css: [ editor.config.contentsCss, CKEDITOR.skin.getPath('editor') ],
			voiceLabel: editor.lang.panelVoiceLabel
		},

		init: function()
		{
			this.startGroup( "Etiquetas" );
			for (var i in strings)
			{
				this.add(strings[i][0], strings[i][1], strings[i][2]);
			}
		},

		onClick: function( value )
		{
			editor.focus();
			editor.fire( 'poner_etiqueta' );
			editor.insertHtml(value);
			editor.fire( 'poner_etiqueta' );
		}
	});
}
});
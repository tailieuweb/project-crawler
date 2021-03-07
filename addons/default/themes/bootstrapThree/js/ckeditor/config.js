/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.removePlugins = 'link,save,print,preview,find,replace,iframe,HiddenField,[Form]';
};
CKEDITOR.config.toolbar_MA=[ ['Source','-','Cut','Copy','Paste','-','Undo','Redo','RemoveFormat','-','Link','Unlink','Anchor','-','Image','Table','HorizontalRule','SpecialChar'], '/', ['Format','Templates','Bold','Italic','Underline','-','Superscript','-',['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],'-','NumberedList','BulletedList','-','Outdent','Indent'] ];

CKEDITOR.config.toolbar_ci = [
    ['Source','-','NewPage','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
    ['SelectAll','-','Scayt'],
    ['NumberedList','BulletedList','Outdent','Indent','Blockquote','-'],
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    ['Maximize','ShowBlocks'],
    ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'],
    ['JustifyLeft','JustifyCenter','JustifyRight','BidiLtr','BidiRtl','CreateDiv'],
    ['Styles'],['Format'],['Font'],['FontSize'],
    ['TextColor','BGColor'],
];
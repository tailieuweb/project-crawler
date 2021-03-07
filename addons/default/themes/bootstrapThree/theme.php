<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Theme_bootstrapThree extends Theme
{


  public $name			= 'Bootstrap 3.0';
  public $version		= '1.0.0';
  public $author		= 'edward';
  public $author_website	= '';
  public $description	= 'Bootstrap 3.0 powered with bootswatch themes ';
  public $website		= 'http://bootswatch.com/';
  public $options 		= array(
  
		'show_breadcrumbs' 	=> array(
			'title'         => 'Do you want to show breadcrumbs?',
			'description'   => 'If selected it shows a string of breadcrumbs at the top of the page.',
			'default'       => 'no',
			'type'          => 'radio',
			'options'       => 'yes=Yes|no=No',
			'is_required'   => TRUE
			
		),
			'bootSwatch_layout' 	=> array(
			'title'         => 'Theme',
			'description'   => 'Choose the default bootstrap.css or select the bootswatch theme that you prefer',
			'default'       => 'bootstrap',
			'type'          => 'select',
			'options'       => 'bootstrap=Default - Bootstrap|amelia=Amelia|cerulean=Cerulean|cosmo=Cosmo|cyborg=Cyborg|flatly=Flatly|journal=Journal|readable=Readable|simplex=Simplex|slate=Slate|spacelab=Spacelab|united=United|yeti=Yeti',
			'is_required'   => TRUE
			
		),
		
		
		
	);
}
/* End of file theme.php */


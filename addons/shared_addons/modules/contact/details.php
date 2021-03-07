<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Contact module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Contact
 */
class Module_Contact extends Module
{

	public $version = '2.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Contact',
			),
			'description' => array(
				'en' => 'Adds a form to your site that allows visitors to send emails to you without disclosing an email address to them.'
			),
			'frontend' => true,
			'backend' => true,
			'menu' => 'content',
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('contact_log');

		$tables = array(
			'contact_log' => array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true,),
				'email' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => '',),
				'subject' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => '',),
				'message' => array('type' => 'TEXT',),
				'sender_agent' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => '',),
				'sender_ip' => array('type' => 'VARCHAR', 'constraint' => 45, 'default' => '',),
				'sender_os' => array('type' => 'VARCHAR', 'constraint' => 255, 'default' => '',),
				'sent_at' => array('type' => 'INT', 'constraint' => 11, 'default' => 0,),
				'attachments' => array('type' => 'TEXT',),
			),
		);

		if ( ! $this->install_tables($tables))
		{
			return false;
		}

		return true;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($old_version)
	{
		return true;
	}

}
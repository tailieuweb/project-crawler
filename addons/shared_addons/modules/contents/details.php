<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Contents extends Module {

    public $version = '2.1';

    public function info() {
        return array(
            'name' => array(
                'en' => 'iTDC Solutions'
            ),
            'description' => array(
                'en' => 'description Contents iTDC'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content',
            'sections' => array(
                'statistic' => array(
                    'name' => 'Statistic',
                    'uri' => 'admin/contents/statistic',
                    'shortcuts' => array(
                         array(
                                 'name' => 'contents:title_manage_sites',
                                 'uri' => 'admin/contents/statistic/manage_sites',
                                 'class' => 'add',
                             ),
                        ),
                ),
                'mapped' => array(
                    'name' => 'Mapped',
                    'uri' => 'admin/contents/mapped',
                ),
                'categories' => array(
                    'name' => 'Categories',
                    'uri' => 'admin/contents/categories',
                    'shortcuts' => array(
                                    array(
                                            'name' => 'contents:title_add_category',
                                            'uri' => 'admin/contents/categories/create',
                                            'class' => 'add',
                                    ),
                        ),
                ),
                'company' => array(
                   'name' => 'Company',
                   'uri' => 'admin/contents/company',
                   'shortcuts' => array(
                                    array(
                                            'name' => 'contents:title_add_company',
                                            'uri' => 'admin/contents/company/create',
                                            'class' => 'add',
                                    ),
                        ),
               ),
                'candidates' => array(
                   'name' => 'Candidates',
                   'uri' => 'admin/contents/candidates',
                   
               ),
                'recruitments' => array(
                   'name' => 'Recruitments',
                   'uri' => 'admin/contents/recruitments',
               ),
                'graduated' => array(
                   'name' => 'Graduated',
                   'uri' => 'admin/contents/graduated',
                   'shortcuts' => array(
                                    array(
                                            'name' => 'contents:title_add_course',
                                            'uri' => 'admin/contents/graduated/create',
                                            'class' => 'add',
                                    ),
                        ),
               ),
                'logs' => array(
                   'name' => 'Logs',
                   'uri' => 'admin/contents/logs',
               ),
                'locations' => array(
                   'name' => 'Locations',
                   'uri' => 'admin/contents/locations',
                   'shortcuts' => array(
                                    array(
                                            'name' => 'contents:title_add_location',
                                            'uri' => 'admin/contents/locations/create',
                                            'class' => 'add',
                                            'id' => 'addLocation',
                                    ),
                        ),
               ),
                'patterns' => array(
                   'name' => 'Patterns',
                   'uri' => 'admin/contents/patterns',
                    'shortcuts' => array(
                                    array(
                                            'name' => 'contents:title_add_patterns',
                                            'uri' => 'admin/contents/patterns/create',
                                            'class' => 'add',
                                    ),
                        ),
               ),
                'crawler' => array(
                   'name' => 'Crawler',
                   'uri' => 'admin/contents/crawler',
               ),
            ),
        );
    }

    public function install() {
        $this->dbforge->drop_table('sample');
        $this->db->delete('settings', array('module' => 'sample'));

        $sample = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            )
        );

        $sample_setting = array(
            'slug' => 'sample_setting',
            'title' => 'Sample Setting',
            'description' => 'A Yes or No option for the Sample module',
            '`default`' => '1',
            '`value`' => '1',
            'type' => 'select',
            '`options`' => '1=Yes|0=No',
            'is_required' => 1,
            'is_gui' => 1,
            'module' => 'sample'
        );

        $this->dbforge->add_field($sample);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('sample') AND
                $this->db->insert('settings', $sample_setting) AND
                is_dir($this->upload_path . 'sample') OR @ mkdir($this->upload_path . 'sample', 0777, TRUE)) {
            return TRUE;
        }
    }

    public function uninstall() {
        $this->dbforge->drop_table('sample');
        $this->db->delete('settings', array('module' => 'sample')); {
            return TRUE;
        }
    }

    public function upgrade($old_version) {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help() {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}

/* End of file details.php */

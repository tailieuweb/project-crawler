<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Contents extends Public_Controller {

    public $keywords = '';

    protected $validation_rules = array(
        'email' => array(
           'field' => 'email',
           'label' => 'Email',
           'rules' => 'trim|text|required|valid_email'
        ),
        'subject' => array(
            'field' => 'subject',
            'label' => 'Subject',
            'rules' => 'trim|htmlspecialchars|required|max_length[200]'
        ),
        
    );
    public function __construct() {
        parent::__construct();

        // Load model
        $this->load->model('contents/pages_news_m');
        $this->load->model('contents/job_m');
        $this->load->model('contents/pages_links_m');
        $this->load->model('contents/work_categories_m');

        // Init template
        $this->template
                ->set_metadata('keyword', $this->keywords)
                ->set_metadata('description', '');
    }

    /**
     * All items
     */
    public function index() {
        // News
        $data = array(
            'news' => array(
                'items' => $this->pages_news_m->get_live('Tin tức'),
                'type' => 'Tin tức - Sự kiện',
                'slug' => 'tin-tuc',
            ),
            'skills' => array(
                'items' => $this->pages_news_m->get_live('Kỹ năng'),
                'type' => 'Kỹ năng',
                'slug' => 'ky-nang',
            ),
            'works' => array(
                'items' => $this->job_m->get_live(JOB_TYPE_WORK),
                'type' => 'Việc làm',
                'slug' => 'viec-lam',
            ),
        );
        $this->template
                ->title('Trung tâm đào tạo nguồn nhân lực & hợp tác doanh nghiệp')
                ->set('data', $data)
                ->build('index');
    }

    public function job($offset = 0) {
        $params = array();
        if ($this->input->get()) {
            $params = array_merge($params, array(
                'id_categories' => $this->input->get('id_categories'),
                'type' => $this->input->get('type')
            ));
        }
        $total_rows = $this->job_m->get_live($params, true);
        $pagination = create_pagination('thong-tin-tuyen-dung', $total_rows, 10, 2);
        $params = array_merge($pagination, $params);
        $jobs = $this->job_m->get_live($params);
        $work_categories = $this->work_categories_m->get_valkeys();
        $this->work_categories_m->find_categories($jobs);
        $this->template
                ->title('Trang thông tin tuyển dung')
                ->set_layout('jobs.html')
                ->set('jobs', $jobs)
                ->set('work_categories', $work_categories)
                ->set('params', $params)
                ->set('heading', 'Trang thông tin tuyển dung')
                ->set('pagination', $pagination)
                ->build('jobs');
    }

    public function news($offset = 0) {
        $params = array(
            'type' => 'Tin tức'
        );
        $total_rows = $this->pages_news_m->count_by(array('type' => $params['type']));
        $pagination = create_pagination('tin-tuc', $total_rows, 10, 2);
        $params = array_merge($pagination, $params);
        $news = $this->pages_news_m->get_live_list($params);
        $this->template
                ->title('Trang tin tức')
                ->set_layout('news.html')
                ->set('news', $news)
                ->set('heading', 'Trang tin tức')
                ->set('pagination', $pagination)
                ->build('news');
    }

    public function event($offset = 0) {
        $params = array(
            'type' => 'Sự kiện'
        );
        $total_rows = $this->pages_news_m->count_by(array('type' => $params['type']));
        $pagination = create_pagination('su-kien', $total_rows, 10, 2);
        $params = array_merge($pagination, $params);
        $news = $this->pages_news_m->get_live_list($params);
        $this->template
                ->title('Trang sự kiện')
                ->set_layout('news.html')
                ->set('news', $news)
                ->set('heading', 'Trang sự kiện')
                ->set('pagination', $pagination)
                ->build('news');
    }

    public function skill($offset = 0) {
        $params = array(
            'type' => 'Kỹ năng'
        );
        $total_rows = $this->pages_news_m->count_by(array('type' => $params['type']));
        $pagination = create_pagination('ky-nang', $total_rows, 10, 2);
        $params = array_merge($pagination, $params);
        $news = $this->pages_news_m->get_live_list($params);
        $this->template
                ->title('Trang kỹ năng')
                ->set_layout('news.html')
                ->set('news', $news)
                ->set('heading', 'Trang kỹ năng')
                ->set('pagination', $pagination)
                ->build('news');
    }

    public function professors() {
        $this->load->model('contents/blogs_m');
        $this->load->model('contents/pages_professors_m');
        // set the pagination limit
        $professors = $this->pages_professors_m->get_live();
        $technologies = $this->blogs_m->get_live_technologies();
        $items_exist = count($technologies) > 0;
        $pagination = create_pagination('chuyen-de', 20, 10, 2);
        $this->template
                ->title('Sắt thép Phú Vương Triều')
                ->set_layout('professors.html')
                ->set('professors', $professors)
                ->set('technologies', $technologies)
                ->set('items_exist', $items_exist)
                ->set('pagination', $pagination)
                ->build('professors');
    }

    public function technologies($offset = 0) {
        $this->load->model('contents/blogs_m');
        $this->load->model('contents/pages_professors_m');
        // set the pagination limit
        $professors = $this->pages_professors_m->get_live();
        $technologies = $this->blogs_m->get_live_technologies($offset);
        $items_exist = count($technologies) > 0;
        $pagination = create_pagination('chuyen-de', $this->blogs_m->get_live_technologies(0, TRUE), 10, 2);
        $this->template
                ->title('Sắt thép Phú Vương Triều')
                ->set_layout('technologies.html')
                ->set('professors', $professors)
                ->set('technologies', $technologies)
                ->set('items_exist', $items_exist)
                ->set('pagination', $pagination)
                ->build('technologies');
    }

    public function view_news($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "tin-tuc/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        $similar_items = $this->pages_m->get_similar_items($page->type_id, $page->entry_id);
        // Setting this so others may use it.
        $this->template->set('page', $page);
        $this->template->set('similar_items', $similar_items);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);

        $this->template
                ->set('heading', 'Tin tức')
                ->set_layout('news.html')
                ->build('view_news');
    }

    public function view_skill($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "ky-nang/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        // Setting this so others may use it.
        $this->template->set('page', $page);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);
        $this->template
                ->set('heading', 'Kỹ năng')
                ->build('view_news');
    }

    public function view_slideshow($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "tin-tuc-noi-bat/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        $similar_items = $this->pages_m->get_similar_items($page->type_id, $page->entry_id);
        // Setting this so others may use it.
        $this->template->set('page', $page);
        $this->template->set('similar_items', $similar_items);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);

        $this->template
                ->set('heading', 'Slideshow')
                ->set_layout('reg.html')
                ->build('view_slideshow');
    }

    public function students($offset = 0) {
        $this->load->model('contents/blogs_m');
        // set the pagination limit
        $items = $this->blogs_m->get_live_blogs(CAT_STUDENT, $offset);
        $head_items = array_slice($items, 0, 2);
        $tail_items = array_slice($items, 2, 7);
        $list_items = array_slice($items, 7, 10);
        // we'll do a quick check here so we can tell tags whether there is data or not
        $items_exist = count($items) > 0;

        // we're using the pagination helper to do the pagination for us. Params are: (module/method, total count, limit, uri segment)
        $pagination = create_pagination('sinh-vien', $this->blogs_m->get_live_blogs(CAT_STUDENT, 0, TRUE), 10, 2);
        $this->template
                ->title($this->module_details['name'], 'the rest of the page title')
                ->set_layout('students.html')
                ->set('head_items', $head_items)
                ->set('tail_items', $tail_items)
                ->set('list_items', $list_items)
                ->set('items_exist', $items_exist)
                ->set('pagination', $pagination)
                ->build('students');
    }

    public function view_event($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "su-kien/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        $similar_items = $this->pages_m->get_similar_items($page->type_id, $page->entry_id);
        // Setting this so others may use it.
        $this->template->set('page', $page);
        $this->template->set('similar_items', $similar_items);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);
        $this->template
                ->set('heading', 'Sự kiện')
                ->build('view_news');
    }

    public function view_work($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "viec-lam/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        $similar_items = $this->pages_m->get_similar_items($page->type_id, $page->entry_id);
        // Setting this so others may use it.
        $this->template->set('page', $page);
        $this->template->set('similar_items', $similar_items);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);
        $this->template
                ->build('view_work');
    }

    public function contact() {
        $this->load->helper('captcha');
        $this->load->model('contact/contact_m');
        //Get data from POST 
        $message = array();
        if (isset($_POST['feedbackSubmit'])) {
            $this->form_validation->set_rules($this->validation_rules);
            if ($this->form_validation->run()) {
                $params = array(
                    'time' => time(),
                    'word' => $this->input->post('captcha_code'),
                    'ip' => $this->input->ip_address(),
                );
                if ($this->contact_m->is_valid_captcha($params, $this->session->cookie->userdata)) {
                    $contact = array_merge($this->input->post(), array(
                        'sent_at' => time(),
                        'status' => REQUEST_NEW,
                        'sender_ip' => $params['ip']
                    ));
                    unset($contact['feedbackSubmit']);
                    unset($contact['captcha_code']);
                    $this->contact_m->insert($contact);
                    $message['status'] = TRUE;
                } else {
                    $message['status'] = FALSE;
                }
            } else {
                $message['status'] = FALSE;
            }
        }
        //
        $captcha = create_captcha($this->contact_m->configs);
        $params = array(
            'time' => $captcha['time'],
            'ip' => $this->input->ip_address(),
            'word' => $captcha['word'],
        );
        $this->session->set_userdata($params);
        $data = array(
            'title' => 'Liên hệ',
            'image' => $captcha['image'],
            'message' => $message
        );
        $this->template
                ->title('Trung Tâm Đào Tạo Nguồn Nhân Lực & Hợp Tác Doanh Nghiệp')
                ->set_layout('contact.html')
                ->set('data', $data)
                ->set('categories', $this->contact_m->categories)
                ->build('contact');
    }

    public function reg() {
        $this->load->helper('captcha');
        $this->load->model('contents/work_candidates_m');
        $this->load->model('contact/contact_m');
        $this->load->model('contact/work_categories_m');
        $this->load->library('session');

        $work_categories = $this->work_categories_m->get_valkeys();
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('id_category', 'id_category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');
        $this->form_validation->set_rules('captcha', 'captcha', 'required');
        
        $message = array();
        $candidates = array();
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run()) {
                $params = array(
                    'time' => time(),
                    'word' => $this->input->post('captcha'),
                    'ip' => $this->input->ip_address(),
                );
                $candidates = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'id_category' => $this->input->post('id_category'),
                    'description' => $this->input->post('description'),
                    'phone' => $this->input->post('phone_number'),
                    'level' => $this->input->post('level'),
                    );
                if ($this->work_candidates_m->is_valid_captcha($params, $this->session->cookie->userdata)) {
                    unset($candidates['submit']);
                    unset($candidates['captcha']);
                    $this->work_candidates_m->insert($candidates);
                    $message['status'] = TRUE;
                    $this->session->set_flashdata('notice', "Success!");
                    $candidates = null;
                } else {
                    $message['status'] = FALSE;
                    $this->session->set_flashdata('notice', "Captcha invalid");
                }
            } else {
                $message['status'] = FALSE;
                $this->session->set_flashdata('notice', "Faild");
                
            }
        }
        //
        $captcha = create_captcha($this->work_candidates_m->configs);
        $params = array(
            'time' => $captcha['time'],
            'ip' => $this->input->ip_address(),
            'word' => $captcha['word'],
        );
        $this->session->set_userdata($params);
        $data = array(
            'title' => 'Liên hệ',
            'image' => $captcha['image'],
            'message' => $message
        );

        $this->template
                ->title('Đăng ký tìm việc')
                ->set_layout('reg.html')
                ->set('candidates', $candidates)
                ->set('work_categories', $work_categories)
                ->set('data', $data)
                ->build('reg');
    }

    public function find() {

        $this->load->helper('captcha');
        $this->load->model('contact/work_categories_m');
        $this->load->model('contents/work_recruitments_m');
        $this->load->model('contact/contact_m');
        $this->load->library('session');
        $work_categories = $this->work_categories_m->get_valkeys();
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('work_name', 'work_name', 'required');
        $this->form_validation->set_rules('id_categories', 'id_categories', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('work_description', 'work_description', 'required');
        $this->form_validation->set_rules('work_count', 'work_count', 'required');
        $this->form_validation->set_rules('work_end', 'work_end', 'required');
        $this->form_validation->set_rules('requirements', 'requirements', 'required');
        $this->form_validation->set_rules('captcha', 'captcha', 'required');
        
        $message = array();
        $recruitments = array();
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run()) {
                $params = array(
                    'time' => time(),
                    'word' => $this->input->post('captcha'),
                    'ip' => $this->input->ip_address(),
                );
                $recruitments = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'id_categories' => $this->input->post('id_categories'),
                    'requirements' => $this->input->post('requirements'),
                    'work_name' => $this->input->post('work_name'),
                    'work_description' => $this->input->post('description'),
                    'work_count' => $this->input->post('work_count'),
                    'work_end' => strtotime($this->input->post('work_end')),
                    );
                if ($this->work_recruitments_m->is_valid_captcha($params, $this->session->cookie->userdata)) {
                    unset($recruitments['submit']);
                    unset($recruitments['captcha']);
                    $this->work_recruitments_m->insert($recruitments);
                    $message['status'] = TRUE;
                    $this->session->set_flashdata('notice', "Success!");
                    $recruitments = null;
                } else {
                     
                    $message['status'] = FALSE;
                    $this->session->set_flashdata('notice', "Captcha invalid");
                }
            } else {
                $message['status'] = FALSE;
                $this->session->set_flashdata('notice', "Faild");
                
            }
        }
        //
        $captcha = create_captcha($this->work_recruitments_m->configs);
        $params = array(
            'time' => $captcha['time'],
            'ip' => $this->input->ip_address(),
            'word' => $captcha['word'],
        );
        $this->session->set_userdata($params);
        $data = array(
            'title' => 'Liên hệ',
            'image' => $captcha['image'],
            'message' => $message
        );
        $this->template
                ->title('Đăng ký tuyển dụng')
                ->set_layout('reg.html')
                ->set('recruitments', $recruitments)
                ->set('work_categories', $work_categories)
                ->set('data', $data)
                ->build('find');
        ///////////////////////////////////////////////////////////
        /**
         * Check form submit
         */
//        $flag = FALSE;
//        $captcha_message = '';
//        $recruitment = '';
//        if (isset($_POST['submit'])) {
//            $this->form_validation->set_rules('company_name', 'company name', 'required');
//            $this->form_validation->set_rules('company_profile', 'company profile', 'required');
//            $this->form_validation->set_rules('work_name', 'work name', 'required');
//            $this->form_validation->set_rules('work_description', 'work description', 'required');
//            $this->form_validation->set_rules('work_requirements', 'work requirements', 'required');
//            $this->form_validation->set_rules('id_categories', 'work categories', 'required');
//            $this->form_validation->set_rules('work_count', 'work count', 'required');
//            $this->form_validation->set_rules('work_expired', 'work expired', 'required');
//            $this->form_validation->set_rules('word', 'captcha', 'required');
//            $recruitment = $this->input->post();
//            if ($this->form_validation->run()) {
//                $params = array(
//                    'time' => time(),
//                    'word' => $this->input->post('word'),
//                    'ip' => $this->input->ip_address(),
//                );
//                if ($this->captcha_model->is_valid_captcha($params, $this->session->userdata)) {
//                    $recruitment = array_merge($recruitment, array(
//                        'posted' => time(),
//                        'status' => REQUEST_NEW,
//                        'id_categories' => implode(',', $recruitment['id_categories']),
//                        'work_expired' => strtotime($recruitment['work_expired'])
//                    ));
//                    $this->recruitments_model->insert($recruitment);
//                    $recruitment = array();
//                    $flag = TRUE;
//                } else {
//                    $captcha_message = 'Invalid captcha';
//                }
//            } else {
//                $flag = FALSE;
//            }
//        } else {
//            $flag = FALSE;
//        }
//        $captcha = create_captcha($this->captcha_model->configs);
//        $params = array(
//            'time' => $captcha['time'],
//            'ip' => $this->input->ip_address(),
//            'word' => $captcha['word'],
//        );
//        $this->session->set_userdata($params);
//        $this->captcha_model->insert($params);
//        $this->captcha_model->delete_invalid_captcha();
//        $data = array_merge($this->data, array(
//            'title' => 'Đăng ký tuyển dụng',
//            'image' => $captcha['image'],
//            'flag' => $flag,
//            'captcha_message' => $captcha_message,
//            'categories' => $this->categories_model->get_valkeys(),
//            'recruitment' => $recruitment
//        ));
//        $this->load->view('templates/layout', $data);
    }

    public function graduated() {

        $this->load->helper('captcha');
        $this->load->model('contents/work_graduated_m');
        $this->load->model('contents/work_courses_m');
        $this->load->model('contact/contact_m');
        $this->load->library('session');
        if ($this->work_courses_m->get_live()) {
            $params['join'] = 'default_work_courses';
        }
//        $this->work_graduated_m->get_live($params);
        $datas = $this->work_graduated_m->get_live($params);
        $this->template
                ->title('Danh sách cựu HSSV')
                ->set_layout('reg.html')
                ->set('datas', $datas)
                ->build('graduated');
//        $this->load->model('students_model');
//        $this->load->model('courses_model');
//        $students = array();
//        if (isset($_GET['sm-list'])) {
//            $course = $this->input->get('course');
//            $params = array(
//                'id_course' => $course['id']
//            );
//            $students = $this->students_model->list_students($params);
//        } else {
//            $students = $this->students_model->list_students();
//        }
//        
//        $data = array_merge($this->data, array(
//            'title' => 'Danh sách sinh viên tốt nghiệp',
//            'courses' => $this->courses_model->list_courses(),
//            'students' => $students,
//            'id_course' => $this->input->get('course')
//        ));
//        $this->load->view("templates/layout", $data);
    }

    public function blog() {

        $this->load->model('contents/pages_news_m');
        $this->load->model('contents/pages_m');
        $params=array();
        $params['type']="Hoạt động cựu HSSV";
        $total_rows = count($this->pages_news_m->get_live($params['type']));
        $pagination = create_pagination('hoat-dong-cuu-hssv', $total_rows, 20, 2);
        $params = array_merge($pagination, $params);
        $datas=$this->pages_news_m->get_live_list($params);
        $this->template
                ->title('Hoạt động cựu HSSV')
                ->set_layout('bloghssv.html')
                ->set('datas', $datas)
                ->set('pagination',$pagination)
                ->build('blog');
    }

    public function survey() {

        $this->template
                ->title('Khảo sát việc làm')
                ->set_layout('reg.html')
//                ->set('datas', $datas)
                ->build('survey');
    }

    public function view_blog($slug = '') {
        $this->load->model('contents/pages_m');
        $url_segments = "hoat-dong-cuu-hssv/$slug";
        // Get our chunks field type if this is an
        // upgraded site.
        if ($this->db->table_exists('page_chunks')) {
            $this->type->load_types_from_folder(APPPATH . 'modules/pages/field_types/', 'pages_module');
        }

        // If we are on the development environment,
        // we should get rid of the cache. That ways we can just
        // make updates to the page type files and see the
        // results immediately.
        if (ENVIRONMENT == PYRO_DEVELOPMENT) {
            $this->pyrocache->delete_all('page_m');
        }

        // GET THE PAGE ALREADY. In the event of this being the home page $url_segments will be null
        $page = $this->page_m->get_by_uri($url_segments, true);
        $similar_items = $this->pages_m->get_similar_items($page->type_id, $page->entry_id);
        // Setting this so others may use it.
        $this->template->set('page', $page);
        $this->template->set('similar_items', $similar_items);

        // If page is missing or not live (and the user does not have permission) show 404
        if (!$page or ( $page->status == 'draft' and ! $this->permission_m->has_role(array('put_live', 'edit_live')))) {
            // Load the '404' page. If the actual 404 page is missing (oh the irony) bitch and quit to prevent an infinite loop.
            if (!($page = $this->pyrocache->model('page_m', 'get_by_uri', array('404')))) {
                show_error('The page you are trying to view does not exist and it also appears as if the 404 page has been deleted.');
            }
        }

        // the home page won't have a base uri
        isset($page->base_uri) OR $page->base_uri = $url_segments;

        // If this is a homepage, do not show the slug in the URL
        if ($page->is_home and $url_segments) {
            redirect('', 'location', 301);
        }
        // If the page is missing, set the 404 status header
        if ($page->slug == '404') {
            $this->output->set_status_header(404);
        }
        // Nope, it is a page, but do they have access?
        elseif ($page->restricted_to) {
            $page->restricted_to = (array) explode(',', $page->restricted_to);

            // Are they logged in and an admin or a member of the correct group?
            if (!$this->current_user or ( isset($this->current_user->group) and $this->current_user->group != 'admin' and ! in_array($this->current_user->group_id, $page->restricted_to))) {
                // send them to login but bring them back when they're done
                redirect('users/login/' . (empty($url_segments) ? '' : implode('/', $url_segments)));
            }
        }

        // We want to use the valid uri from here on. Don't worry about segments passed by Streams or
        // similar. Also we don't worry about breadcrumbs for 404
        if ($url_segments = explode('/', $page->base_uri) and count($url_segments) > 1) {
            // we dont care about the last one
            array_pop($url_segments);

            // This array of parents in the cache?
            if (!$parents = $this->pyrocache->get('page_m/' . md5(implode('/', $url_segments)))) {
                $parents = $breadcrumb_segments = array();

                foreach ($url_segments as $segment) {
                    $breadcrumb_segments[] = $segment;

                    $parents[] = $this->pyrocache->model('page_m', 'get_by_uri', array($breadcrumb_segments, true, true));
                }

                // Cache for next time
                $this->pyrocache->write($parents, 'page_m/' . md5(implode('/', $url_segments)));
            }

            foreach ($parents as $parent_page) {
                $this->template->set_breadcrumb($parent_page->title, $parent_page->uri);
            }
        }

        // If this page has an RSS feed, show it
        if ($page->rss_enabled) {
            $this->template->append_metadata('<link rel="alternate" type="application/rss+xml" title="' . $page->meta_title . '" href="' . site_url(uri_string() . '.rss') . '" />');
        }

        // Set pages layout files in your theme folder
        if ($this->template->layout_exists($page->uri . '.html')) {
            $this->template->set_layout($page->uri . '.html');
        }

        // If a Page Type has a Theme Layout that exists, use it
        if (!empty($page->layout->theme_layout) and $this->template->layout_exists($page->layout->theme_layout)
                // But Allow that you use layout files of you theme folder without override the defined by you in your control panel
                AND ( $this->template->layout_is('default.html') OR $page->layout->theme_layout !== 'default.html')
        ) {
            $this->template->set_layout($page->layout->theme_layout);
        }

        // ---------------------------------
        // Metadata
        // ---------------------------------
        // First we need to figure out our metadata. If we have meta for our page,
        // that overrides the meta from the page layout.
        $meta_title = ($page->meta_title ? $page->meta_title : $page->layout->meta_title);
        $meta_description = ($page->meta_description ? $page->meta_description : $page->layout->meta_description);
        $meta_keywords = '';
        if ($page->meta_keywords or $page->layout->meta_keywords) {
            $meta_keywords = $page->meta_keywords ?
                    Keywords::get_string($page->meta_keywords) :
                    Keywords::get_string($page->layout->meta_keywords);
        }

        $meta_robots = $page->meta_robots_no_index ? 'noindex' : 'index';
        $meta_robots .= $page->meta_robots_no_follow ? ',nofollow' : ',follow';
        // They will be parsed later, when they are set for the template library.
        // Not got a meta title? Use slogan for homepage or the normal page title for other pages
        if (!$meta_title) {
            $meta_title = $page->is_home ? $this->settings->site_slogan : $page->title;
        }

        // Set the title, keywords, description, and breadcrumbs.
        $this->template->title($this->parser->parse_string($meta_title, $page, true))
                ->set_metadata('keywords', $this->parser->parse_string($meta_keywords, $page, true))
                ->set_metadata('robots', $meta_robots)
                ->set_metadata('description', $this->parser->parse_string($meta_description, $page, true))
                ->set_breadcrumb($page->title);

        // Parse the CSS so we can use tags like {{ asset:inline_css }}
        // #foo {color: red} {{ /asset:inline_css }}
        // to output css via the {{ asset:render_inline_css }} tag. This is most useful for JS
        $css = $this->parser->parse_string($page->layout->css . $page->css, $this, true);

        // there may not be any css (for sure after parsing Lex tags)
        if ($css) {
            $this->template->append_metadata('
				<style type="text/css">
					' . $css . '
				</style>', 'late_header');
        }

        $js = $this->parser->parse_string($page->layout->js . $page->js, $this, true);

        // Add our page and page layout JS
        if ($js) {
            $this->template->append_metadata('
				<script type="text/javascript">
					' . $js . '
				</script>');
        }

        // If comments are enabled, go fetch them all
        if (Settings::get('enable_comments')) {
            // Load Comments so we can work out what to do with them
            $this->load->library('comments/comments', array(
                'entry_id' => $page->id,
                'entry_title' => $page->title,
                'module' => 'pages',
                'singular' => 'pages:page',
                'plural' => 'pages:pages',
            ));
        }

        // Get our stream.
        $stream = $this->streams_m->get_stream($page->layout->stream_id);

        // We are going to pre-build this data so we have the data
        // available to the template plugin (since we are pre-parsing our views).
        $template = $this->template->build_template_data();

        // Parse our view file. The view file is nothing
        // more than an echo of $page->layout->body and the
        // comments after it (if the page has comments).
        $html = $this->template->load_view('pages/page', array('page' => $page), false);
        $view = $this->parser->parse_string($html, $page, true, false, array(
            'stream' => $stream->stream_slug,
            'namespace' => $stream->stream_namespace,
            'id_name' => 'entry_id'
        ));

        if ($page->slug == '404') {
            log_message('error', 'Page Missing: ' . $this->uri->uri_string());

            // things behave a little differently when called by MX from MY_Exceptions' show_404()
            exit($this->template->build($view, array('page' => $page), false, false, true, $template));
        }
//        $this->template
//                ->build($view, array('page' => $page), false, false, true, $template);

        $this->template
                ->set('heading', 'Hoạt động cựu HSSV')
                ->set_layout('reg.html')
                ->build('view_news');
    }
    public function webservices() {
        $this->load->model('contents/work_categories_m');
        $this->load->model('contents/all_categories_m');
        $data = $this->work_categories_m->get_categories();
        $this->load->view('webservices',array("data" => $data));
    }
}

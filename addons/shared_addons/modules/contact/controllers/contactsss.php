<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Blog module controller
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Blog\Controllers
 */
class Contact extends Public_Controller
{
	public $stream;

	/**
	 * Every time this controller is called should:
	 * - load the blog and blog_categories models.
	 * - load the keywords library.
	 * - load the blog language file.
	 */
	public function __construct()
	{
//		parent::__construct();
//		$this->load->model('blog_m');
//		$this->load->model('blog_categories_m');
//		$this->load->library(array('keywords/keywords'));
//		$this->lang->load('blog');
//
//		$this->load->driver('Streams');
//
//		// We are going to get all the categories so we can
//		// easily access them later when processing posts.
//		$cates = $this->db->get('blog_categories')->result_array();
//		$this->categories = array();
//	
//		foreach ($cates as $cate)
//		{
//			$this->categories[$cate['id']] = $cate;
//		}
//
//		// Get blog stream. We use this to set the template
//		// stream throughout the blog module.
//		$this->stream = $this->streams_m->get_stream('blog', true, 'blogs');
	}

	/**
	 * Index
	 *
	 * List out the blog posts.
	 *
	 * URIs such as `blog/page/x` also route here.
	 */
	public function index()
	{
//		// Get our comment count whil we're at it.
//		$this->row_m->sql['select'][] = "(SELECT COUNT(id) FROM ".
//				$this->db->protect_identifiers('comments', true)." WHERE module='blog'
//				AND is_active='1' AND entry_key='blog:post' AND entry_plural='blog:posts'
//				AND entry_id=".$this->db->protect_identifiers('blog.id', true).") as `comment_count`";
//
//		// Get the latest blog posts
//		$posts = $this->streams->entries->get_entries(array(
//			'stream'		=> 'blog',
//			'namespace'		=> 'blogs',
//			'limit'			=> Settings::get('records_per_page'),
//			'where'			=> "`status` = 'live'",
//			'paginate'		=> 'yes',
//			'pag_base'		=> site_url('blog/page'),
//			'pag_segment'   => 3
//		));
//
//		// Process posts
//		foreach ($posts['entries'] as &$post)
//		{
//			$this->_process_post($post);
//		}
//
//		// Set meta description based on post titles
//		$meta = $this->_posts_metadata($posts['entries']);
//
//		$data = array(
//			'pagination' => $posts['pagination'],
//			'posts' => $posts['entries']
//		);
//
//		$this->template
//			->title($this->module_details['name'])
//			->set_breadcrumb(lang('blog:blog_title'))
//			->set_metadata('og:title', $this->module_details['name'], 'og')
//			->set_metadata('og:type', 'blog', 'og')
//			->set_metadata('og:url', current_url(), 'og')
//			->set_metadata('og:description', $meta['description'], 'og')
//			->set_metadata('description', $meta['description'])
//			->set_metadata('keywords', $meta['keywords'])
//			->set_stream($this->stream->stream_slug, $this->stream->stream_namespace)
//			->set('posts', $posts['entries'])
//			->set('pagination', $posts['pagination'])
//			->build('posts');
	}
}

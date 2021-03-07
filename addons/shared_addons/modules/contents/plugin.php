<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Plugin_Contents extends Plugin
{
	/**
	 * Item List
	 * Usage:
	 * 
	 * {{ sample:items limit="5" order="asc" }}
	 *      {{ id }} {{ name }} {{ slug }}
	 * {{ /sample:items }}
	 *
	 * @return	array
	 */
	function items()
	{
		$limit = $this->attribute('limit');
		$order = $this->attribute('order');
		
		return $this->db->order_by('name', $order)
						->limit($limit)
						->get('sample_items')
						->result_array();
	}
        public function all_products() {
            $this->load->model('contents/blogs_m');
            $this->load->model('blog/blog_m');
            $this->load->model('blog/blog_categories_m');
            

            $categories = $this->blog_categories_m->get_all();
            $products = array();
            foreach ($categories as $index => $category) {
                $products[$index]['category'] = $category->title;
                $params = array(
			'stream'		=> 'blog',
			'namespace'		=> 'blogs',
			'limit'			=> 6,
			'where'			=> "`status` = 'live' AND `category_id` = '{$category->id}'",
			'paginate'		=> 'yes',
			'pag_segment'	=> 4
		);
                $products[$index]['list'] = $this->streams->entries->get_entries($params);
            }
            foreach ($products as $index =>  $product) {
                foreach ($product['list']['entries'] as $li => $item ) {
                    $products[$index]['list']['entries'][$li]['uri'] = 'blog/' .date('Y/m', $item['created']).'/'.$item['slug'];
                }
            }
            
//            var_dump($products[0]['list']['entries'][0]);
//            die();
            return $products;
        }
        
}

/* End of file plugin.php */
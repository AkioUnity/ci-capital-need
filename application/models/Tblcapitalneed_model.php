<?php 

class Tblcapitalneed_model extends MY_Model {

	public $belongs_to = array(
		'category' => array(
			'model'			=> 'blog_category_model',
			'primary_key'	=> 'category_id'
		),
	);
	
	protected $where = array('UrgencyID is NOT NULL' => NULL);
	protected $order_by = array('ID', 'DESC');
    protected $upload_fields = array('image_url' => UPLOAD_CAPITAL_NEED);
//
	// Append tags
//	protected function callback_after_get($result)
//	{
//		$this->load->model('blog_tag_model', 'tags');
//		$result = parent::callback_after_get($result);
//
//		if ( !empty($result) )
//			$result->tags = $this->tags->get_by_post_id($result->id);
//
//		return $result;
//	}
}
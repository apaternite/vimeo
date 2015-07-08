<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Videos extends Controller {
	
	public function action_index()
	{	
		
		$category = $this->request->query('category');
		$tag = $this->request->query('tag');
		$embed = $this->request->query('embed');
		
		if ($this->request->query('sort') === 'recent' or $this->request->query('sort') === 'best') {
			$sort = $this->request->query('sort');
		} else {
			$sort = 'popular';
		}
		
		if (ctype_digit($this->request->query('per_page')) === false or $this->request->query('per_page') > 50) {
			$perPage = 50;
		} else {
			$perPage = $this->request->query('per_page');
		}
		
		if (ctype_digit($this->request->query('page')) === false or $this->request->query('page') == 0) {
			$page = 0;
		} else {
			$page = $this->request->query('page') - 1;
		}
		
		$videos = ORM::factory('Video');
		
		if ($category) {
			$videos = $videos->join('categories', 'right')->on('video.id', '=', 'video_id')->where('short_name', '=', $category);
		}
		
		if ($tag) {
			$videos = $videos->join('tags', 'right')->on('video.id', '=', 'tags.video_id')->where('tags.name', '=', $tag);
		}
		
		if ($embed === 'true') {
			$videos = $videos->and_where('embeddable', '=', 1);
		}
		
		if ($sort === 'popular') {
			$videos = $videos->order_by('plays', 'DESC');
		} else {
			$videos = $videos->order_by('create_time', 'DESC');
		}
			
		$videos = $videos->limit($perPage)->offset($perPage * $page)->find_all()->as_array();
		
		$i = 0;
		$videosOutputArray = array();
		foreach ($videos as $video) {
			$videosOutputArray[$i]['uri'] = $video->uri;
			$videosOutputArray[$i]['name'] = $video->name;
			$videosOutputArray[$i]['link'] = $video->link;
			$videosOutputArray[$i]['duration'] = $video->duration;
			$videosOutputArray[$i]['plays'] = $video->plays;
			$videosOutputArray[$i]['embed'] = $video->embeddable;
			$i++;
		}
				
		$videosOutputJson = json_encode($videosOutputArray);
		
		$this->response->body($videosOutputJson);
		
	}
	
}
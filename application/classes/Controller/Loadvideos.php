<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Loadvideos extends Controller {
		
	public function action_index()
	{	
		require($_SERVER['DOCUMENT_ROOT'] . "/vimeo/application/vendor/vimeo/autoload.php");
		
		$client_id = '';
		$client_secret = '';
		$token = '';
		$token_secret = '';
		
		$vimeo = new \Vimeo\Vimeo($client_id, $client_secret, $token);

		$categories = $vimeo->request("/categories");
		
		foreach ($categories['body']['data'] as $category) {
			
			// $categoryArray = array('Animation', 'Arts & Design', 'Cameras & Techniques', 'Comedy', 'Documentary', 'Experimental', 'Fashion', 'Food', 'Instructionals', 'Music', 'Narrative', 'Personal', 'Reporting & Journalism', 'Sports', 'Talks');
			// if (in_array($category['name'], $categoryArray)) {
			// 	continue;
			// }
		
			$categoryShortName = str_replace('/categories/', '', $category['uri']);
			
			for ($i = 1; $i <= 20; $i++) {

				sleep(1);
				
				// echo 'page ' . $i . ' of ' . $category['uri'];
				$videos = $vimeo->request($category['uri'] . '/videos', array('sort' => 'plays', 'per_page' => 50, 'page' => $i));
				
				// echo '<pre>'; print_r($videos); echo '</pre>'; exit;
							
				foreach ($videos['body']['data'] as $video) {
								
					// Populate videos table with video data if video is not already in the database
					$videoOrm = ORM::factory('Video')->where('uri', '=', $video['uri'])->find_all()->as_array();
					
					if (sizeOf($videoOrm) === 0) {
						$videoSpecs['uri'] = $video['uri'];
						$videoSpecs['name'] = $video['name'];
						$videoSpecs['description'] = $video['description'];
						$videoSpecs['link'] = $video['link'];
						$videoSpecs['duration'] = $video['duration'];
						$videoSpecs['width'] = $video['width'];
						$videoSpecs['height'] = $video['height'];
						$videoSpecs['create_time'] = $video['created_time'];
						$videoSpecs['plays'] = $video['stats']['plays'];
				
						if ($video['privacy']['embed'] === 'public') {
							$videoSpecs['embeddable'] = true;
						} else {
							$videoSpecs['embeddable'] = false;
						}
								
						$videoRecord = new Model_Video();
						$videoRecord->values($videoSpecs);
						$videoRecord->save();
						
						$videoId = $videoRecord->id;
					
						$videoOrm = ORM::factory('Video')->where('uri', '=', $video['uri'])->find();

						// Populate tags table with video data
						foreach ($video['tags'] as $tag) {
							$tagRecord = new Model_Tag();
							$tagRecord->values(array('video_id' => $videoId, 'name' => $tag['name']));
							$tagRecord->save();
						}
					
					} else {
						$videoId = $videoOrm[0]->id;
					}
					
					// Populate categories table category data if that video and category association is not already stored
					$categoryOrm = ORM::factory('Category')->where('video_id', '=', $videoId)->and_where('short_name', '=', $categoryShortName)->find_all();
					if ($categoryOrm->count() === 0) {
						$categoryRecord = new Model_Category();
						$categoryRecord->values(array('video_id' => $videoId, 'name' => $category['name'], 'short_name' => $categoryShortName));
						$categoryRecord->save();
					}
					
				}
				
			}
			
		}

	}
}
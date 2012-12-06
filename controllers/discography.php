<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Discography extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->driver('Streams');
	}

	public function index()
	{
		$this->albums();
	}

	public function albums()
	{
		$params = array('namespace' => 'discography_albums', 
						'stream' => 'discography_albums',
						'order_by' => 'publication');

		$albums = $this->streams->entries->get_entries($params);

		$this->template->title('Albums')
					->set('albums', $albums)
					->build('index');
	}

	public function album($album_id = 0)
	{
		if (empty($album_id) OR $album_id < 1)
		{
			show_404();
		}
		else
		{
			$album = $this->streams->entries->get_entry($album_id, 'discography_albums', 'discography_albums');

			$params = array('namespace' => 'discography_tracks',
							'stream' => 'discography_tracks',
							'order_by' => 'number',
							'sort' => 'asc',
							'where' => 'album = '.$album_id);

			$tracks = $this->streams->entries->get_entries($params);

			$this->template->title($album->name)
						->set('album', $album)
						->set('tracks', $tracks)
						->build('album');
		}
	}
}

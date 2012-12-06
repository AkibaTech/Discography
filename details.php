<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Discography extends Module {

	public $version = '0.5';

	public function info()
	{
		return array(
			'name' => array(
				'fr' => 'Discographie',
				'en' => 'Discography',
			),
			'description' => array(
				'fr' => 'Gérez une discographie.',
				'en' => 'Manage a discography and his associated tracks.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content',
			'author'   => 'Marceau Casals',
			'sections' => array(
				'albums' => array(
					'name'	=> 'disco:section:albums',
					'uri'	=> 'admin/discography/albums',
					'shortcuts' => array(
						'create' => array(
							'name' 	=> 'disco:shortcut:add_album',
							'uri' 	=> 'admin/discography/albums/create',
							'class' => 'add'
							)
						),
					),
				'tracks' => array(
					'name'   => 'disco:section:tracks',
					'uri' 	 => 'admin/discography/tracks',
					'shortcuts' => array(
						'create' => array(
							'name' 	=> 'disco:shortcut:add_track',
							'uri' 	=> 'admin/discography/tracks/create',
							'class' => 'add'
							)
						)
				)
			)
		);
	}

	public function install()
	{

		$this->load->driver('Streams');

		$this->load->language('discography/discography');

		$this->load->library('files/files');

		$folder = Files::create_folder(0, 'Couvertures Albums');
		$folder_id = $folder['data']['id'];

		if ( !$this->streams->streams->add_stream(lang('disco:stream:albums_desc'), 'discography_albums', 'discography_albums', null, null) )
		{
			return FALSE;
		}

		$fields = array();

		$fields[] = array(
				'name' => 'lang:disco:label:name',
				'slug' => 'name',
				'namespace' => 'discography_albums',
				'type' => 'text',
				'extra' => array('max_lenght' => '64', 'default_value' => 'Artiste - Album'),
				'assign' => 'discography_albums',
				'required' => true,
				'title_column' => true,
				'instructions' => lang('disco:inst:name')

			);

		$fields[] = array(
				'name' => 'lang:disco:label:slug',
				'slug' => 'slug',
				'namespace' => 'discography_albums',
				'type' => 'slug',
				'extra' => array('slug_field' => 'name', 'space_type' => '-'),
				'assign' => 'discography_albums',
				'required' => true,
				'title_column' => false,
				'instructions' => lang('disco:inst:slug')
			);

		$choice_types = "0 : Single\n1 : EP\n2 : Album";

		$fields[] = array(
				'name' => 'lang:disco:label:type',
				'slug' => 'type',
				'namespace' => 'discography_albums',
				'type' => 'choice',
				'extra' => array('choice_data' => $choice_types, 'default_value' => 0, 'choice_type' => 'dropdown'),
				'assign' => 'discography_albums',
				'required' => true,
				'title_column' => false,
				'instructions' => lang('disco:inst:type')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:publication',
				'slug' => 'publication',
				'namespace' => 'discography_albums',
				'type' => 'datetime',
				'extra' => array('use_time' => 'no', 'storage' => 'unix', 'input_type' => 'datepicker'),
				'assign' => 'discography_albums',
				'required' => true,
				'title_column' => false,
				'instructions' => lang('disco:inst:publication')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:description',
				'slug' => 'description',
				'namespace' => 'discography_albums',
				'type' => 'wysiwyg',
				'extra' => array('editor_type' => 'simple'),
				'assign' => 'discography_albums',
				'required' => true,
				'title_column' => false,
				'instructions' => lang('disco:inst:description')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:picture',
				'slug' => 'picture',
				'namespace' => 'discography_albums',
				'type' => 'image',
				'extra' => array('folder' => $folder_id),
				'assign' => 'discography_albums',
				'required' => false,
				'title_column' => false,
				'instructions' => lang('disco:inst:picture')
			);

		$this->streams->fields->add_fields($fields);

		if ( !$this->streams->streams->add_stream(lang('disco:stream:tracks_desc'), 'discography_tracks', 'discography_tracks', null, null) )
		{
			$this->streams->utilities->remove_namespace('discography_albums');
			return FALSE;
		}

		$album = $this->streams->streams->get_stream('discography_albums', 'discography_albums');

		$fields = array();

		$fields[] = array(
				'name' => 'lang:disco:label:title',
				'slug' => 'title',
				'namespace' => 'discography_tracks',
				'type' => 'text',
				'extra' => array('max_lenght' => 64, 'default_value' => 'Nom de la piste'),
				'assign' => 'discography_tracks',
				'required' => true,
				'title_column' => true,
				'instructions' => lang('disco:inst:name')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:number',
				'slug' => 'number', 
				'namespace' => 'discography_tracks',
				'type' => 'integer',
				'extra' => array('max_lenght' => 2, 'default_value' => 1),
				'assign' => 'discography_tracks',
				'required' => true,
				'title_column' => false,
				'instructions' => lang('disco:inst:number')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:album',
				'slug' => 'album', 
				'namespace' => 'discography_tracks',
				'type' => 'relationship',
				'extra' => array('choose_stream' => $album->id),
				'assign' => 'discography_tracks',
				'required' => false,
				'title_column' => false,
				'instructions' => lang('disco:inst:album')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:lyrics',
				'slug' => 'lyrics',
				'namespace' => 'discography_tracks',
				'type' => 'wysiwyg',
				'extra' => array('editor_type' => 'simple'),
				'assign' => 'discography_tracks',
				'required' => false,
				'title_column' => false,
				'instructions' => lang('disco:inst:lyrics')
			);

		$fields[] = array(
				'name' => 'lang:disco:label:clip',
				'slug' => 'clip',
				'namespace' => 'discography_tracks',
				'type' => 'url',
				'assign' => 'discography_tracks',
				'required' => false,
				'title_column' => false,
				'instructions' => lang('disco:inst:clip')
			);

		$this->streams->fields->add_fields($fields);

		return TRUE;
	}

	public function uninstall()
	{
		$this->load->driver('Streams');
		$this->load->library('files/files');

		$this->streams->utilities->remove_namespace('discography_albums');
		$this->streams->utilities->remove_namespace('discography_tracks');

		$folder = ci()->file_folders_m->get_by('slug', 'couvertures-albums');

		if ($folder != false)
		{
			$files = Files::folder_contents($folder->id);
			
			if (count($files) > 0)
			{
				foreach ($files['data']['file'] AS $file)
				{
					Files::delete_file($file->id);
				}
			}

			Files::delete_folder($folder->id);
		}

		return TRUE;
	}


	public function upgrade($old_version)
	{
		return TRUE;
	}

	public function help()
	{
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
/* End of file details.php */

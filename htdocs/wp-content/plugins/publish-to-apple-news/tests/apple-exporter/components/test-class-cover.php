<?php

require_once __DIR__ . '/class-component-testcase.php';

use Apple_Exporter\Components\Cover as Cover;

class Cover_Test extends Component_TestCase {

	public function testGeneratedJSON() {
		$this->settings->set( 'use_remote_images', 'no' );

		$workspace = $this->prophet->prophesize( '\Apple_Exporter\Workspace' );
		// get_file_contents and write_tmp_files must be caleld with the specified params
		$workspace->bundle_source( 'filename.jpg', 'http://someurl.com/filename.jpg' )->shouldBeCalled();

		$component = new Cover( 'http://someurl.com/filename.jpg',
			$workspace->reveal(), $this->settings, $this->styles, $this->layouts );

		$this->assertEquals(
			array(
				'role' => 'container',
				'layout' => 'headerContainerLayout',
				'style' => array(
					'fill' => array(
						'type' => 'image',
						'URL' => 'bundle://filename.jpg',
						'fillMode' => 'cover',
					),
				),
				'behavior' => array(
					'type' => 'background_parallax',
				),
			),
			$component->to_array()
		);
	}

	public function testGeneratedJSONRemoteImages() {
		$this->settings->set( 'use_remote_images', 'yes' );
		$workspace = $this->prophet->prophesize( '\Apple_Exporter\Workspace' );
		// get_file_contents and write_tmp_files must be caleld with the specified params
		$workspace->bundle_source( 'filename.jpg', 'http://someurl.com/filename.jpg' )->shouldNotBeCalled();

		$component = new Cover( 'http://someurl.com/filename.jpg',
			$workspace->reveal(), $this->settings, $this->styles, $this->layouts );

		$this->assertEquals(
			array(
				'role' => 'container',
				'layout' => 'headerContainerLayout',
				'style' => array(
					'fill' => array(
						'type' => 'image',
						'URL' => 'http://someurl.com/filename.jpg',
						'fillMode' => 'cover',
					),
				),
				'behavior' => array(
					'type' => 'background_parallax',
				),
			),
			$component->to_array()
		);
	}


	public function testFilter() {
		$this->settings->set( 'use_remote_images', 'no' );

		$workspace = $this->prophet->prophesize( '\Apple_Exporter\Workspace' );
		// get_file_contents and write_tmp_files must be caleld with the specified params
		$workspace->bundle_source( 'filename.jpg', 'http://someurl.com/filename.jpg' )->shouldBeCalled();

		$component = new Cover( 'http://someurl.com/filename.jpg',
			$workspace->reveal(), $this->settings, $this->styles, $this->layouts );

		add_filter( 'apple_news_cover_json', function( $json ) {
			$json['behavior']['type'] = 'background_motion';
			return $json;
		} );

		$this->assertEquals(
			array(
				'role' => 'container',
				'layout' => 'headerContainerLayout',
				'style' => array(
					'fill' => array(
						'type' => 'image',
						'URL' => 'bundle://filename.jpg',
						'fillMode' => 'cover',
					),
				),
				'behavior' => array(
					'type' => 'background_motion',
				),
			),
			$component->to_array()
		);
	}

}


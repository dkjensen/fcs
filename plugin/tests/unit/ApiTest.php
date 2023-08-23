<?php
/**
 * Class ApiTest
 *
 * @package Dkjensen\FCS
 */

use \PHPUnit\Framework\TestCase;

/**
 * API test case.
 */
class ApiTest extends TestCase
{

	protected $data = '{"title":"This amazing table","data":{"headers":["ID","First Name","Last Name","Email","Date"],"rows":[{"id":66,"fname":"Chris","lname":"Test","email":"chris@test.com","date":1692881546},{"id":12,"fname":"Bob","lname":"Test","email":"bob@test.com","date":1692795146},{"id":33,"fname":"Bill","lname":"Test","email":"bill@test.com","date":1693636946},{"id":54,"fname":"Jack","lname":"Test","email":"jack@test.com","date":1694091146},{"id":92,"fname":"Joe","lname":"Test","email":"joe@test.com","date":1693227146}]}}';

	protected function setUp(): void
	{
		delete_transient('fcs_challenge_response');
	}

	public function test_challenge_response_value()
	{
		$provider = $this->getMockBuilder('\Dkjensen\FCS\Provider')
			->getMock();

		$body = $this->data;

		$response = [
			'response' => [
				'code' => 200
			],
			'body' => $body
		];

		$provider->expects($this->once())
			->method('get_request')
			->willReturn($response);

		$api = new Dkjensen\FCS\Adapter($provider);

		$challenge = $api->get_challenge_response();

		$this->assertEquals(json_decode($body, true), $challenge);

		// Check that transient was stored so the API is not called again
		$this->assertNotFalse(get_transient('fcs_challenge_response'));

		delete_transient('fcs_challenge_response');

		$this->assertFalse(get_transient('fcs_challenge_response'));
	}

	public function test_table_display()
	{
		$provider = $this->getMockBuilder('\Dkjensen\FCS\Provider')
			->getMock();

		$body = $this->data;

		$response = [
			'response' => [
				'code' => 200
			],
			'body' => $body
		];

		$provider->expects($this->once())
			->method('get_request')
			->willReturn($response);

		$api = new Dkjensen\FCS\Adapter($provider);

		$challenge = $api->get_challenge_response();

		$root = Dkjensen\FCS\Models\Root::fromJson($challenge);

		$this->assertNotNull($root->get_title());
		$this->assertNotEmpty($root->get_data()->get_headers());
		$this->assertEquals(5, count($root->get_data()->get_rows()));
	}
}
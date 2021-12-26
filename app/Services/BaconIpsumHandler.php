<?php

namespace App\Services;

use App\Models\Comparison;
use App\Services\BaseApiHandler;

class BaconIpsumHandler extends BaseApiHandler
{
	public function __construct()
	{
		parent::__construct('https://baconipsum.com/api');
	}

	public function getBacon(array $params = ['type' => 'meat-and-filler']): ?array
	{
		$data = $this->client->get('', $params);

		return $this->returnResponse($data);
	}

	public function getBaconString(): string
	{
		$data = $this->client->get('', [
			'type' => 'meat-and-filler',
			'sentences' => 1,
			'start-with-lorem' => 1,
		]);

		return $this->returnResponse($data)[0];
	}

	public function persistResultToDatabase(array $comparisonData)
	{
		return Comparison::create($comparisonData);
	}
}

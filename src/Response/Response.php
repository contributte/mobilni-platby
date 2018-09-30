<?php declare(strict_types = 1);

namespace Contributte\MobilniPlatby\Response;

use Contributte\MobilniPlatby\ResponseException;
use Nette;

class Response extends AbstractResponse
{

	/** @var string|null */
	private $text;

	/** @var int|null */
	private $level;

	public function __construct(?string $text = null, ?int $level = null)
	{
		$this->text = $text;
		$this->level = $level;
	}

	public function setLevel(int $level): Response
	{
		$this->level = $level;
		return $this;
	}

	public function getLevel(): ?int
	{
		return $this->level;
	}

	public function setText(string $text): Response
	{
		$this->text = $text;
		return $this;
	}

	public function getText(): ?string
	{
		return $this->text;
	}

	/**
	 * @throws ResponseException
	 */
	public function getResponse(): string
	{
		$text = $this->getText();
		$level = $this->getLevel();

		if (!empty($text) && !empty($level) && $text !== null && $level !== null) {
			return $text . ';' . $level;
		} elseif (!empty($text)) {
			return $text;
		} else {
			throw new ResponseException('Response: You have to specified text or text and level.');
		}
	}

	public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
	{
		$response = $this->getResponse();
		$httpResponse->setCode(200);
		$httpResponse->setContentType('text/plain');
		$httpResponse->setHeader('Content-Length', strlen($response));

		echo $response;
	}

}

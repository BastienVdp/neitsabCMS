<?php 

namespace App\Core;

class Config
{
	protected array $settings = [];

	public function __construct()
	{
		$files = scandir(Application::$rootDir . '/config');

		foreach ($files as $file) {
			if ($file === '.' || $file === '..') {
				continue;
			}

			$key = str_replace('.php', '', $file);
			$this->settings[$key] = require Application::$rootDir . "/config/$file";
		}

	}

	public function get(string $key, $default = null)
	{
		return $this->settings[$key] ?? $default;
	}

	public function set(string $key, $value)
	{
		$this->settings[$key] = $value;
	}

	public function all()
	{
		return $this->settings;
	}

	public function has(string $key)
	{
		return isset($this->settings[$key]);
	}
}
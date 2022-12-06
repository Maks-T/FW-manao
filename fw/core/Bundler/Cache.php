<?php

declare(strict_types=1);

namespace FW\Core\Bundler;

class Cache
{
  private bool $isFilesUpdated = false;

  private array $cachedData = [];

  private string $fileCachePath;

  public function __construct(string $fileNameCache, string $cacheDir = ROOT_CACHE)
  {
    $this->fileNameCache = $fileNameCache;
    $this->fileCachePath = $cacheDir . $fileNameCache;

    if (file_exists($this->fileCachePath)) {
      $this->cachedData = json_decode(file_get_contents($this->fileCachePath), true);
    } else {
      $this->isFilesUpdated = true;
    }
  }

  public function addFile(string $key, string $filePath)
  {
    if (
      !$this->isFilesUpdated &&
      !empty($this->cachedData[$key]) &&
      $this->cachedData[$key]['filePath'] === $filePath &&
      $this->cachedData[$key]['mtime'] === stat($filePath)['mtime']
    ) {
      return;
    }

    $this->cachedData[$key] = [
      'filePath' => $filePath,
      'mtime' => stat($filePath)['mtime']
    ];

    $this->isFilesUpdated = true;
  }

  public function saveCache(string $bundleFileName): string
  {
    if ($this->isFilesUpdated)
    {
      $previousBandleFilePath = $this->cachedData['bundleFileName'] ?? '';

      $this->cachedData['bundleFileName'] = $bundleFileName;
      file_put_contents($this->fileCachePath, json_encode($this->cachedData));

      return $previousBandleFilePath;
    }

    return $bundleFileName;
  }

}
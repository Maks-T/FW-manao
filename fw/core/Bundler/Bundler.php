<?php

declare(strict_types=1);

namespace FW\Core\Bundler;

class Bundler
{
  private array $fileNames = [];

  private string $bundleDir;

  private string $nameMaskBundleFile;

  private string $typeFile;

  private string $bundleFileName;

  private string $content = '';

  private Cache $cache;

  public function __construct(string $bundleDir, string $nameMaskBundleFile, string $typeFile)
  {
    $this->bundleDir = $bundleDir;
    $this->nameMaskBundleFile = $nameMaskBundleFile;
    $this->typeFile = $typeFile;

    $this->bundleFileName = $this->nameMaskBundleFile . time() . '.' . $this->typeFile;

    $this->cache = new Cache($this->typeFile);
  }

  public function addFile(string $key, string $fileName)
  {
    $this->cache->addFile($key, $fileName);
    $this->fileNames[$key] = $fileName;
  }

  public function bundle()
  {
    $bundleFileName = $this->cache->saveCache($this->bundleFileName);

    $previousBandleFilePath = $this->bundleDir . $bundleFileName;

    if ($bundleFileName === $this->bundleFileName) {

      //удалить предыдущую сборку
      if (file_exists($previousBandleFilePath)) {
        unlink($previousBandleFilePath);
      }

      foreach ($this->fileNames as $fileName) {
        try {
          if (!file_exists($fileName)) {
            throw new \Exception("Файл $fileName не существует");
          }

          $this->content .= file_get_contents($fileName);

          if (!file_put_contents($this->bundleDir . $this->bundleFileName, $this->content)) {
            throw new \Exception("Файл $this->bundleFileName не создан");
          }
        } catch (\Exception $e) {
          echo $e->getMessage();
        }
      }
      return;
    }

    $this->bundleFileName = $bundleFileName;
  }

  public function getBundleFileName()
  {
    return $this->bundleFileName;
  }

}
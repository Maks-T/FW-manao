<?php

declare(strict_types=1);

namespace FW\Core\Bundler;

class Bundler
{
  /**
   * @var array $fileNames пути к файлам для сборки
   */
  private array $fileNames = [];
  /**
   * @var string $bundleDir имя директории сборки
   */
  private string $bundleDir;

  /**
   * @var string $nameMaskBundleFile маска файла сборки
   */
  private string $nameMaskBundleFile;

  /**
   * @var string $typeFile тип файла (js, css, ...)
   */
  private string $typeFile;

  /**
   * @var string $bundleFileName имя файла сборки
   */
  private string $bundleFileName;

  /**
   * @var Cache $cache экземляра класса для работы с кешированием
   */
  private Cache $cache;

  /**
   * @var string содержимое файлов для сборки
   */
  private string $content = '';

  /**
   * @param string $bundleDir имя директории сборки
   * @param string $nameMaskBundleFile маска файла сборки
   * @param string $typeFile тип файла (js, css, ...)
   */
  public function __construct(string $bundleDir, string $nameMaskBundleFile, string $typeFile)
  {
    $this->bundleDir = $bundleDir;
    $this->nameMaskBundleFile = $nameMaskBundleFile;
    $this->typeFile = $typeFile;

    $this->bundleFileName = $this->nameMaskBundleFile . time() . '.' . $this->typeFile;

    $this->cache = new Cache($this->typeFile);
  }

  /**
   * @param string $key ключ для кеширования (имя компонента)
   * @param string $filePath путь к отслеживаемому файлу
   * @return void
   */
  public function addFile(string $key, string $filePath)
  {
    $this->cache->addFile($key, $filePath);
    $this->fileNames[$key] = $filePath;
  }

  /**
   * Собрать и сохранить файл если кеш изменен
   * @return void
   */
  public function bundle(): void
  {
    $fileNamePrevBundle = $this->cache->getFileNamePrevBundle();

    //если данные о файлах обновились и закешировались
    if ($this->cache->saveCache($this->bundleFileName)) {

      //удалить предыдущую сборку     
      if ($fileNamePrevBundle && file_exists($this->bundleDir . $fileNamePrevBundle)) {

        unlink($this->bundleDir . $fileNamePrevBundle);
      }

      foreach ($this->fileNames as $filePath) {
        try {
          if (!file_exists($filePath)) {
            throw new \Exception("Файл $filePath не существует");
          }

          $this->content .= file_get_contents($filePath);

          if (!file_put_contents($this->bundleDir . $this->bundleFileName, $this->content)) {
            throw new \Exception("Файл $this->bundleFileName не создан");
          }
        } catch (\Exception $e) {
          echo $e->getMessage();
        }
      }
      return;
    }

    if ($fileNamePrevBundle) {
      $this->bundleFileName = $fileNamePrevBundle;
    }

  }

  /**
   * Вернуть имя файла сборки для добавления на страницу
   * @return string
   */
  public function getBundleFileName(): string
  {
    return $this->bundleFileName;
  }

}
<?php

declare(strict_types=1);

namespace FW\Core\Bundler;

class Cache
{
  /**
   * @var bool $isFilesUpdated если хоть один из файлов изменился
   */
  private bool $isFilesUpdated = false;

  /**
   * @var array $cachedData массив закешированных данных о файлах
   */
  private array $cachedData = [];

  /**
   * @var string $fileCachePath путь к файлу кеша
   */
  private string $fileCachePath;

  /**
   * @var string|null $fileNamePrevBundle имя предыдущей сборки
   */
  private ?string $fileNamePrevBundle = null;

  /**
   * @param string $fileNameCache имя файла кеша
   * @param string $cacheDir директория файла кеша
   */
  public function __construct(string $fileNameCache, string $cacheDir = ROOT_CACHE)
  {
    $this->fileCachePath = $cacheDir . $fileNameCache;

    if (file_exists($this->fileCachePath)) {
      $this->cachedData = json_decode(file_get_contents($this->fileCachePath), true);
    } else {
      $this->isFilesUpdated = true;
    }

    if (isset($this->cachedData['bundleFileName'])) {
      $this->fileNamePrevBundle = $this->cachedData['bundleFileName'];
    }
  }

  /**
   * Отслеживает файл и кеширует
   * @param string $key ключ (имя компонента)
   * @param string $filePath путь к отслеживаемому файлу
   * @return void
   */
  public function addFile(string $key, string $filePath): void
  {
    //Если файлы не были изменены, то ничего неделать
    if (
      !$this->isFilesUpdated &&
      !empty($this->cachedData[$key]) &&
      $this->cachedData[$key]['filePath'] === $filePath &&
      $this->cachedData[$key]['mtime'] === stat($filePath)['mtime']
    ) {
      return;
    }

    //иначе добавить данные о файле в кеш
    $this->cachedData[$key] = [
      'filePath' => $filePath,
      'mtime' => stat($filePath)['mtime']
    ];

    $this->isFilesUpdated = true;
  }

  /**
   * Закешировать данные о файлах если файлы изменены
   * @param string $bundleFileName имя файла сборки
   * @return bool вернуть true, если кеш обновился
   */
  public function saveCache(string $bundleFileName): bool
  {
    if ($this->isFilesUpdated) {
      $this->cachedData['bundleFileName'] = $bundleFileName;
      file_put_contents($this->fileCachePath, json_encode($this->cachedData));
      return true;
    }

    return false;
  }

  /**
   * @return string|null вернуть имя файла предущей сборки если такая есть
   */
  public function getFileNamePrevBundle()
  {
    return $this->fileNamePrevBundle;
  }

}
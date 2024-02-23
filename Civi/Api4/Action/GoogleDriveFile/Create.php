<?php
namespace Civi\Api4\Action\GoogleDriveFile;

use Civi\Api4\Action\Action;
use Civi\Api4\Action\Generic;
use Civi\Api4\Generic\BasicCreateAction;
use Civi\Api4\Utils\GoogleDriveTrait;

class Create extends BasicCreateAction {
  use GoogleDriveTrait;

  protected function writeRecord($item) {
    if (!empty($item['file_id'])) {
      $file = \Civi\Api4\File::get()
        ->addSelect('uri')
        ->addWhere('id', '=', $item['file_id'])
        ->execute()
        ->single();
      $path = \CRM_Core_Config::singleton()->customFileUploadDir . $file['uri'];
      $content = file_get_contents($path);
    }
    else if (!empty($item['file_base64'])) {
      $content = base64_decode($item['file_base64']);
    }
    if (empty($content)) {
      throw new \Exception('No file provided');
    }
    $service = $this->getDriveService($item);
    $fileMetadata = new \Google\Service\Drive\DriveFile([
      'name' => $item['name'],
      'parents' => $item['parents'],
    ]);
    $file = $service->files->create($fileMetadata, [
      'data' => $content,
      'mimeType' => $item['mime_type'],
      'uploadType' => 'multipart',
      'fields' => 'id,webViewLink,webContentLink'
    ]);
    $this->addFileToResponse($file, $item);
    return $item;
  }

}

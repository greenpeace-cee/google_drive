<?php

namespace Civi\Api4\Utils;

use Google\Client;
use Google\Service\Drive\DriveFile;

trait GoogleDriveTrait {
  protected function getDriveService(array $item) {
    $token = \Civi\Api4\OAuthSysToken::refresh()
      ->addWhere('id', '=', $item['token_id'])
      ->execute()
      ->single();
    $client = new Client();
    $client->setConfig('retry', ['retries' => 2]);
    $client->addScope(\Google\Service\Drive::DRIVE);
    $client->setAccessToken($token['access_token']);
    return new \Google\Service\Drive($client);
  }

  protected function addFileToResponse(DriveFile $file, array &$item) {
    $item['id'] = $file->getId();
    $item['web_content_link'] = $file->getWebContentLink();
    $item['web_view_link'] = $file->getWebViewLink();
  }

}
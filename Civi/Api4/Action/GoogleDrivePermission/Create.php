<?php
namespace Civi\Api4\Action\GoogleDrivePermission;

use Civi\Api4\Action\Action;
use Civi\Api4\Action\Generic;
use Civi\Api4\Generic\BasicCreateAction;
use Civi\Api4\Utils\GoogleDriveTrait;

class Create extends BasicCreateAction {
  use GoogleDriveTrait;

  protected function writeRecord($item) {
    $expiration = NULL;
    if (!empty($item['expiration'])) {
      $expiration = date('c', strtotime($item['expiration']));
    }
    $userPermission = new \Google\Service\Drive\Permission([
      'type' => $item['type'],
      'role' => $item['role'],
      'emailAddress' => $item['email'] ?? NULL,
      'domain' => $item['domain'] ?? NULL,
      'expirationTime' => $expiration,
    ]);
    $service = $this->getDriveService($item);
    $service->permissions->create(
      $item['id'],
      $userPermission,
      [
        'fields' => 'id',
        'sendNotificationEmail' => $item['send_notification_email'] ?? FALSE,
      ]
    );
    return $item;
  }

}

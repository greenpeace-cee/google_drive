<?php

namespace Civi\Api4;

class GoogleDriveFile extends Generic\AbstractEntity {

  public static function getFields($checkPermissions = TRUE) {
    $action = new Generic\BasicGetFieldsAction('GoogleDriveFile', __FUNCTION__, function () {
      return [
        [
          'name' => 'token_id',
          'required' => TRUE,
          'data_type' => 'Integer',
          'fk_entity' => 'OAuthSysToken',
        ],
        [
          'name' => 'parents',
          'required' => TRUE,
          'data_type' => 'Array',
          'description' => 'Parent directory IDs in which this file should be placed',
        ],
        [
          'name' => 'mime_type',
          'required' => TRUE,
          'data_type' => 'String',
          'description' => '',
        ],
        [
          'name' => 'file_base64',
          'data_type' => 'String',
          'description' => '',
        ],
        [
          'name' => 'file_id',
          'data_type' => 'Integer',
          'description' => '',
          'fk_entity' => 'File',
        ],
      ];
    });
    return $action->setCheckPermissions($checkPermissions);
  }

  public static function create($checkPermissions = TRUE) {
    $action = new \Civi\Api4\Action\GoogleDriveFile\Create(static::class, __FUNCTION__);
    return $action->setCheckPermissions($checkPermissions);
  }

}

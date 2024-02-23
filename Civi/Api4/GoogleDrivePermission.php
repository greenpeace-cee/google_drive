<?php

namespace Civi\Api4;

class GoogleDrivePermission extends Generic\AbstractEntity {

  public static function getFields($checkPermissions = TRUE) {
    $action = new Generic\BasicGetFieldsAction('GoogleDrivePermission', __FUNCTION__, function () {
      return [
        [
          'name' => 'token_id',
          'required' => TRUE,
          'data_type' => 'Integer',
          'fk_entity' => 'OAuthSysToken',
        ],
        [
          'name' => 'id',
          'required' => TRUE,
          'data_type' => 'String',
          'description' => 'Google Drive File ID',
        ],
        [
          'name' => 'type',
          'required' => TRUE,
          'data_type' => 'String',
          'description' => '',
          'options'  => [
            'user' => ts('user: Permissions for a specific user'),
            'group' => ts('group: Permissions for a specific group'),
            'domain' => ts('domain: Permissions for a specific domain'),
            'anyone' => ts('anyone: Permissions for anyone with the link'),
          ],
        ],
        [
          'name' => 'role',
          'required' => TRUE,
          'data_type' => 'String',
          'description' => '',
          'options'  => [
            'owner' => ts('owner: Grant ownership'),
            'organizer' => ts('organizer: Grant organizer permissions'),
            'fileOrganizer' => ts('fileOrganizer: Grant fileOrganizer permissions'),
            'writer' => ts('writer: Grant writer permissions'),
            'commenter' => ts('commenter: Grant commenter permissions'),
            'reader' => ts('reader: Grant reader permissions'),
          ],
        ],
        [
          'name' => 'email',
          'data_type' => 'String',
          'description' => 'Email of user or group the permission relates to',
        ],
        [
          'name' => 'domain',
          'data_type' => 'String',
          'description' => 'Name of the domain the permission relates to (for type domain)',
        ],
        [
          'name' => 'expiration',
          'data_type' => 'Date',
          'description' => 'Time at which the permission expires. Can only be set on user and group permissions and cannot be more than a year in the future.',
        ],
        [
          'name' => 'send_notification_email',
          'data_type' => 'Boolean',
          'default' => FALSE,
          'description' => 'Whether to send a notification email',
        ],
      ];
    });
    return $action->setCheckPermissions($checkPermissions);
  }

  public static function create($checkPermissions = TRUE) {
    $action = new \Civi\Api4\Action\GoogleDrivePermission\Create(static::class, __FUNCTION__);
    return $action->setCheckPermissions($checkPermissions);
  }

}

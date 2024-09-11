<?php

require_once 'google_drive.civix.php';
require_once __DIR__ . '/vendor/autoload.php';

use CRM_GoogleDrive_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function google_drive_civicrm_config(&$config): void {
  _google_drive_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function google_drive_civicrm_install(): void {
  _google_drive_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function google_drive_civicrm_enable(): void {
  _google_drive_civix_civicrm_enable();
}

function google_drive_civicrm_oauthProviders(&$providers) {
  $providers['google_drive'] = [
    'name' => 'google_drive',
    'title' => 'Google Drive',
    'class' => 'League\OAuth2\Client\Provider\Google',
    'options' => [
      'urlAuthorize' => 'https://accounts.google.com/o/oauth2/v2/auth',
      'urlAccessToken' => 'https://www.googleapis.com/oauth2/v4/token',
      'urlResourceOwnerDetails' => 'https://openidconnect.googleapis.com/v1/userinfo',
      'accessType' => 'offline',
      'scopeSeparator' => ' ',
      'scopes' => ['https://www.googleapis.com/auth/drive'],
      'prompt' => 'select_account consent',
    ]
  ];
}

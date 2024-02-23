# google_drive

`google_drive` is a CiviCRM API4 wrapper for [Google's Drive API](https://developers.google.com/drive/api/guides/about-sdk).

This is an [extension for CiviCRM](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/), licensed under [AGPL-3.0](LICENSE.txt).

## Getting Started

This extension uses the `oauth-client` core extension and adds a
new `google_drive` OAuth provider. To get started, you need to
configure a new OAuth client/token based on this provider within the
`oauth-client` extension. Please refer to the [CiviCRM documentation on OAuth](https://docs.civicrm.org/sysadmin/en/latest/setup/oauth/)
for details.

Once you have set up your OAuth token, you can use the API4 endpoints
provided by this extension to interact with Google Drive. Currently,
this extension supports the following APIs:
- `GoogleDriveFile.create`: Upload a file based on a `File` record
  in CiviCRM or the base64-encoded contents of a file.
- `GoogleDrivePermission.create`: Share a file with users, groups, whole domains or anyone with the link to the file.

The following example shows how to upload a file to Google Drive
and then share it with a specific email address via API chaining:

```php
$results = \Civi\Api4\GoogleDriveFile::create(FALSE)
  ->addValue('token_id', 1) // ID of the OAuth Token from the setup process
  ->addValue('parents', [
    '12345_aBcDeFgHiLmNoPqRsT6789', // Parent folder(s) in Google Drive. Can be obtained using Google Drive's Web UI.
  ])
  ->addValue('mime_type', 'application/pdf')
  ->addValue('file_id', 1) // ID of the CiviCRM File entity you wish to upload. file_base64 is also supported as an alternative
  ->addChain('drive_permission', \Civi\Api4\GoogleDrivePermission::create(TRUE)
    ->addValue('id', '$id')
    ->addValue('token_id', 1)
    ->addValue('type', 'user')
    ->addValue('role', 'writer')
    ->addValue('email', 'example@example.com')
  )
  ->execute();
```

For more details on available parameters and values, please refer to the API
documentation available in the API Explorer.

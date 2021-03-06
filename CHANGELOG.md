# Changelog

All Notable changes to `Dandomain Pay PHP SDK` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.
## 2.0.0 - 2017-10-25
v2 is mostly a refactoring of v1. The checksum helper method has been put in the `Helper\ChecksumHelper` and the `Payment` and `PaymentLine` objects has been moved to the `Model` namespace.

Also when you want to create a `Payment` from a `ServerRequestInterface` you just call the `Payment::createFromRequest` method.

## 1.0.0 - 2017-08-25

### Added
- Logic to populate payment request
- Helper methods to get checksums
- Helper method to verify checksum

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing

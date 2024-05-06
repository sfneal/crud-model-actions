# Changelog

All notable changes to `crud-model-actions` will be documented in this file

## 0.1.0 - 2020-08-20
- initial release


## 0.1.1 - 2020-08-20
- fix executing of fireEvent method to be optional


## 0.2.0 - 2020-09-08
- fix composer.json to allow for laravel/framework:8.0


## 0.2.1 - 2020-09-14
- fix issues using with laravel 8


## 0.2.2 - 2020-09-14
- fix composer requirements to be less strict


## 0.3.0 - 2020-10-06
- add support for php 7.0 & 7.1


## 0.3.1 - 2020-10-07
- fix laravel/framework version requirement
- bump sfneal/models version requirement


## 0.4.0 - 2020-10-08
- add support for php8


## 0.5.0 - 2020-11-17
- add config file with TrackingEvent settings


## 0.5.1 - 2020-11-17
- fix config file path in ServiceProvider


## 0.5.2 - 2020-11-18
- add boot method to ServiceProvider to fix resource publishing


## 0.5.3 - 2020-11-18
- fix ServiceProvider config path


## 0.5.4 - 2020-12-01
- fix min phpunit version


## 0.5.5 - 2020-12-04
- fix Travis CI config by disabling xdebug 3


## 0.6.0 - 2020-12-11
- add support for php8


## 0.7.0 - 2021-03-17
- cut support for php7.2 & below
- bump min sfneal/laravel-helpers version to 2.0
- fix use of `isEnvironmentDevelopment()` to `AppInfo::isEnvDevelopment()`
- bump sfneal/actions, sfneal/js-response-helpers & sfneal/models package min version to 1.0


## 0.8.0 - 2021-03-24
- refactor `getModelShortName()` so that a properly spaced string is returned
- bump sfneal/models min version to 1.3 to support use of `ResolveModelName` action
- make ResolveModelName action for retrieving a Model's short name for use in logging & message flashes


## 0.8.1 - 2021-03-30
- fix sfneal packages version syntax
- fix Travis CI config to enable code coverage uploads


## 0.9.0 - 2021-03-31
- bump min sfneal/actions version to 2.0
- fix return type hinting in `CrudModelAction::execute()` method


## 0.10.0 - 2021-04-05
- bump sfneal/observables min version to ^1.0


## 0.11.0 - 2021-04-05
- bump sfneal/models to v2.0
- refactor use of `AbstractModel` to `Model`


## 0.12.0 - 2021-06-08
- refactor `failMessage()` method to allow for declaring fail messages during run time


## 0.12.1 - 2021-06-10
- bump sfneal/models min version to v2.3.0 to fix issues with `CrudModelAction` exception throwing


## 0.13.0 - 2021-06-14
- refactor `CrudModelAction`'s $request param to be nullable for actions that don't require request data


## 0.14.0 - 2021-06-22
- fix `CrudModelAction` to throw exceptions when actions fail in dev & prod environments
- cut sfneal/js-response-helpers & sfneal/laravel-helpers from composer dependencies

 
## 0.15.0 - 2021-08-18
- start adding test suite
- fix issue with missing sfneal/address composer requirement that was previously a dependency of sfneal/models
- add sfneal/address to composer dependencies


## 0.16.0 - 2024-04-30
- add new GitHub actions
- fix dependency constraints


## 0.17.0 - 2024-04-30
- cut support for PHP 7.3 & 7.4
- add support for PHP 8.1, 8.2 & 8.3


## 0.17.1 - 2024-05-06
- bump sfneal/models version constraint

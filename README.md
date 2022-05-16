# php-bolierplate
## _A generic, minimalistic boilerplate for PHP applications._

Aim of this project is a simple, minimalistic boilerplate without heavy machinery - tons of abstractions or tight doctrinairism.

Only a set of usefull parameters, constants, vars and likely to be used functions along with very basic file and directory structure. Don't start from scratch!

### Table of contents

I. constants

| Constant | Description |
| ------ | ------ |
| **DS** | Directory separator |
| **eol** | PHP_EOL |
| **crlf** | `\r\n` |
| **APP_ROOT** | Root directory of a project |
| **LOGDIR** | Log directory of a project |
| **DATADIR** | Project's arbitrary data directory |
| **OS** | Platform: possible values: `win`, `nix` |
| **REQTYPE** | Request type - is it web or cli? Possible values: `cli`, `web`. If `web`, `ob_start();` is automatically applied |
| **APPENV** | Application environment. Possible values: `prod`, `devtest`. Important for error reporting/displaying |

II. Variables
`$GLOBALS['conf']` - if `application.ini` provided in `LOGDIR`, this variable will contain it's parameters. Expected but not required parameters are `memory_limit`, `time_limit`, `prod` (production mode).

III. Defaults
- Memory limit, 128MB default
- Time limit, 600 seconds default
- Log errors, `APP_ROOT/logs/error.log`
- Application custom logs, `APP_ROOT/logs/app.log`
- Include path, default + `APP_ROOT/includes`
- SPL autoloader, `APP_ROOT/classes/class_{CLASSNAME}.php`

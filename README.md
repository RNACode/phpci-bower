# Bower plugin for [PHPCI](https://www.phptesting.org)

A plugin for PHPCI to download and install Bower packages required by your application.

### Install the Plugin

1. Navigate to your PHPCI root directory and run `composer require rna-code/bower-phpci-plugin`
2. If you are using the PHPCI daemon, restart it
3. Update your `phpci.yml` in the project you want to deploy with

### Prerequisites

1. [Bower](https://www.bower.io) needs to be installed.

### Plugin Options
- **command** _[string, require]_ - Command name. See [API](http://bower.io/docs/api/)
- **flags** _[list, optional]_ - Command flags

### PHPCI Config

```yml
    RNACode\PHPCI\Bower:
        command: install
```

example:

```yml
setup:
    ...
    RNACode\PHPCI\Bower:
        command: install
        flags:
            - "--allow-root"
            - "--save"
    ...
```

Output:

```bash
bower install --allow-root --save
```

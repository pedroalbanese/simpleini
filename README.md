# simpleini
[![BSD 2-Clause "Simplified" License](https://img.shields.io/badge/License-BSD_2--Clause-blue.svg)](https://github.com/pedroalbanese/simpleini/blob/master/LICENSE.md) 
[![GoDoc](https://godoc.org/github.com/pedroalbanese/simpleini?status.png)](http://godoc.org/github.com/pedroalbanese/simpleini)
[![GitHub downloads](https://img.shields.io/github/downloads/pedroalbanese/simpleini/total.svg?logo=github&logoColor=white)](https://github.com/pedroalbanese/simpleini/releases)
[![Go Report Card](https://goreportcard.com/badge/github.com/pedroalbanese/simpleini)](https://goreportcard.com/report/github.com/pedroalbanese/simpleini)
[![GitHub go.mod Go version](https://img.shields.io/github/go-mod/go-version/pedroalbanese/simpleini)](https://golang.org)
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/pedroalbanese/simpleini)](https://github.com/pedroalbanese/simpleini/releases)

A Go library implementing yet another interface to a particular subset of INI files.

Features:

- *What it says on the tin*

## Command

```
Usage: ini [-f file] <set|get|del> [section] [parameter] [value]
  -f string
        Target INI File ('-' for stdin/stdout)
```

## Contributing

Follow the usual GitHub development model:

1. Clone the repository
2. Make your changes on a separate branch
3. Make sure you run `gofmt` and `go test` before committing
4. Make a pull request

See licensing for legalese.

## Licensing

Standard two-clause BSD license, see LICENSE.txt for details.

Any contributions will be licensed under the same conditions.

Copyright (c) 2014 Piotr S. Staszewski  
Copyright (c) 2022 Pedro F. Albanese


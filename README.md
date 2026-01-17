# Lens

Lens is a developer-focused inspection tool that scans your view files and detects missing or recommended HTML attributes.

It helps you catch common HTML issues early by analyzing Blade, Vue, JSX, TSX, and HTML files and reporting problems directly in the console.

---

## Features

- Inspect multiple template formats:
  - Blade (`.blade.php`)
  - Vue (`.vue`)
  - React JSX / TSX (`.jsx`, `.tsx`)
  - Plain HTML (`.html`)
- Two inspection depths:
  - **Shallow** — required attributes only
  - **Deep** — required + best-practice attributes
- Built-in knowledge of common HTML elements (`a`, `form`, `img`, `button`, etc.)
- Interactive CLI prompts
- Configurable defaults
- CI-friendly (non-zero exit code when issues are found)

---

## Installation

```bash
composer require kiriamcf/lens
```

## Publish configuration

```bash
php artisan vendor:publish --tag="lens-config"
```

## Configuration

Default values in case they are not provided in the command.

```
return [
    'folders' => ['./resources/views/'],
    'extensions' => ['blade'],
    'depth' => 'shallow',
];
```

| Key          | Description                                                  |
| ------------ | ------------------------------------------------------------ |
| `folders`    | Default folders to inspect                                   |
| `extensions` | File types to include (`blade`, `vue`, `jsx`, `tsx`, `html`) |
| `depth`      | Inspection level: `shallow` or `deep`                        |

## Usage

```
php artisan lens
```

### Command options

```
php artisan lens \
  --extensions=blade,vue \
  --depth=deep \
  --folder=resources/views
```

| Option         | Description                        |
| -------------- | ---------------------------------- |
| `--extensions` | Comma-separated list of extensions |
| `--depth`      | `shallow` or `deep`                |
| `--folder`     | Folder to inspect                  |
| `--default`    | Use config values without prompts  |

### Example Output

```
Warning in file: resources/views/example.blade.php (Line: 12)
 - Element: a
 - Missing attributes: href
 - Recommended attributes: target
```

Exit codes:
- 0 — no issues found
- 1 — warnings detected

## What Lens Checks

| Element     | Required Attributes     | Recommended (Deep)          |
|-------------|-------------------------|-----------------------------|
| `<a>`       | `href`                  | `target`                    |
| `<button>`  | —                       | `type`                      |
| `<form>`    | `action`                | `method`, `enctype`         |
| `<iframe>`  | `src`                   | `sandbox`, `loading`        |
| `<img>`     | `src`, `alt`            | `loading`                  |
| `<input>`   | `type`                  | `value`, `autocomplete`     |
| `<link>`    | `href`, `rel`           | `type`                      |
| `<script>`  | —                       | `defer`, `async`, `type`    |
| `<source>`  | `src`                   | `type`                      |
| `<track>`   | `src`, `kind`           | `default`                  |

Supports Blade, Vue, JSX, TSX, and HTML attribute bindings.

## Testing

Run the test suite:

```
composer test
```

Run static analysis:

```
composer analyse
```

## Contributing

Contributions are very welcome, but please ensure:

- Tests are added or updated where applicable
- Code passes formatting and static analysis
- Changes are documented when necessary

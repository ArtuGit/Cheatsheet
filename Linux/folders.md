# Folders

Delete folder recursively
---

`find /path/to/dir -type d -name "<dir_name>" -exec rm -rf {} +`

Examples:
- `find . -type d -name "node_modules" -exec rm -rf {} +`
- `find . -type d -name "dist" -exec rm -rf {} +`